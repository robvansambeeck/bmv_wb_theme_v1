////////////////////////
/// (bvm_wb_theme_v1) js
/// ////////////////////

console.log("js start");

// Lazyload video sources
document.addEventListener("DOMContentLoaded", function () {
    const videoSources = document.querySelectorAll("video source");
    videoSources.forEach(source => {
        source.src = source.dataset.src; // Set the src attribute from data-src
    });
    const video = document.querySelector("video");
    video.load(); // Load the video after sources are set
});

console.log("js end");
