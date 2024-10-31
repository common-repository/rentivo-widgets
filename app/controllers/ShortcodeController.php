<?php
__autoload("controller");
__autoload("helper");
__autoload("validator");

class ShortcodeController extends Controller {

    private $data;
    private $options;
    private $widgetName;

    public function __construct($widgetName)
    {
        $this->helper = new Helper();
        $this->widgetName = $widgetName;
    }

    public function rentivoWidget($attr, $content)
    {
        // If not active
        if (filter_var(get_option("rentivoWidgetsGeneral")["active"], FILTER_VALIDATE_BOOLEAN) == false or filter_var(get_option($this->widgetName)["active"], FILTER_VALIDATE_BOOLEAN) == false) {
            return false;
        }

        // Init vars
        $settings = $this->helper->getConfig("widgets")[$this->widgetName]; // Get settings for widget
        $defaultAttributes = $this->helper->convertDefaultAttributes($settings["attributes"]); // Get default attribute values
        $newAttributes = $this->helper->convertAttributeKeys($attr, $settings["attributes"]); // Get new attribute values
        $attributes = array_replace($defaultAttributes, $newAttributes); // Combine default and new attributes
        $attributeRules = $this->helper->convertAttributeRules($settings["attributes"]); // Generate rules for each attribute based off settings

        // Set rules
        $validator = new Validator();
        $validator->rules($attributeRules);

        // Validate
        if (!$validator->validate($attr)) {
            foreach ($validator->getErrors() as $error) {
                echo $this->helper->showError($error);
            }
            return false;
        }

        // Set template vars
        $params = $this->helper->convertBoolsToBinaryString($this->helper->convertDotIntoArray($attributes));
        if(array_key_exists("propertyIds", $params)) {
            $params["ref"] = $params["propertyIds"];
            $urlSegment = "/properties/";
        } else if(array_key_exists("entityId", $params)) {
            $params["ref"] = $params["entityId"];
            $urlSegment = "/entityId/";
        } else {
            $params["ref"] = "";
            $urlSegment = "";
        }
        $this->set("widgetName", $this->widgetName);
        $this->set("params", $params);
        $this->set("urlSegment", $urlSegment);
        $this->set("containerId", $this->helper->generateRandomString());

        // Check data bridge
        if (get_option("dataBridgeOption") == false) {
            update_option("dataBridgeOption", true);
            $this->set("dataBridge", "PropertyDataBridge, ");
        } else {
            update_option("dataBridgeOption", false);
            $this->set("dataBridge", "");
        }

        add_action('wp_footer', array($this, "injectScripts"));

        // Render view
        return $this->view('injectables/front/rentivo-widget.html.twig');

    }

    public function injectScripts() {
        echo $this->view('injectables/front/rentivo-widget-script.html.twig');
    }


}