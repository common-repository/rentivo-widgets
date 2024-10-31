<?php
__autoload("helper");
$helper = new Helper();
$widgets = $helper->getConfig("widgets");
$settings = get_option("rentivoSettings");
$default_settings = $helper->getConfig("default_settings");

// Reset resetable widgets
if (get_option("dataBridgeIncluded")) {
    update_option("dataBridgeIncluded", false);
}
update_option("rentivoWidgets", array_keys($widgets));

// Loop through widgets
foreach ($widgets as $widgetKey => $widgetArr) {
    if (!get_option($widgetKey)) {
        add_option($widgetKey, array("active" => true));
    }
}

// Add new settings to options
$addCount = 0;
foreach ($default_settings as $settingKey => $settingValue) {
    if(!array_key_exists($settingKey, $settings)) {
        // add the new setting
        $settings[$settingKey] = $default_settings[$settingKey];
        $addCount++;
    }
}

if ($addCount > 0) {
    update_option("rentivoSettings", $settings);
}

// Remove old settings from options
$removeCount = 0;
foreach ($settings as $settingKey => $settingValue) {
    if(!array_key_exists($settingKey, $default_settings)) {
        // remove the old setting
        unset($settings[$settingKey]);
        $removeCount++;
    }
}

if ($removeCount > 0) {
    update_option("rentivoSettings", $settings);
}