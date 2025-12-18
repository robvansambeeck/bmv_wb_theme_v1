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
  register_nav_menu('Sidebar', 'Sidebar Menu (mobiel)');
  register_nav_menu('pagina', 'Footer Menu (paginas)');
  register_nav_menu('diensten', 'Footer Menu (diensten)');
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

// filter
function filter_vacature_by_category_slug($args, $request)
{
  if (!empty($request['category_slug'])) {
    $category = get_term_by('slug', $request['category_slug'], 'category'); // Use 'category' or your taxonomy slug
    if ($category) {
      $args['cat'] = $category->term_id; // Filter by category ID
    }
  }
  return $args;
}
add_filter('rest_vacature_query', 'filter_vacature_by_category_slug', 10, 2);


// Dynamically populate the job title in Gravity Forms text field
add_filter('gform_field_value_job_title', function ($value) {
  // Check if we are on a single post of the 'vacature' custom post type
  if (is_singular('vacature')) {
    return get_the_title(); // Return the current post's title
  }
  return ''; // Default to an empty value if not on a single post
});


// yoast breadcrumbs

add_filter('wpseo_breadcrumb_links', function ($links) {

  if (is_singular('vacature')) {
    return [
      [
        'url'  => home_url('/'),
        'text' => 'Home',
      ],
      [
        'url'  => '',
        'text' => get_the_title(),
      ],
    ];
  }

  return $links;
});
