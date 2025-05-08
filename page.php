<?php
/*
@package (bvm_wb_theme_v1)
=========================
page.php

The page template. Used when an individual Page is queried.
=========================
*/
?>
<?php get_header(); ?>
<?php get_template_part('parts/header-img'); ?>
<?php get_template_part('parts/breadcrumbs'); ?>
<div class="page-title ">
    <div class="sec-inner container">
        <div class="sec-content">
            <div class="title-wrapper">
                <h1><?php echo get_the_title(); ?></h1>
                <hr>
            </div>
        </div>
    </div>
</div>
<div class="page-content container">
    <?php the_content(); ?>
</div>

<?php
// Google Map from ACF
$location = get_field('locatie_map'); // using your custom ACF field name
if ($location): ?>
    <div class="acf-map" style="height: 400px; width: 100%; margin: 40px 0;">
        <div class="marker" data-lat="<?php echo esc_attr($location['lat']); ?>" data-lng="<?php echo esc_attr($location['lng']); ?>"></div>
    </div>

<?php get_footer(); ?>
<!-- /page (default page template) -->