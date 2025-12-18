<div class="sec nav-sidebar">
    <nav class="sec-inner">
        <div class="sec-content">
            <nav class="nav-items">
                <?php wp_nav_menu(array(
                    'theme_location' => 'Sidebar',
                    'menu_class' => 'sidebar-menu'
                )); ?>
            </nav>
            <div class="nav-cta">
                <?php
                // Define social media platforms and icons
                $socials = [
                    'facebook_url' => 'fab fa-facebook-f',
                    // 'twitter_url' => 'fab fa-twitter',
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
    </nav>
</div>
<!-- /nav-sidebar -->