<?php

/*
@package (bvm_wb_theme_v1)
=========================
functions.php
=========================
*/

require get_template_directory() . '/inc/enqueue.php';
require get_template_directory() . '/inc/theme-support.php';
require get_template_directory() . '/inc/custom-post-type.php';
require get_template_directory() . '/inc/blocks.php';

add_theme_support('title-tag');


// API Google maps
// function enqueue_google_maps()
// {
//     wp_enqueue_script('google-maps', 'https://maps.googleapis.com/maps/api/js?key=AIzaSyBJSrOfzqB4RHBVV3wHiw5Qh_b0HXVvDus', array(), null, true);
// }
// add_action('wp_enqueue_scripts', 'enqueue_google_maps');

//google maps ACF
function my_custom_scripts()
{
    // wp_enqueue_script('google-maps', 'https://maps.googleapis.com/maps/api/js?key=AIzaSyBJSrOfzqB4RHBVV3wHiw5Qh_b0HXVvDus', [], null, true);

    function enqueue_google_maps_script()
    {
        if (is_page() || is_single()) { // Optional: load only on pages or posts
            wp_enqueue_script(
                'google-maps',
                'https://maps.googleapis.com/maps/api/js?key=AIzaSyBJSrOfzqB4RHBVV3wHiw5Qh_b0HXVvDus&callback=initMap',
                [],
                null,
                true
            );
        }
    }
    add_action('wp_enqueue_scripts', 'enqueue_google_maps_script');

    // Add async + defer to Google Maps script
    add_filter('script_loader_tag', function ($tag, $handle) {
        if ($handle === 'google-maps') {
            return str_replace(' src', ' async defer src', $tag);
        }
        return $tag;
    }, 10, 2);



    wp_enqueue_script('custom-map', get_template_directory_uri() . '/js/bmv-wb.js', array('google-maps', 'jquery'), null, true); // Ensure google-maps is a dependency
}
add_action('wp_enqueue_scripts', 'my_custom_scripts');


// end google maps

function enqueue_jquery()
{
    wp_enqueue_script('jquery');
}
add_action('wp_enqueue_scripts', 'enqueue_jquery');
