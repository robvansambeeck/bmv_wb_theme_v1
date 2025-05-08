<div class="sec nav-footer">
    <div class="sec-inner container">
        <div class="sec-content">
            <div class="nav-items">
                <div id="links-paginas">
                    <div class="title-wrap">
                        <h5>Pagina's</h5>
                        <hr>
                    </div>
                    <?php
                    wp_nav_menu([
                        'theme_location' => 'pagina', // Registered menu location
                        'menu_class'     => '', // Custom CSS class for <ul>
                        'container'      => '', // The HTML container element
                        'container_class' => '', // CSS class for the container
                        'fallback_cb'    => false, // Disable fallback to a default menu
                    ]);
                    ?>
                </div>
                <div class="links-diensten">
                    <div class="title-wrap">
                        <h5>Diensten</h5>
                        <hr>
                    </div>
                    <?php
                    wp_nav_menu([
                        'theme_location' => 'diensten', // Registered menu location
                        'menu_class'     => '', // Custom CSS class for <ul>
                        'container'      => '', // The HTML container element
                        'container_class' => '', // CSS class for the container
                        'fallback_cb'    => false, // Disable fallback to a default menu
                    ]);
                    ?>
                </div>
            </div>
            <div class="nav-cta">
                <hr>
                <p>
                    © Copyright 2025 BMV – Bouwers met Visie | <a href="https://www.bmv.nl/algemene-voorwaarden/" target="_blank">Algemene voorwaarden</a>
                </p>
            </div>
        </div>
    </div>
</div>

<!-- /nav-footer -->