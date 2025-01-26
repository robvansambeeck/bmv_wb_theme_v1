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

// filter via rest api
document.addEventListener("DOMContentLoaded", function () {
    const buttons = document.querySelectorAll(".filter-button");
    const cardContainer = document.getElementById("card-container");

    // Function to fetch and populate posts
    function fetchPosts(categorySlug) {
        // Show loading message
        cardContainer.innerHTML = '<p>Loading...</p>';

        // Fetch posts using the REST API
        const apiUrl = `/wp-json/wp/v2/vacature?category_slug=${categorySlug}`;
        fetch(apiUrl)
            .then((response) => response.json())
            .then((data) => {
                if (data.length > 0) {
                    // Populate the container with posts
                    cardContainer.innerHTML = data
                        .map(
                            (post) => `
                                <div class="card">
                                    <h3>${post.title.rendered}</h3>
                                    <p>${post.excerpt.rendered || "No excerpt available."}</p>
                                    <a href="${post.link}" class="button">Read More</a>
                                </div>
                            `
                        )
                        .join("");
                } else {
                    cardContainer.innerHTML = "<p>No posts found for this category.</p>";
                }
            })
            .catch((error) => {
                console.error("Error fetching posts:", error);
                cardContainer.innerHTML = "<p>Something went wrong. Please try again later.</p>";
            });
    }

    // Load "vacature" posts by default
    fetchPosts("vacature");

    // Add click event listeners to buttons
    buttons.forEach((button) => {
        button.addEventListener("click", function () {
            const categorySlug = this.getAttribute("data-filter");
            fetchPosts(categorySlug);
        });
    });
});



console.log("js end");
