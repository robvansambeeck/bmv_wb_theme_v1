<?php
/*
@package (bvm_wb_theme_v1)
=========================
page-opensollicitatie.php

The page template. Used when an individual Page is queried.
=========================
*/
/*
Template Name: Page Template - Open sollicitatie
Template Post Type: page
*/
?>
<?php get_header(); ?>
<?php get_template_part('parts/header-img'); ?>
<?php get_template_part('parts/breadcrumbs'); ?>
<div class="page-opensollicitatie">
    <div class="page-title">
        <div class="sec-inner container">
            <div class="sec-content">
                <div class="title-wrapper">
                    <h1><?php echo get_the_title(''); ?></h1>
                    <hr>
                </div>
            </div>
        </div>
    </div>
</div>

<div class="container">
    <?php the_content(''); ?>
</div>

<?php get_footer(); ?>
<!-- /page (default page template) -->