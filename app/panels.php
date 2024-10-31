<?php
__autoload("AdminController");

/**
 * Rentivo Index
 */
function register_admin() {
    $adminController = new AdminController();
    add_menu_page(
        __( 'Rentivo Widgets', 'textdomain' ),
        'Rentivo Widgets',
        'manage_options',
        'rentivo-index',
        array($adminController, 'index')
    );

    add_submenu_page(
        'rentivo-index',
        __( 'Rentivo', 'textdomain' ),
        'Settings',
        'manage_options',
        'rentivo-settings',
        array($adminController, 'settings')
    );
}
add_action( 'admin_menu', 'register_admin' );