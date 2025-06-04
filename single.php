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
        <div class="wrapper container">
            <div class="col1">
                <?php the_field('locatie_info'); ?>
            </div>
            <div class="col2">

                <?php
                $location = get_field('locatie_map'); // ACF Google Map field with lat & lng
                if ($location): ?>
                    <div id="map" style="height: 400px; width: 100%;"></div>

                    <link
                        rel="stylesheet"
                        href="https://unpkg.com/leaflet@1.9.4/dist/leaflet.css"
                        integrity="sha256-sA+9J8vfd5Rftk2a2Ujv1n1Mb7Z9I7yZ+GeRkM7r4oA="
                        crossorigin="" />
                    <script
                        src="https://unpkg.com/leaflet@1.9.4/dist/leaflet.js"
                        integrity="sha256-o9N1jpp5Bj5R1LVWJ3gFhEM+Nuqv5QcfBcm2C3B9VtY="
                        crossorigin=""></script>

                    <script>
                        document.addEventListener("DOMContentLoaded", function() {
                            var lat = <?php echo esc_js($location['lat']); ?>;
                            var lng = <?php echo esc_js($location['lng']); ?>;

                            var map = L.map('map').setView([lat, lng], 14);

                            L.tileLayer('https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png', {
                                attribution: '&copy; <a href="https://openstreetmap.org/copyright">OpenStreetMap</a> contributors'
                            }).addTo(map);

                            L.marker([lat, lng]).addTo(map);
                        });
                    </script>
                <?php endif; ?>


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