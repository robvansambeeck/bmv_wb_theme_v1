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
    const targetElement = document.querySelector(".notification"); // Adjust if needed

    function fetchPosts(categorySlug) {
        // Show loading message
        cardContainer.innerHTML = '<p>Loading...</p>';

        // Fetch posts using the REST API
        const apiUrl = `/wp-json/wp/v2/vacature?category_slug=${categorySlug}&_embed&per_page=100`;
        fetch(apiUrl)
            .then((response) => response.json())
            .then((data) => {
                if (data.length > 0) {
                    cardContainer.innerHTML = data
                        .map((post) => {
                            const thumbnail =
                                post._embedded &&
                                post._embedded["wp:featuredmedia"] &&
                                post._embedded["wp:featuredmedia"][0].source_url
                                    ? post._embedded["wp:featuredmedia"][0].source_url
                                    : "https://via.placeholder.com/300"; // Fallback image

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

    // Function to update active button state
    function updateActiveButton(clickedButton) {
        buttons.forEach((button) => {
            button.classList.remove("active"); // Remove active class from all buttons
        });
        clickedButton.classList.add("active"); // Add active class to the clicked button
    }

    // Load "vacature" posts by default
    fetchPosts("vacature");

    // Add click event listeners to buttons
    buttons.forEach((button) => {
        button.addEventListener("click", function () {
            const categorySlug = this.getAttribute("data-filter");

            // Update active button styling
            updateActiveButton(this);

            // Fetch posts for the selected category
            fetchPosts(categorySlug);
        });
    });
});


 //sidebar
 document.addEventListener('DOMContentLoaded', function() {
    const menuToggle = document.getElementById('menu-toggle');
    const navSidebar = document.querySelector('.nav-sidebar');
    const navMain = document.querySelector('.nav-main');
    
    menuToggle.addEventListener('click', function() {
        // Toggle the sidebar-active class immediately
        navSidebar.classList.toggle('sidebar-active');
        
        // Toggle the "change" class immediately to transform the bars into a cross
        menuToggle.classList.toggle('change');
        
        // Delay toggling the nav-main-white class by 1 second
        setTimeout(function() {
            navMain.classList.toggle('nav-main-white');
        }, 200); 
    });
});

// toggle submenu items nav-main
document.addEventListener('DOMContentLoaded', function () {
    // Select all parent menu items that have children
    const parentLinks = document.querySelectorAll('.nav-items li.menu-item-has-children > a');
  
    parentLinks.forEach(function (link) {
      link.addEventListener('click', function (e) {
        // Prevent navigation if the link is used to toggle the submenu
        e.preventDefault();
  
        const parentLi = this.parentElement;
        const submenu = parentLi.querySelector('ul');
  
        // Toggle the "open" class
        parentLi.classList.toggle('open');
  
        // Toggle submenu visibility by checking its current display state
        if (submenu) {
          submenu.style.display = submenu.style.display === 'block' ? 'none' : 'block';
        }
      });
    });
  });

  //google maps
  (function($) {
    function initMap() {
        $('.acf-map').each(function() {
            var mapElement = $(this);
            var lat = parseFloat(mapElement.data('lat'));
            var lng = parseFloat(mapElement.data('lng'));

            var map = new google.maps.Map(mapElement[0], {
                center: { lat: lat, lng: lng },
                zoom: 14
            });

            new google.maps.Marker({
                position: { lat: lat, lng: lng },
                map: map
            });
        });
    }

    $(document).ready(initMap);
})(jQuery);



console.log("js end");
