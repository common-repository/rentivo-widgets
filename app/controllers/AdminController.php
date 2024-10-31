<?php
//TODO: Write a custom twig function fore getting wordpress options

__autoload("controller");
__autoload("helper");

class AdminController extends Controller {

    private $data;
    private $options;

    public function __construct()
    {
        $this->helper = new Helper();
        $this->set('siteUrl', $this->helper->getConfig("siteUrl"));
        $this->set('assetUrl', $this->helper->getConfig("assetUrl"));

    }

    public function index()
    {

        // Loop through widgets and inject if active
        $widgets = $this->helper->getConfig("widgets");
        foreach ($widgets as $widgetKey => $widget) {
            if (filter_var(get_option($widgetKey)["active"], FILTER_VALIDATE_BOOLEAN)) {
                $widgets[$widgetKey]["meta"]["active"] = true;
            } else {
                $widgets[$widgetKey]["meta"]["active"] = false;
            }

            // Fix bools
            foreach ($widget["attributes"] as $attrKey => $attr) {
                if (array_key_exists(1, $attr)) {
                    if (is_bool($attr[1])) {
                        if (filter_var($attr[1], FILTER_VALIDATE_BOOLEAN)) {
                            $widgets[$widgetKey]["attributes"][$attrKey][1] = "true";
                        } else {
                            $widgets[$widgetKey]["attributes"][$attrKey][1] = "false";
                        }

                    }
                }
            }
        }

        $settings = get_option("rentivoSettings");
        $this->set("settings", $settings);
        if ($settings["rentivo_property_id"] !== "12345") {
            $this->set("rentivoPropertyIdValue", $settings["rentivo_property_id"]);
        } else {
            $this->set("rentivoPropertyIdValue", "");
        }
        $this->set("allActive", filter_var(get_option("rentivoWidgetsGeneral")["active"], FILTER_VALIDATE_BOOLEAN));
        $this->set("widgets", $widgets);
        echo $this->view('pages/admin/rentivo-index.html.twig');
    }

    public function settings()
    {
        $settings = get_option("rentivoSettings");
        $defaultSettings = $this->helper->getConfig("default_settings");
        if ($settings["rentivo_property_id"] !== "12345") {
            $this->set("rentivoPropertyIdValue", $settings["rentivo_property_id"]);
        } else {
            $this->set("rentivoPropertyIdValue", "");
        }
        $this->set("settings", $settings);
        $this->set("default_settings", $defaultSettings);
        echo $this->view('pages/admin/rentivo-settings.html.twig');
    }

    public function updateSettings(WP_REST_Request $request) {

        $settings = get_option("rentivoSettings");
        $params = $request->get_params();

        if (empty($params)) {
            return "fail";
        }

        foreach ($params as $paramKey => $paramValue) {
            if(array_key_exists($paramKey, $settings)) {
                if ($paramKey == "rentivo_property_id" && $paramValue == 0) {
                    $settings[$paramKey] = "12345";
                } elseif ($paramKey == "rentivo_website") {
                    if ($paramValue) {
                        $components = parse_url($paramValue);
                        $settings[$paramKey] = $components["scheme"] . "://" . $components["host"];
                    } else {
                        $settings[$paramKey] = "";
                    }
                } else {
                    $settings[$paramKey] = $paramValue;
                }
            }
        }

        update_option("rentivoSettings", $settings);

        return json_encode($settings);

    }

    public function updateStatus(WP_REST_Request $request) {

        if (!$request->get_param('name') and !$request->get_param('status')) {
            return "fail";
        }

        if (!get_option($request->get_param('name'))) {
            return "fail";
        }

        $optionArr = get_option($request->get_param('name'));
        $optionArr["active"] = $request->get_param('status');
        update_option($request->get_param('name'), $optionArr);

        return "success";

    }

    public function updateStatuses(WP_REST_Request $request) {

        if (!$request->get_param('status')) {
            return "fail";
        }

        $optionArr = get_option("rentivoWidgetsGeneral");
        $optionArr["active"] = $request->get_param('status');
        update_option("rentivoWidgetsGeneral", $optionArr);

        return "success";

    }

    /*
    public function updateRentivoPropertyId(WP_REST_Request $request) {

        $id = $request->get_param('propertyId');

        if (!isset($id)) {
            return "fail";
        }

        if ($id == 0) {
            update_option("rentivoPropertyId", "12345");
        } else {
            update_option("rentivoPropertyId", $id);
        }

        return get_option("rentivoPropertyId");

    }

    public function updateRentivoWebsite(WP_REST_Request $request) {

        $website = $request->get_param('website');

        if (!isset($website)) {
            return "fail";
        }

        $components = parse_url($website);
        $newWebsite = $components["scheme"] . "://" . $components["host"];

        update_option("rentivoWebsite", $newWebsite);

        return $newWebsite;

    }
    */

}