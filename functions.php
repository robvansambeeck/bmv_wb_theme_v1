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

// API Google maps
// function enqueue_google_maps()
// {
//     wp_enqueue_script('google-maps', 'https://maps.googleapis.com/maps/api/js?key=AIzaSyBJSrOfzqB4RHBVV3wHiw5Qh_b0HXVvDus', array(), null, true);
// }
// add_action('wp_enqueue_scripts', 'enqueue_google_maps');

//google maps ACF
function my_acf_google_map_api($api)
{
    $api['key'] = 'YOUR_GOOGLE_MAPS_API_KEY';
    return $api;
}
add_filter('acf/fields/google_map/api', 'my_acf_google_map_api');


function enqueue_google_maps_script()
{
    wp_enqueue_script('google-maps', 'https://maps.googleapis.com/maps/api/js?key=YOUR_GOOGLE_MAPS_API_KEY', array(), null, true);
    wp_enqueue_script('acf-maps', get_template_directory_uri() . '/js/acf-maps.js', array('jquery', 'google-maps'), null, true);
}
add_action('wp_enqueue_scripts', 'enqueue_google_maps_script');



// end google maps

function enqueue_jquery()
{
    wp_enqueue_script('jquery');
}
add_action('wp_enqueue_scripts', 'enqueue_jquery');
