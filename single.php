<?php
/*
@package (bvm_wb_theme_v1)
=========================
single.php

The single post template. Used when a single post is queried. For this and all other query templates, index.php is used if the query template is not present.
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
                <h1><?php echo get_the_title(''); ?></h1>
                <hr>
            </div>
        </div>
    </div>
</div>
<div class="page-content container">
    <div class="col col1">
        <?php the_content(''); ?>
    </div>
    <div class="col col2 col-cta">
        <div class="sidebar">
            <?php the_field('sidebar'); ?>
        </div>
    </div>
</div>
<div class="page-meta ">
    <div class="meta-location">
        <div class="wrapper container">
            <div class="col">
                <?php the_field('locatie_info'); ?>
            </div>
            <div class="col">
                <?php the_field('locatie_map'); ?>
            </div>
        </div>
    </div>
    <div class="meta-form">
        <div class="wrapper container">
            <?php
            if (function_exists('get_field') && function_exists('gravity_form')) {
                $form_id = get_field('select_form'); // Get the selected form ID from ACF
                if ($form_id) {
                    gravity_form($form_id, false, false, false, '', true, 1);
                } else {
                    echo '<p>No form selected. Please select a form in the page settings.</p>';
                }
            }
            ?>
        </div>
    </div>
</div>

<?php get_footer(); ?>
<!-- /page (default page template) -->