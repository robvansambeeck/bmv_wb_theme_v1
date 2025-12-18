<?php
/*
@package (bvm_wb_theme_v1)
=========================
index.php

The main template. If your Theme provides its own templates, index.php must be present.
=========================
*/
?>
<?php get_header(); ?>
<?php get_template_part('parts/header-video'); ?>
<?php get_template_part('parts/filter'); ?>
<?php the_content(''); ?>
<?php get_footer(); ?>
<!-- /index -->