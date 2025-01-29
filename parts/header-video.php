<header class="sec header video-header">
    <div class="video-overlay"></div>
    <?php
    // Retrieve the video URL from the ACF Options Page
    $header_video = get_field('header_video', 'option');
    ?>
    <video class="header-video lazyload" autoplay muted loop playsinline preload="none" poster="fallback-image.jpg">
        <source data-src="<?php echo esc_url($header_video); ?>" type="video/mp4">
        Your browser does not support the video tag.
    </video>
    <div class="header-content">
        <h1>Samen bouwen aan de toekomst</h1>
        <p>Word jij onze nieuwe collega?</p>
    </div>
</header>
<!-- /header -->