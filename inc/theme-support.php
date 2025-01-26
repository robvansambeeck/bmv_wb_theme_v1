<?php

/*
@package bvm_wb_theme_v1
=========================
THEME SUPPORT FUNCTIONS
=========================
*/

/* MENUS */
function bvm_wb_theme_v1_theme_setup()
{
  add_theme_support('menus');
  register_nav_menu('main', 'Main Menu (on top)');
}

add_action('init', 'bvm_wb_theme_v1_theme_setup');

/* POSTS and FORMATS */
function bvm_wb_theme_v1_post_formats_setup()
{
  add_theme_support('custom-background');
  add_theme_support('custom-header');
  add_theme_support('post-thumbnails');
  add_theme_support('post-formats', array('aside', 'image', 'video', 'gallery'));
  add_theme_support('html5', array('search-form'));
  add_post_type_support('page', 'excerpt');
}

add_action('after_setup_theme', 'bvm_wb_theme_v1_post_formats_setup');

function mytheme_custom_logo_setup()
{
  add_theme_support('custom-logo', [
    'height'      => 100, // Set logo height
    'width'       => 300, // Set logo width
    'flex-height' => true,
    'flex-width'  => true,
    'header-text' => ['site-title', 'site-description'], // Hide text if logo exists
  ]);
}
add_action('after_setup_theme', 'mytheme_custom_logo_setup');

if (function_exists('acf_add_options_page')) {
  acf_add_options_page(array(
    'page_title'    => 'Theme Options',
    'menu_title'    => 'Theme Options',
    'menu_slug'     => 'theme-options',
    'capability'    => 'edit_posts',
    'redirect'      => false
  ));
}
