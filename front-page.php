<?php
/*
@package (bvm_wb_theme_v1)
=========================
front-page.php

The front page template.
=========================
*/
/*
Template Name: Page Template - Front
Template Post Type: page
*/
?>
<?php get_header(); ?>
    <?php get_template_part('parts/header-video'); ?>
    <?php get_template_part('parts/filter'); ?>
    <?php the_content(''); ?>

<?php get_footer(); ?>