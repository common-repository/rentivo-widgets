<?php
__autoload("ShortcodeController");
__autoload("helper");

//------ Shortcodes------
//---------------------------------------------------------------

// Loop through widgets
$widgets = $helper->getConfig("widgets");
foreach ($widgets as $widgetKey => $widgetArr) {
    add_shortcode( $widgetArr["meta"]["shortcode"], array(new ShortcodeController($widgetKey), "rentivoWidget") );
}