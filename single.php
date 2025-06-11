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
        <div class="sideitem">
            <?php the_field('sideitem'); ?>
        </div>
    </div>
</div>
<div class="page-meta ">
    <div class="meta-location">
        <div class="wrapper">
            <div class="col1">
                <?php the_field('locatie_info'); ?>
            </div>
            <div class="col2">
                <iframe src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d4978.329167546027!2d5.396654277450315!3d51.40003051854031!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x47c6da0d38812abd%3A0x4a0b633edaafefe5!2sHeiberg%2010%2C%205504%20PB%20Veldhoven!5e0!3m2!1snl!2snl!4v1749106471784!5m2!1snl!2snl" width="1100" height="450" style="border:0;" allowfullscreen="" loading="lazy" referrerpolicy="no-referrer-when-downgrade"></iframe>
            </div>
        </div>
    </div>

    <div class="meta-form">
        <div class="wrapper container">
            <div class="sec-content">
                <div class="title-wrapper">
                    <h2>Solliciteer op deze vacature</h2>
                    <hr>
                </div>
            </div>
            <div id="solliciteer">
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
</div>



<?php get_footer(); ?>
<!-- /page (default page template) -->