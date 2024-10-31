<?php
__autoload("helper");
__autoload("enqueue");

$helper = new Helper();
$enqueue = new Enqueue();

add_action( 'admin_enqueue_scripts', 'enqueue_color_picker' );
function enqueue_color_picker( $hook_suffix ) {
    $helper = new Helper();

    wp_enqueue_style( 'wp-color-picker' );
    wp_enqueue_script( 'colourPickerJS', $helper->assetUrl("js/colour-picker.js"), array( 'wp-color-picker' ), false, true );
}

$enqueue->admin([
    'as'  => 'adminMasonryJS',
    'src' => $helper->assetUrl("js/masonry.pkgd.min.js")
], "footer");

$enqueue->admin([
    'as'  => 'adminCSS',
    'src' => $helper->assetUrl("css/admin.css")
]);

$enqueue->admin([
    'as'  => 'adminMasonryJS',
    'src' => $helper->assetUrl("js/masonry.pkgd.min.js")
], "footer");

$enqueue->admin([
    'as'  => 'adminIsotopeJS',
    'src' => $helper->assetUrl("js/isotope.pkgd.min.js")
], "footer");

$enqueue->admin([
    'as'  => 'adminClipboardJS',
    'src' => $helper->assetUrl("js/clipboard.min.js")
], "footer");

$enqueue->admin([
    'as'  => 'adminJS',
    'src' => $helper->assetUrl("js/admin.js")
], "footer");

$enqueue->front([
    'as'  => 'rentivoWidgetWordpressResetCSS',
    'src' => $helper->assetUrl('css/rentivo-widget-wordpress-reset.css')
]);

$enqueue->front([
    'as'  => 'frontCSS',
    'src' => $helper->assetUrl('css/front.css')
]);

$rS = get_option("rentivoSettings");
if ($rS and array_key_exists("rentivo_website", $rS)) {
    if ($rS["rentivo_website"]) {
        $sdk = $rS["rentivo_website"];
    } else {
        $sdk = "https://www.rentivo.com";
    }
} else {
    $sdk = "https://www.rentivo.com";
}

$enqueue->front([
    'as'  => 'rentivoSdkJS',
    'src' => $sdk . '/v1/sdk.js?callbacks=rentivo_callbacks'
], "footer");