<?php

/*
@package (bvm_wb_theme_v1)
=========================
Custom post types
=========================
*/


function create_custom_post_type()
{
    $labels = array(
        'name' => _x('Vacatures', 'post type general name', 'textdomain'),
        'singular_name' => _x('Vacature', 'post type singular name', 'textdomain'),
        'menu_name' => _x('Vacatures', 'admin menu', 'textdomain'),
        'name_admin_bar' => _x('Vacature', 'add new on admin bar', 'textdomain'),
        'add_new' => _x('Add New', 'custom post', 'textdomain'),
        'add_new_item' => __('Add New vacature', 'textdomain'),
        'new_item' => __('New vacature', 'textdomain'),
        'edit_item' => __('Edit vacature', 'textdomain'),
        'view_item' => __('View vacature', 'textdomain'),
        'all_items' => __('All Custom vacatures', 'textdomain'),
        'search_items' => __('Search vacatures', 'textdomain'),
        'parent_item_colon' => __('Parent Custom Posts:', 'textdomain'),
        'not_found' => __('No custom posts found.', 'textdomain'),
        'not_found_in_trash' => __('No custom posts found in Trash.', 'textdomain'),
    );

    $args = array(
        'labels' => $labels,
        'description' => __('Vacatures berichten.', 'textdomain'),
        'public' => true,
        'publicly_queryable' => true,
        'show_ui' => true,
        'show_in_menu' => true,
        'query_var' => true,
        'rewrite' => array('slug' => 'vacature'),
        'capability_type' => 'post',
        'has_archive' => true,
        'hierarchical' => false,
        'menu_position' => 2,
        'menu_icon' => 'dashicons-megaphone', // Change the dashicon as needed
        'supports' => array('title', 'editor', 'thumbnail', 'excerpt', 'comments'),
        'taxonomies'         => array('category'), // Enable categories
    );

    register_post_type('custom_post', $args);
}
add_action('init', 'create_custom_post_type');
