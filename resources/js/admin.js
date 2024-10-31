var $ = jQuery;
$(document).ready(function() {

    function isUrl(s) {
        var regexp = /(ftp|http|https):\/\/(\w+:{0,1}\w*@)?(\S+)(:[0-9]+)?(\/|\/([\w#!:.?+=&%@!\-\/]))?/
        return regexp.test(s);
    }

    // init Masonry
    var masonryOptions = {
        itemSelector: '.grid-item',
        percentPosition: true,
        columnWidth: '.grid-sizer'
    };
    var $grid = $('.masonry-grid').isotope(masonryOptions);

    // store filter for each group
    var filters = {};

    $('.rw-filters').on( 'click', '.button', function() {
        var $this = $(this);
        // get group key
        var $buttonGroup = $this.parents('.button-group');
        var filterGroup = $buttonGroup.attr('data-filter-group');
        // set filter for group
        filters[ filterGroup ] = $this.attr('data-filter');
        // combine filters
        var filterValue = concatValues( filters );
        // set filter for Isotope
        $grid.isotope({ filter: filterValue });
    });

    // change is-checked class on buttons
    $('.rw-filters .button-group').each( function( i, buttonGroup ) {
        var $buttonGroup = $( buttonGroup );
        $buttonGroup.on( 'click', 'button', function() {
            $buttonGroup.find('.is-checked').removeClass('is-checked');
            $( this ).addClass('is-checked');
        });
    });

    // flatten object by concatting values
    function concatValues( obj ) {
        var value = '';
        for ( var prop in obj ) {
            value += obj[ prop ];
        }
        return value;
    }


    // Init clipboard
    var clipboard = new Clipboard('.btn-copy');

    // Handle options toggle
    $( ".toggle-options" ).click(function() {
        event.preventDefault();
        $( "#" + $(this).data("options") ).slideToggle( "fast", function() {
            $('.masonry-grid').isotope(masonryOptions);
        });
    });

    // Widget Search
    /*
    $('#widgetSearch').keyup(function () {
        var search = $(this).val();
        var $container = $('.masonry-grid');
        var $items = $container.find(".grid-item");
        var sorts = {
            score: function ($item) { return $item.data("score"); },
            name: function ($item) { return $item.find(".title").text(); }
        };

        // If blank search trigger show all modules
        if (search == "") {
            $('#ShowAllModules').trigger("click");
            return;
        }

        // Clear matches
        clearClass($items, "match");

        // Calculate sort score and set match
        $.each($items, function (i, row) {
            var score = LiquidMetal.score($(row).find('.title').text(), search);
            var isMatch = score > 0.5;
            $(row).data("score", score);
            $(row).addClass("match");
        });

        // Isotope sort
        $container.isotope({ getSortData: sorts, sortBy: 'score', sortAscending: true });
        $container.isotope({ filter: '.match' });

    });
    */

    // Handle API calls
    var urlStartsWith = window.siteUrl.replace(/\/$/, "");
    var apiNamespace = urlStartsWith + "/wp-json/rentivo-widgets/v1/";
    var statusEndpoint = "status";
    var statusesEndpoint = "statuses";
    var propertyIdEndpoint = "rentivo-property-id";
    var websiteEndpoint = "website";
    var settingsEndpoint = "settings";

    $('#rentivoSettingsSubmit').click(function() {
        event.preventDefault();
        var that = this;
        $(that).addClass("button-loading");

        var $rentivoWebsite = $("input[name='rentivo_website']");
        var website = $rentivoWebsite.val().trim();
        if (website && !isUrl(website)) {
            $(that).removeClass("button-loading");
            alert("Please enter a valid URL");
            $rentivoWebsite.val("");
            return false;
        }

        var widgetData = $('#rentivoSettings').serialize();

        $.ajax({
            type: "POST",
            url: apiNamespace + settingsEndpoint,
            dataType: "json",
            success: function (data) {
                $(that).removeClass("button-loading");

                if(data == "fail") {
                    alert("Something went wrong");
                }

            },
            error: function (data) {
                $(that).removeClass("button-loading");
                alert("Something went wrong");
                console.log(data);
            },
            data: widgetData
        });
    });

    $('#rentivoWebsiteSubmit').click(function() {
        event.preventDefault();
        var that = this;
        $(that).addClass("button-loading");

        var $rentivoWebsite = $('#rentivoWebsite');
        var website = $rentivoWebsite.val().trim();
        if (website && !isUrl(website)) {
            $(that).removeClass("button-loading");
            alert("Please enter a valid URL");
            $rentivoWebsite.val("");
            return false;
        }

        var widgetData = {
            rentivo_website: website
        };

        $.ajax({
            type: "POST",
            url: apiNamespace + settingsEndpoint,
            dataType: "json",
            success: function (data) {
                if (data == "fail") {
                    $(that).removeClass("button-loading");
                    alert("Something went wrong");
                    console.log(data);
                } else {
                    data = JSON.parse(data);
                    $(that).removeClass("button-loading");
                    console.log(data);
                    $rentivoWebsite.val(data.rentivo_website);
                }
            },
            error: function (data) {
                $(that).removeClass("button-loading");
                alert("Something went wrong");
                console.log(data);
            },
            data: widgetData
        });
    });

    $('#rentivoPropertyIdSubmit').click(function() {
        event.preventDefault();
        var that = this;
        $(that).addClass("button-loading");

        var propertyId = $('#rentivoPropertyId').val().trim();
        if (propertyId == "") {
            propertyId = 0;
        }

        var widgetData = {
            rentivo_property_id: propertyId
        };

        $.ajax({
            type: "POST",
            url: apiNamespace + settingsEndpoint,
            dataType: "json",
            success: function (data) {
                if (data == "fail") {
                    $(that).removeClass("button-loading");
                    alert("Something went wrong");
                    console.log(data);
                } else {
                    $(that).removeClass("button-loading");
                    window.location.reload(false);
                }
            },
            error: function (data) {
                $(that).removeClass("button-loading");
                alert("Something went wrong");
                console.log(data);
            },
            data: widgetData
        });
    });

    $('#rentivoPropertyIdClear').click(function() {
        event.preventDefault();
        var that = this;

        $('#rentivoPropertyId').val("");

        var widgetData = {
            rentivo_property_id: ""
        };

        $.ajax({
            type: "POST",
            url: apiNamespace + settingsEndpoint,
            dataType: "json",
            success: function (data) {
                if (data == "fail") {

                    alert("Something went wrong");
                    console.log(data);

                } else {
                    window.location.reload(false);
                }
            },
            error: function (data) {
                alert("Something went wrong");
                console.log(data);
            },
            data: widgetData
        });
    });

    $('.rentivo-wigdet-button').click(function() {
        event.preventDefault();
        var that = this;
        $(that).addClass("button-loading");

        var setStatusTo;
        if ($(that).hasClass("on")) {
            setStatusTo = false;
        } else if ($(that).hasClass("off")) {
            setStatusTo = true;
        } else {
            alert("Something went wrong");
            return false;
        }

        var widgetData = {
            name: $(that).attr('id'),
            status: setStatusTo
        };

        $.ajax({
            type: "POST",
            url: apiNamespace + statusEndpoint,
            dataType: "json",
            success: function (data) {
                if (data == "success") {
                    $(that).removeClass("button-loading");
                    if ($(that).hasClass("on")) {
                        $(that).removeClass("on");
                        $(that).addClass("off");
                        $(that).text("Turn on");
                    } else if ($(that).hasClass("off")) {
                        $(that).removeClass("off");
                        $(that).addClass("on");
                        $(that).text("Turn off");
                    }

                } else {
                    alert("Something went wrong");
                    console.log(data);
                }
            },
            error: function (data) {
                $(that).removeClass("button-loading");
                alert("Something went wrong");
                console.log(data);
            },
            data: widgetData
        });
    });


    $('#rentivoWidgetsGeneral').click(function() {
        event.preventDefault();
        var that = this;
        $(that).addClass("button-loading");

        var setStatusTo;
        if ($(that).hasClass("on")) {
            setStatusTo = false;
        } else if ($(that).hasClass("off")) {
            setStatusTo = true;
        } else {
            alert("Something went wrong");
            return false;
        }

        var widgetData = {
            status: setStatusTo
        };

        $.ajax({
            type: "POST",
            url: apiNamespace + statusesEndpoint,
            dataType: "json",
            success: function (data) {
                if (data == "success") {
                    $(that).removeClass("button-loading");
                    if ($(that).hasClass("on")) {
                        $(that).removeClass("on");
                        $(that).addClass("off");
                        $(that).text("Turn all widgets on");
                        $(".rw-overlay").addClass("active");
                    } else if ($(that).hasClass("off")) {
                        $(that).removeClass("off");
                        $(that).addClass("on");
                        $(that).text("Turn all widgets off");
                        $(".rw-overlay").removeClass("active");
                    }

                } else {
                    alert("Something went wrong");
                    console.log(data);
                }
            },
            error: function (data) {
                $(that).removeClass("button-loading");
                alert("Something went wrong");
                console.log(data);
            },
            data: widgetData
        });
    });


});