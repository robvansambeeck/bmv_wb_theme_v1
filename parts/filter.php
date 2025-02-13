<div class="sec filter">
    <div class="sec-inner container">
        <div class="sec-content">
            <div class="filter-buttons">
                <?php
                // Get current page slug or query parameter if needed
                $current_page = get_query_var('post_type'); // Adjust based on how your site is structured

                // Define buttons with their respective filters
                $filters = [
                    'vacature' => 'Vacatures',
                    'stage' => 'Stage / Duaal',
                ];

                foreach ($filters as $filter => $label) {
                    $active_class = ($current_page === $filter) ? 'active' : '';
                    echo '<button class="filter-button ' . esc_attr($active_class) . '" data-filter="' . esc_attr($filter) . '">' . esc_html($label) . '</button>';
                }

                // Open sollicitatie
                $open_sollicitatie = get_field('open_sollicitatie', 'option');
                if ($open_sollicitatie) :
                    $url    = $open_sollicitatie['url'];
                    $title  = $open_sollicitatie['title'];
                    $target = $open_sollicitatie['target'] ? $open_sollicitatie['target'] : '_self';

                    // Check if current URL matches the open sollicitation URL
                    $active_class = (strpos($_SERVER['REQUEST_URI'], $url) !== false) ? 'active' : '';
                ?>
                    <a href="<?php echo esc_url($url); ?>" class="filter-button <?php echo esc_attr($active_class); ?>" target="<?php echo esc_attr($target); ?>">
                        <?php echo esc_html($title); ?>
                    </a>
                <?php endif; ?>
            </div>
        </div>
    </div>
</div>


<div id="card-container" class="sec grid container">
    <!-- Cards will be dynamically loaded here -->
</div>