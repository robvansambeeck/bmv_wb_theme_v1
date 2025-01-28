<div class="sec breadcrumbs">
    <div class="sec-inner container">
        <div class="sec-content">
            <?php
            if (function_exists('yoast_breadcrumb')) {
                yoast_breadcrumb('<p id="breadcrumbs">', '</p>');
            }
            ?>
        </div>
    </div>
</div>