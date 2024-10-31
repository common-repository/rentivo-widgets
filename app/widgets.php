<?php
/*
// Loop through widgets
$widgets = $helper->getConfig("widgets");
foreach ($widgets as $widgetKey => $widgetArr) {
    //add_shortcode( $widgetArr["meta"]["shortcode"], array(new ShortcodeController($widgetKey), "rentivoWidget") );
    register_widget(new WidgetController($widgetKey));
}
*/

/*
function register_widgets() {
    __autoload("WidgetController");
    __autoload("helper");
    $helper = new Helper();

    $widgets = $helper->getConfig("widgets");
    foreach ($widgets as $widgetKey => $widgetArr) {
        //add_shortcode( $widgetArr["meta"]["shortcode"], array(new ShortcodeController($widgetKey), "rentivoWidget") );
        //$widget = new WidgetController($widgetKey);
        register_widget("WidgetController");
    }
}

add_action( 'widgets_init', 'register_widgets' );
*/