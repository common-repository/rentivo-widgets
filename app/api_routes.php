<?php
__autoload("AdminController");

add_action( 'rest_api_init', function () {
    register_rest_route( 'rentivo-widgets/v1', '/status', array(
        'methods' => 'POST',
        'callback' => array(new AdminController(), 'updateStatus')
    ) );
} );

add_action( 'rest_api_init', function () {
    register_rest_route( 'rentivo-widgets/v1', '/statuses', array(
        'methods' => 'POST',
        'callback' => array(new AdminController(), 'updateStatuses')
    ) );
} );

add_action( 'rest_api_init', function () {
    register_rest_route( 'rentivo-widgets/v1', '/rentivo-property-id', array(
        'methods' => 'POST',
        'callback' => array(new AdminController(), 'updateRentivoPropertyId')
    ) );
} );

add_action( 'rest_api_init', function () {
    register_rest_route( 'rentivo-widgets/v1', '/website', array(
        'methods' => 'POST',
        'callback' => array(new AdminController(), 'updateRentivoWebsite')
    ) );
} );

add_action( 'rest_api_init', function () {
    register_rest_route( 'rentivo-widgets/v1', '/settings', array(
        'methods' => 'POST',
        'callback' => array(new AdminController(), 'updateSettings')
    ) );
} );