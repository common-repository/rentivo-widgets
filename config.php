<?php
return array(
    'siteUrl'  => site_url(),
    'pluginDir' => plugin_dir_url("") . "rentivo-widgets",
    'assetUrl'  => plugin_dir_url("") . "rentivo-widgets/resources",

    'default_settings' => array(
        "rentivo_property_id" => "12345",
        "rentivo_website" => "",
        "primary_link_colour" => "#428bca",
        "primary_link_hover_colour" => "#285e8e",
        "primary_button_colour" => "#428bca",
        "primary_button_hover_colour" => "#285e8e",
        "test3" => "comon"
    ),

    'widgets' => array(
        'propertyPriceAvailabilityCalculator' => array (
            "meta" => array(
                "title" => "Property Price Availability Calculator",
                "description" => "Displays a live date checker. Once dates are confirmed a price & book now button is generated.",
                "shortcode" => "rentivo_price_availability_calculator",
                "requiresPropertyId" => true,
                "filterCategories" => "cat-popular cat-property"
            ),
            "attributes" => array(
                "property_id" => array("entityId", "", "required"), // shortcode_param => rentivo_param, default value, validation rules
            )
        ),
        'propertyAvailability' => array (
            "meta" => array(
                "title" => "Property Availability",
                "description" => "Displays a live availability calendar of a single property",
                "shortcode" => "rentivo_availability",
                "requiresPropertyId" => true,
                "filterCategories" => "cat-popular cat-property"
            ),
            "attributes" => array(
                "title"                     => array("calendarName", ""),
                "contact_button_class"      => array("contactButtonClass", "btn-info"),
                "render_if_empty"           => array("renderIfEmpty", true),
                "property_id"               => array("entityId", "", "required"),
                "show_sidebar"              => array("showSidebar", false),
                "months_displayed"          => array("displayedMonths", 36),
                "show_updated_time"         => array("showUpdatedTime", false),
                "rows"                      => array("calendarsRowsInViewport", 3),
                "columns"                   => array("calendarsInRowGroup", 3),
                "starts_at"                  => array("startGroupAtDate")
                //"legend_column_class"       => array("legendCol", "col-xs-12 col-sm-12 col-md-12 col-lg-4 xs-clear sm-clear"),
                //"calendar_column_class"     => array("calendarCol", "xs-clear sm-clear col-xs-12 col-md-12 col-md-tight col-lg-tight col-lg-8"),
                //"calendar_item_class"       => array("calendarItem", "col-xs-12 col-md-4 col-sm-4")
            )
        ),
        'stackedAvailability' => array (
            "meta" => array(
                "title" => "Stacked Property Availability",
                "description" => "This widget allows you to view availability of multiple properties in an easy to use stacked 'gant' style table. You can add upto 20 properties to these widgets. (Performance limitation which can be lifted on discussion with Rentivo).",
                "shortcode" => "rentivo_stacked_availability",
                "requiresPropertyId" => false,
                "filterCategories" => "cat-properties"
            ),
            "attributes" => array(
                "property_ids" => array("propertyIds", "53891+48646", "required")
            )
        ),
        'propertyRates' => array (
            "meta" => array(
                "title" => "Property Rates",
                "description" => "Shows the pricing rates for the rental.",
                "shortcode" => "rentivo_rates",
                "requiresPropertyId" => true,
                "filterCategories" => "cat-property"
            ),
            "attributes" => array(
                "hide_rows_after"             => array("hideRowsAfter", "7"),
                "show_nightly_column"         => array("showNightlyColumn", true),
                "show_weekly_column"          => array("showWeeklyColumn", true),
                "property_id"               => array("entityId", "", "required"),
                "show_min_stay_column"         => array("showMinStayColumn", true),
                "missing_price_text"          => array("missingPriceText", "")
            )
        ),
        'propertyViewport' => array (
            "meta" => array(
                "title" => "Micro Property Page",
                "description" => "A viewport showing a collection of useful tabbed windows for your property. By default, will show availability, pricing, and rates, in addition to an informative title and picture. Your one stop shop for a rental widget.",
                "shortcode" => "rentivo_viewport",
                "requiresPropertyId" => true,
                "filterCategories" => "cat-property cat-popular"
            ),
            "attributes" => array(
                "property_id" => array("entityId", "", "required")
            )
        ),
        'propertyAmenities' => array (
            "meta" => array(
                "title" => "Property Amenities",
                "description" => "Displays property amenities (kitchen, attractions, outdoor etc).",
                "shortcode" => "rentivo_amenities",
                "requiresPropertyId" => true,
                "filterCategories" => "cat-property"
            ),
            "attributes" => array(
                "property_id" => array("entityId", "", "required"), // shortcode_param => rentivo_param, default value, validation rules
                "amenity_check_class" => array("amenityCheckClass", "smallCheck")
            )
        ),
        'propertyDescription' => array (
            "meta" => array(
                "title" => "Property Description",
                "description" => "Displays property description.",
                "shortcode" => "rentivo_description",
                "requiresPropertyId" => true,
                "filterCategories" => "cat-property"
            ),
            "attributes" => array(
                "property_id" => array("entityId", "", "required"), // shortcode_param => rentivo_param, default value, validation rules
                "trim_length" => array("defaultTrimLength", "20000"),
                "expand_trim_length" => array("expandTrimLength", ""),
                "description_enabled" => array("description.enabled", true),
                "description_title" => array("description.header", "Rental Description"),
                "description_shorten" => array("description.trim", true),
                "readmore_enabled" => array("readmore.enabled", true),
                "location_enabled" => array("location.enabled", true),
                "location_title" => array("location.header", "Location Description"),
                "location_shorten" => array("location.trim", true),
                "payment_enabled" => array("payment.enabled", true),
                "payment_title" => array("payment.header", "Payment Details/Description"),
                "payment_shorten" => array("payment.trim", true),
                "travel_enabled" => array("travel.enabled", true),
                "travel_title" => array("travel.header", "Travel Details"),
                "travel_shorten" => array("travel.trim", true)
            )
        ),
        'propertyTitle' => array (
            "meta" => array(
                "title" => "Property Title",
                "description" => "Displays the property title",
                "shortcode" => "rentivo_title",
                "requiresPropertyId" => true,
                "filterCategories" => "cat-property"
            ),
            "attributes" => array(
                "property_id" => array("entityId", "", "required"),
            )
        ),
        'propertyDescriptiveTitle' => array (
            "meta" => array(
                "title" => "Property Subtitle",
                "description" => "Displays the property subtitle. For example: 'Cottage in Topsham with 3 bedrooms'",
                "shortcode" => "rentivo_subtitle",
                "requiresPropertyId" => true,
                "filterCategories" => "cat-property"
            ),
            "attributes" => array(
                "property_id" => array("entityId", "", "required"),
            )
        ),
        'propertyDetails' => array (
            "meta" => array(
                "title" => "Property Details",
                "description" => "Displays a short description including an overview of suitability and amenities, with a small photo and a static map.",
                "shortcode" => "rentivo_details",
                "requiresPropertyId" => true,
                "filterCategories" => "cat-property"
            ),
            "attributes" => array(
                "property_id" => array("entityId", "", "required"),
                "show_enquire_override" => array("showEnquireOverride", false),
                "show_featured_image" => array("showFeaturedImage", true),
                "show_map" => array("showMap", true),
                "show_pricing" => array("showPricing", true),
                "show_glance" => array("showGlance", true),
                "show_amenities" => array("showAmenities", true),
                "description_length" => array("descriptionTrimLength", "300")
            )
        ),
        'propertyGlance' => array (
            "meta" => array(
                "title" => "Property Glance",
                "description" => "Displays a small overview of the property type and it's suitability.",
                "shortcode" => "rentivo_glance",
                "requiresPropertyId" => true,
                "filterCategories" => "cat-property"
            ),
            "attributes" => array(
                "property_id" => array("entityId", "", "required"), // shortcode_param => rentivo_param, default value, validation rules
            )
        ),
        'propertyImages' => array (
            "meta" => array(
                "title" => "Property Images",
                "description" => "Displays a photo gallery of a properties images",
                "shortcode" => "rentivo_images",
                "requiresPropertyId" => true,
                "filterCategories" => "cat-property cat-popular"
            ),
            "attributes" => array(
                "property_id" => array("entityId", "", "required"),
                "size" => array("dimension", "large"),
                "randomize" => array("randomize", false),
                "max_images" => array("maxImages", 48),
                "max_navigation_thumbs" => array("maxNavigationThumbs", null),
                "banner_enabled" => array("banner.enabled", true),
                "banner_anchor" => array("banner.anchor", "View Gallery"),
                "landscape_only" => array("landscapeOnly", false),
                "caption_override" => array("captionOverride", null),
                "show_image_title" => array("showImageTitle", true),
                "show_caption" => array("showCaption", null),
                "show_image_alt" => array("showImageAlt", true),
                "skip_first_n_images" => array("skipFirstNImages", 0),
                "slick_scroll_window" => array("slickScrollWindow", true),
                "slides_to_show" => array("slidesToShow", 4),
                "show_default_if_empty" => array("showDefaultIfEmpty", null),
                "default_caption_pattern" => array("defaultCaptionPattern", "Rental %s"),
                "image_class_name" => array("image_class_name", "col-xs-12"),
                "image_processing_filters_t" => array("imageProcessingFilters.t", "large")
            )
        ),
        'propertyManagerBadge' => array (
            "meta" => array(
                "title" => "Property Manager Badge",
                "description" => "Displays company details about the manager of the property",
                "shortcode" => "rentivo_manager_badge",
                "requiresPropertyId" => true,
                "filterCategories" => "cat-property"
            ),
            "attributes" => array(
                "property_id" => array("entityId", "", "required"), // shortcode_param => rentivo_param, default value, validation rules
            )
        ),
        'propertyManagerContact' => array (
            "meta" => array(
                "title" => "Property Manager Contact",
                "description" => "Displays property manager contact information including a button which links to an enquiry form popup.",
                "shortcode" => "rentivo_manager_contact",
                "requiresPropertyId" => true,
                "filterCategories" => "cat-property"
            ),
            "attributes" => array(
                "property_id" => array("entityId", "", "required"), // shortcode_param => rentivo_param, default value, validation rules
            )
        ),
        'propertyMap' => array (
            "meta" => array(
                "title" => "Property Map",
                "description" => "Displays a live google map with the location of a property.",
                "shortcode" => "rentivo_map",
                "requiresPropertyId" => true,
                "filterCategories" => "cat-property cat-popular"
            ),
            "attributes" => array(
                "property_id" => array("entityId", "", "required"),
                "static_map_size" => array("staticMapSize", "748x160"),
                "map_show_marker" => array("map.showMarker", true),
                "map_show_circle" => array("map.showCircle", true),
                "map_zoom" => array("map.zoom", "13"),
                "map_type_id" => array("map.mapTypeId", "google.maps.MapTypeId.ROADMAP"),
                "map_circle_radius" => array("map.circle.radius", "300")
            )
        ),
        'propertyNearbyProperties' => array (
            "meta" => array(
                "title" => "Property Nearby Properties",
                "description" => "Displays a list of a nearby properties from the location of a property.",
                "shortcode" => "rentivo_nearby_properties",
                "requiresPropertyId" => true,
                "filterCategories" => "cat-properties"
            ),
            "attributes" => array(
                "property_id" => array("entityId", "", "required"),
                "max_nearby_properties" => array("maxNearbyProperties", "6"),
                "max_distance_apart" => array("maximumDistanceApartForNearest", "90"),
                "same_location_min_distance" => array("sameLocationMinimumDistance", "1.0E-7"),
                "distance_phrase" => array("distancePhrase", "%1$.2f/km away"),
                "remove_properties_within_distance" => array("removePropertiesWithinDistance", "0.05")
            )
        ),
        'propertyReviews' => array (
            "meta" => array(
                "title" => "Property Nearby Properties",
                "description" => "Shows the reviews for this rental. (Only available on rentals managed via external API).",
                "shortcode" => "rentivo_reviews",
                "requiresPropertyId" => true,
                "filterCategories" => "cat-property"
            ),
            "attributes" => array(
                "property_id" => array("entityId", "", "required"),
                "sort_by" => array("sortBy", "stayDate"),
                "show_sticker" => array("showSticker", true),
                "sort_order" => array("sortOrder", "recent")
            )
        ),
        'propertyRooms' => array (
            "meta" => array(
                "title" => "Property Rooms",
                "description" => "Shows the rooms available in the rental.",
                "shortcode" => "rentivo_rooms",
                "requiresPropertyId" => true,
                "filterCategories" => "cat-property"
            ),
            "attributes" => array(
                "property_id" => array("entityId", "", "required"),
                "has_sleeps_column" => array("hasSleepsColumn", false),
                "room_type" => array("roomType", "Bedrooms")
            )
        ),
        'localizationManager' => array (
            "meta" => array(
                "title" => "Localization Manager",
                "description" => "This widget will allow you to manage the localization and currency settings of the widgets that rely on pricing. If you wish your widgets to use a particular currency, you can call the widget with the currency you need set in the require path.",
                "shortcode" => "rentivo_local",
                "requiresPropertyId" => false,
                "filterCategories" => "cat-other cat-popular"
            ),
            "attributes" => array(
                "show_languages" => array("showLanguages", true),
                "currency" => array("currency", null)
            )
        ),
        'locationsMap' => array ( //TODO: Doesn't work ask chris
            "meta" => array(
                "title" => "Locations Map",
                "description" => "This is used to display a pin of all of your rentals on a map. When you click on the pin, it can open up on your own web page.",
                "shortcode" => "rentivo_locations_map",
                "requiresPropertyId" => false,
                "filterCategories" => "cat-search"
            ),
            "attributes" => array(
                "woe_id" => array("parentWoeid", "12602182", "required"),
                "map_height" => array("mapHeight", "220"),
                "move_search" => array("moveSearch", false),
                "max_markers" => array("maxMarkers", "100"),
                "show_toolbar" => array("showToolbar", false),
                "show_radius_control" => array("showRadiusControl", true),
                "show_overlay_inset" => array("showOverlayInset", true),
                "search_onload" => array("searchOnLoad", true),
                "latlng_override" => array("latLngOverride", null),
                "use_location_bounds" => array("useLocationBounds", true),
                "map_navigation_control" => array("mapOptions.navigationControl", true),
                "map_type_control" => array("mapOptions.mapTypeControl", true),
                "map_scale_control" => array("mapOptions.scaleControl", true),
                "map_draggable" => array("mapOptions.draggable", true),
                "map_zoom" => array("mapOptions.zoom", "3")
            )
        ),
        'locationsPropertiesListing' => array (
            "meta" => array(
                "title" => "Property Listings",
                "description" => "This widget is used to display search results within a location. It will interact with other widgets such as the location map above, or search filters to automatically re-search and populate itself from the search server with fresh rentals that match your search.",
                "shortcode" => "rentivo_listings",
                "requiresPropertyId" => false,
                "filterCategories" => "cat-search cat-popular"
            ),
            "attributes" => array(
                "woe_id" => array("parentWoeid", "12602182", "required"),
                "offset" => array("offset", null),
                "fc" => array("fc", null)
            )
        ),
        'locationsRegions' => array (
            "meta" => array(
                "title" => "Property Location Regions",
                "description" => "The widget will show all immediate children regions of the currently active destination. So, if you are wanting to see all destinations without 'England' you can pass the location ID for England and it will show the immediate child regions of England.",
                "shortcode" => "rentivo_regions",
                "requiresPropertyId" => false,
                "filterCategories" => "cat-search"
            ),
            "attributes" => array(
                "woe_id" => array("parentWoeid", "12602182", "required"),
                "forward_on_empty" => array("forwardOnEmpty", null),
                "route_name" => array("routeName", "vacation-rentals-regions")
            )
        ),
        'locationsNavigator' => array (
            "meta" => array(
                "title" => "Locations Navigator",
                "description" => "This widget allows you to navigate through locations by drilling down and up through your site destinations. It will also show how many rentals are within your current address. You need to pass the WOEID of the current active location to the widget using the woe_id option.",
                "shortcode" => "rentivo_locations_nav",
                "requiresPropertyId" => false,
                "filterCategories" => "cat-search"
            ),
            "attributes" => array(
                "woe_id" => array("parentWoeid", "12602182", "required"),
                "sort" => array("sort", "count"),
                "route_name" => array("routeName", "vacation-rentals"),
                "show_back_up_to_parent" => array("showBackUpToParent", true),
                "remove_drill_throughed_locations" => array("removeDrillThroughedLocations", true),
                "more_rentals_toggle" => array("moreRentalsToggle", "11")
            )
        ),
        'locationsBreadcrumb' => array (
            "meta" => array(
                "title" => "Locations Breadcrumb",
                "description" => "This widget will show you a breadcrumb ancestry path of the currently active destination. Useful for showing context of a destination so you know where the destination is geographically in country, admin zone or city.",
                "shortcode" => "rentivo_locations_breadcrumb",
                "requiresPropertyId" => false,
                "filterCategories" => "cat-search"
            ),
            "attributes" => array(
                "woe_id" => array("parentWoeid", "12602182", "required"),
                "use_links" => array("useLinks", true),
                "route_name" => array("routeName", "vacation-rentals"),
                "minimum_depth" => array("minimumDepth", "2")
            )
        ),
        'locationsNeighbours' => array (
            "meta" => array(
                "title" => "Locations Neighbours",
                "description" => "This widget will show adjacent neighbouring regions and destinations. For example, if you wanted to show what properties you have in destinations which are adjacent to France, you would pass the location ID for France. If you do not have any rentals in the adjacent region the destination will not show.",
                "shortcode" => "rentivo_locations_neighbours",
                "requiresPropertyId" => false,
                "filterCategories" => "cat-search"
            ),
            "attributes" => array(
                "woe_id" => array("parentWoeid", "12602182", "required")
            )
        ),
        'locationsActiveLocation' => array (
            "meta" => array(
                "title" => "Current Search Location",
                "description" => "Shows the name of the currently active destination by the place ID. For example: 'Holiday Rentals in Devon'.",
                "shortcode" => "rentivo_current_location",
                "requiresPropertyId" => false,
                "filterCategories" => "cat-search"
            ),
            "attributes" => array(
                "woe_id" => array("parentWoeid", "12602182", "required"),
                "pattern" => array("pattern", "Holiday Rentals in %s"),
                "pattern_short" => array("pattern_short", "Rentals in %s"),
                "name" => array("name", "")
            )
        )
        //TODO: LocationsLister
        //TODO: Arrays as values

    )

);