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
function enqueue_google_maps()
{
    wp_enqueue_script('google-maps', 'https://maps.googleapis.com/maps/api/js?key=AIzaSyBJSrOfzqB4RHBVV3wHiw5Qh_b0HXVvDus', array(), null, true);
}
add_action('wp_enqueue_scripts', 'enqueue_google_maps');

// end google maps

function enqueue_jquery()
{
    wp_enqueue_script('jquery');
}
add_action('wp_enqueue_scripts', 'enqueue_jquery');
