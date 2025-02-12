<div class="sec filter">
    <div class="sec-inner container">
        <div class="sec-content">
            <div class="filter-buttons">
                <button class="filter-button" data-filter="vacature">Vacatures</button>
                <button class="filter-button" data-filter="stage">Stage / Duaal</button>
                <?php
                // Get the ACF link field. Adjust the field name and location as needed.
                $open_sollicitatie = get_field('open_sollicitatie', 'option'); // Remove 'option' if not in Options Page.
                if ($open_sollicitatie) :
                    // Extract URL, title, and target from the field.
                    $url    = $open_sollicitatie['url'];
                    $title  = $open_sollicitatie['title'];
                    $target = $open_sollicitatie['target'] ? $open_sollicitatie['target'] : '_self';
                ?>
                    <a href="<?php echo esc_url($url); ?>" class="filter-button" target="<?php echo esc_attr($target); ?>">
                        <?php echo esc_html($title); ?>
                    </a>
                <?php endif; ?>
            </div>
        </div>
    </div>
</div>
<!-- /filter -->

<div id="card-container" class="sec grid container">
    <!-- Cards will be dynamically loaded here -->
</div>