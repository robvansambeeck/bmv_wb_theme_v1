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
    const targetElement = document.querySelector(".notification"); // Replace with your target element

    function fetchPosts(categorySlug) {
        // Show loading message
        cardContainer.innerHTML = '<p>Loading...</p>';

        // Fetch posts using the REST API
        const apiUrl = `/wp-json/wp/v2/vacature?category_slug=${categorySlug}&_embed`;
        fetch(apiUrl)
            .then((response) => response.json())
            .then((data) => {
                if (data.length > 0) {
                    // Generate HTML for each post
                    cardContainer.innerHTML = data
                        .map((post) => {
                            // Extract the thumbnail URL
                            const thumbnail =
                                post._embedded &&
                                post._embedded["wp:featuredmedia"] &&
                                post._embedded["wp:featuredmedia"][0].source_url
                                    ? post._embedded["wp:featuredmedia"][0].source_url
                                    : "https://via.placeholder.com/300"; // Fallback image if no thumbnail

                            return `
                            <div class="card">
                            <img src="${thumbnail}" alt="${post.title.rendered}" class="card-thumbnail" />
                            <h3>${post.title.rendered}</h3>
                            <hr />
                            <p>${post.excerpt.rendered || "No excerpt available."}</p>
                            <a href="${post.link}" class="button">Vacature bekijken <i class="fa-regular fa-chevron-right"></i></a>
                        </div>
                            `;
                        })
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

            // Check if "Stage / Duaal" button is clicked
            if (categorySlug === "stage") {
                targetElement.classList.add("active-class"); // Add class to the specific element
            } else {
                targetElement.classList.remove("active-class"); // Remove class if another button is clicked
            }

            // Fetch posts for the selected category
            fetchPosts(categorySlug);
        });
    });
});





console.log("js end");
