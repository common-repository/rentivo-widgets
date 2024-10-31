<?php
__autoload("helper");

function activatePlugin() {
    $helper = new Helper();
    $widgets = $helper->getConfig("widgets");
    $settings = $helper->getConfig("default_settings");


    if (!get_option("rentivoSettings")) {
        add_option("rentivoSettings", $settings);
    }

    if (!get_option("rentivoWidgetsGeneral")) {
        add_option("rentivoWidgetsGeneral", array("active" => true));
    }


    if (!get_option("dataBridgeIncluded")) {
        add_option("dataBridgeIncluded", false);
    }

    if (!get_option("rentivoWidgets")) {
        add_option("rentivoWidgets", array_keys($widgets));
    }


}
register_activation_hook( ROOT . "/plugin.php", 'activatePlugin' );

function deactivatePlugin() {
    $helper = new Helper();

    /*
    if (get_option("rentivoSettings")) {
      delete_option("rentivoSettings");
    }

    if (get_option("rentivoWidgetsGeneral")) {
        delete_option("rentivoWidgetsGeneral");
    }


    if (get_option("dataBridgeIncluded")) {
        delete_option("dataBridgeIncluded");
    }

    if (get_option("rentivoWidgets")) {
        delete_option("rentivoWidgets");
    }
    */


    // Loop through widgets
    $widgets = $helper->getConfig("widgets");
    foreach ($widgets as $widgetKey => $widgetArr) {
        if (get_option($widgetKey)) {
            delete_option($widgetKey);
        }
    }

}
register_deactivation_hook( ROOT . "/plugin.php", 'deactivatePlugin' );