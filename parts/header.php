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
        <h1>Welcome to My Website</h1>
        <p>Experience the best content while enjoying a seamless experience.</p>
    </div>
</header>
<!-- /header -->