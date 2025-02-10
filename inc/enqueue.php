<?php

/*
@package bvm_wb_theme_v1
=========================
ADMIN ENQUEUE FUNCTIONS
=========================
*/

/* FRONT-END SCRIPTS */
function bvm_wb_theme_v1_script_enqueue()
{
    // Fonts and icons
    wp_enqueue_style('source sanse pro', 'https://use.typekit.net/vik1sup.css', array(), null, 'all');
    // Font Awesome
    wp_enqueue_script('font_awesome', 'https://kit.fontawesome.com/de3d3e56bd.js', array(), null, false);
    // CSS
    wp_enqueue_style('customstyle', get_template_directory_uri() . '/css/bmv-wb.css', array(), '1.0.0', 'all');

    // JS
    wp_enqueue_script('custom-js', get_template_directory_uri() . '/js/bmv-wb.js', array(), '1.0.0', true);
}

add_action('wp_enqueue_scripts', 'bvm_wb_theme_v1_script_enqueue');
