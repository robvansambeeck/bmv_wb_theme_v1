<div id="overlay" class="overlay"></div>
<div class="sec nav nav-main">
    <div class="sec-inner container">
        <div class="sec-content">
            <div class="nav-logo">
                <?php
                if (has_custom_logo()) {
                    the_custom_logo(); // Displays the uploaded logo
                } else {
                    echo '<h1>' . get_bloginfo('name') . '</h1>'; // Fallback: Display site name
                }
                ?>
            </div>
            <a class="menu-toggle" id="menu-toggle">
                <div class="wrapper">
                    <div class="bar1"></div>
                    <div class="bar2"></div>
                    <div class="bar3"></div>
                </div>
            </a>
            <div class="nav-items">
                <?php
                wp_nav_menu([
                    'theme_location' => 'main', // Registered menu location
                    'menu_class'     => '',
                    'fallback_cb'    => false, // Disable fallback to a default menu
                ]);
                ?>
            </div>
            <div class="nav-cta">
                <?php
                // Define social media platforms and icons
                $socials = [
                    'facebook_url' => 'fab fa-facebook-f',
                    'twitter_url' => 'fab fa-twitter',
                    'instagram_url' => 'fab fa-instagram',
                    'linkedin_url' => 'fab fa-linkedin-in',
                ];

                // Loop through each platform
                foreach ($socials as $field => $icon) {
                    $url = get_field($field, 'option'); // Adjust 'option' if not using Options Page
                    if ($url) {
                        echo '<a href="' . esc_url($url) . '" target="_blank" rel="noopener noreferrer">';
                        echo '<i class="' . esc_attr($icon) . '"></i>';
                        echo '</a>';
                    }
                }
                ?>

            </div>
        </div>
    </div>
</div>
<?php get_template_part('parts/nav-sidebar'); ?>
<!-- /nav-sidebar -->