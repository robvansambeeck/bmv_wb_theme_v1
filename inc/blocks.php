<?php

/*
@package (bvm_wb_theme_v1)
=========================
blocks
=========================
*/

function register_acf_block_types()
{
    acf_register_block_type(array(
        'name' => 'Block - Notification',
        'title' => __('Block - Notification'),
        'description' => __('Block met een notificatie'),
        'render_template' => 'blocks/block-notification.php',
        'mode' => 'edit',
        'category' => 'formatting',
        'icon' => 'admin-comments',
        'keywords' => array('block', 'hero'),
    ));
}
add_action('acf/init', 'register_acf_block_types');
