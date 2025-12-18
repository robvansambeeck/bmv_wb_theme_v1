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
                    // 🔽 Sort alphabetically by post title
                    data.sort((a, b) => {
                        const titleA = a.title.rendered.toLowerCase();
                        const titleB = b.title.rendered.toLowerCase();
                        return titleA.localeCompare(titleB);
                    });

                    cardContainer.innerHTML = data
                        .map((post) => {
                            const thumbnail =
                                post._embedded &&
                                post._embedded["wp:featuredmedia"] &&
                                post._embedded["wp:featuredmedia"][0].source_url
                                    ? post._embedded["wp:featuredmedia"][0].source_url
                                    : "https://via.placeholder.com/300"; // Fallback image

                            return `
                            <a href="${post.link}" class="card card-link">
                            <img src="${thumbnail}" alt="${post.title.rendered}" class="card-thumbnail" />
                            <h3>${post.title.rendered}</h3>
                            <hr/>
                            <p>${post.excerpt.rendered || "No excerpt available."}</p>
                            <div class="button">Vacature bekijken <i class="fa-regular fa-chevron-right"></i></div>
                            </a>

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

// nav-main toggle
document.addEventListener('DOMContentLoaded', function () {
  const parentItems = document.querySelectorAll('.nav-items li.menu-item-has-children');

  parentItems.forEach(function (item) {
    const link = item.querySelector(':scope > a');
    const submenu = item.querySelector(':scope > ul');

    if (!submenu || !link) return;

    // helper: sluit alle andere submenu’s
    function closeOthers() {
      parentItems.forEach(function (other) {
        if (other !== item) {
          other.classList.remove('open');
          const otherSub = other.querySelector(':scope > ul');
          if (otherSub) otherSub.style.display = 'none';
        }
      });
    }

    // CLICK (mobiel / touch)
    link.addEventListener('click', function (e) {
      if (window.matchMedia('(hover: none)').matches) {
        e.preventDefault();

        const isOpen = item.classList.contains('open');
        closeOthers();

        item.classList.toggle('open', !isOpen);
        submenu.style.display = !isOpen ? 'block' : 'none';
      }
    });

    // HOVER (desktop)
    item.addEventListener('mouseenter', function () {
      if (window.matchMedia('(hover: hover)').matches) {
        closeOthers();
        item.classList.add('open');
        submenu.style.display = 'block';
      }
    });

    item.addEventListener('mouseleave', function () {
      if (window.matchMedia('(hover: hover)').matches) {
        item.classList.remove('open');
        submenu.style.display = 'none';
      }
    });
  });
});


// sidebar toggle 
document.addEventListener('DOMContentLoaded', function () {
  // =========================
  // 1) Hamburger -> sidebar open/dicht
  // =========================
  const menuToggle = document.querySelector('#menu-toggle, .menu-toggle');
  const navSidebar = document.querySelector('.nav-sidebar');

  if (menuToggle && navSidebar) {
    menuToggle.addEventListener('click', function () {
      navSidebar.classList.toggle('sidebar-active');
      menuToggle.classList.toggle('change'); // als je die animatie gebruikt
    });
  }

  // =========================
  // 2) Sidebar submenu toggle (click-only)
  // =========================
  const parentLinks = document.querySelectorAll(
    '.nav-sidebar li.menu-item-has-children > a'
  );

  parentLinks.forEach(function (link) {
    const li = link.parentElement;
    const submenu = li.querySelector(':scope > ul');

    if (!submenu) return;

    link.addEventListener('click', function (e) {
      e.preventDefault();

      // accordion: sluit andere submenu’s
      document
        .querySelectorAll('.nav-sidebar li.menu-item-has-children.open')
        .forEach(function (openLi) {
          if (openLi !== li) {
            openLi.classList.remove('open');
            const openSub = openLi.querySelector(':scope > ul');
            if (openSub) openSub.style.display = 'none';
          }
        });

      // toggle huidige
      const isOpen = li.classList.contains('open');
      li.classList.toggle('open', !isOpen);
      submenu.style.display = !isOpen ? 'block' : 'none';
    });
  });
});




console.log("js end");