<?php
/*
@package (bvm_wb_theme_v1)
=========================
page-thankyou.php

The 404 Not Found template. Used when WordPress cannot find a post or page that matches the query.
=========================
*/
/*
Template Name: Page Template - ThankYou
Template Post Type: page
*/
?>
<?php get_header(); ?>
<div class="notification-wrapper">
    <div class="notification-content container">
        <?php the_content(''); ?>
    </div>
</div>
<?php get_footer(); ?>