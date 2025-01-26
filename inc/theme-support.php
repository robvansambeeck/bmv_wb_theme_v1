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

// dynamically populate filter
function enqueue_filter_script()
{
  wp_enqueue_script('filter', get_template_directory_uri() . '/js/filter.js', array('jquery'), null, true);
  wp_localize_script('filter', 'ajaxurl', admin_url('admin-ajax.php')); // Pass AJAX URL to JavaScript
}
add_action('wp_enqueue_scripts', 'enqueue_filter_script');

function filter_cards()
{
  // Get the selected filter from the AJAX request
  $filter = sanitize_text_field($_POST['filter']);

  // Define query arguments
  $args = array(
    'post_type' => 'post', // Replace 'post' with your custom post type if needed
    'posts_per_page' => -1, // Adjust as necessary
    'category_name' => $filter, // Filter posts by category slug
  );

  // Query the posts
  $query = new WP_Query($args);

  // Generate the HTML for the cards
  if ($query->have_posts()) {
    while ($query->have_posts()) {
      $query->the_post();
?>
      <div class="card">
        <h3><?php the_title(); ?></h3>
        <p><?php the_excerpt(); ?></p>
        <a href="<?php the_permalink(); ?>" class="button">Read More</a>
      </div>
<?php
    }
  } else {
    echo '<p>No items found for this category.</p>';
  }

  wp_die(); // Stop execution after handling the request
}
add_action('wp_ajax_filter_cards', 'filter_cards');
add_action('wp_ajax_nopriv_filter_cards', 'filter_cards');
