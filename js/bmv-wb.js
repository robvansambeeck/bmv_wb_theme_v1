////////////////////////
/// (bvm_wb_theme_v1) js
////////////////////////

console.log('js start');

document.addEventListener('DOMContentLoaded', function () {

  // =========================
  // Lazyload video sources
  // =========================
  const video = document.querySelector('video');
  if (video) {
    const sources = video.querySelectorAll('source[data-src]');
    sources.forEach(source => {
      source.src = source.dataset.src;
    });
    video.load();
  }

  // =========================
  // Filter vacatures via REST API
  // =========================
  const buttons = document.querySelectorAll('.filter-button');
  const cardContainer = document.getElementById('card-container');

  function fetchPosts(categorySlug) {
    if (!cardContainer) return;

    cardContainer.innerHTML = '<p>Loading...</p>';

    fetch(`/wp-json/wp/v2/vacature?category_slug=${categorySlug}&_embed&per_page=100`)
      .then(res => res.json())
      .then(data => {
        if (!Array.isArray(data) || !data.length) {
          cardContainer.innerHTML = '<p>No posts found.</p>';
          return;
        }

        data.sort((a, b) =>
          a.title.rendered.localeCompare(b.title.rendered, 'nl', { sensitivity: 'base' })
        );

        cardContainer.innerHTML = data.map(post => {
          const thumb =
            post._embedded?.['wp:featuredmedia']?.[0]?.source_url ??
            'https://via.placeholder.com/300';

          return `
            <a href="${post.link}" class="card card-link">
              <img src="${thumb}" alt="${post.title.rendered}">
              <h3>${post.title.rendered}</h3>
              <hr>
              <p>${post.excerpt.rendered || ''}</p>
              <div class="button">
                Vacature bekijken <i class="fa-regular fa-chevron-right"></i>
              </div>
            </a>
          `;
        }).join('');
      })
      .catch(() => {
        cardContainer.innerHTML = '<p>Er ging iets mis.</p>';
      });
  }

  if (buttons.length && cardContainer) {
    fetchPosts('vacature');

    buttons.forEach(btn => {
      btn.addEventListener('click', function () {
        buttons.forEach(b => b.classList.remove('active'));
        this.classList.add('active');
        fetchPosts(this.dataset.filter);
      });
    });
  }

  // =========================
  // Hamburger / sidebar toggle
  // =========================
  const menuToggle = document.querySelector('#menu-toggle, .menu-toggle');
  const navSidebar = document.querySelector('.nav-sidebar');
  const navMain = document.querySelector('.nav-main');

  if (menuToggle && navSidebar && navMain) {
    menuToggle.addEventListener('click', function () {
      navSidebar.classList.toggle('sidebar-active');
      menuToggle.classList.toggle('change');

      setTimeout(() => {
        navMain.classList.toggle('nav-main-white');
      }, 200);
    });
  }

  // =========================
  // Desktop nav submenu
  // hover (desktop) + click (touch)
  // =========================
  const desktopItems = document.querySelectorAll('.nav-items li.menu-item-has-children');

  desktopItems.forEach(item => {
    const link = item.querySelector(':scope > a');
    const submenu = item.querySelector(':scope > ul');
    if (!link || !submenu) return;

    function closeOthers() {
      desktopItems.forEach(other => {
        if (other !== item) {
          other.classList.remove('open');
          const sub = other.querySelector(':scope > ul');
          if (sub) sub.style.display = 'none';
        }
      });
    }

    // touch click
    link.addEventListener('click', e => {
      if (window.matchMedia('(hover: none)').matches) {
        e.preventDefault();
        const isOpen = item.classList.contains('open');
        closeOthers();
        item.classList.toggle('open', !isOpen);
        submenu.style.display = !isOpen ? 'block' : 'none';
      }
    });

    // hover desktop
    item.addEventListener('mouseenter', () => {
      if (window.matchMedia('(hover: hover)').matches) {
        closeOthers();
        item.classList.add('open');
        submenu.style.display = 'block';
      }
    });

    item.addEventListener('mouseleave', () => {
      if (window.matchMedia('(hover: hover)').matches) {
        item.classList.remove('open');
        submenu.style.display = 'none';
      }
    });
  });

  // =========================
  // Sidebar submenu (click-only) + chevron rotate in JS
  // =========================
  const sidebarItems = document.querySelectorAll('.nav-sidebar li.menu-item-has-children');

  sidebarItems.forEach(item => {
  const link = item.querySelector(':scope > a');
  const submenu = item.querySelector(':scope > ul');
  if (!link || !submenu) return;

  // Voeg chevron span toe (1x)
  let chevron = link.querySelector(':scope > .js-chevron');
  if (!chevron) {
    chevron = document.createElement('span');
    chevron.className = 'js-chevron';
    chevron.setAttribute('aria-hidden', 'true');
    link.appendChild(chevron);
  }

  // Init state (BELANGRIJK: translate + rotate)
  chevron.style.transform = 'translateY(-50%) rotate(0deg)';

  link.addEventListener('click', e => {
    e.preventDefault();

    // accordion: sluit andere open submenu’s
    sidebarItems.forEach(other => {
      if (other !== item) {
        other.classList.remove('open');

        const otherSub = other.querySelector(':scope > ul');
        if (otherSub) otherSub.style.display = 'none';

        const otherChevron = other.querySelector(':scope > a > .js-chevron');
        if (otherChevron) {
          otherChevron.style.transform = 'translateY(-50%) rotate(0deg)';
        }
      }
    });

    const isOpen = item.classList.contains('open');

    item.classList.toggle('open', !isOpen);
    submenu.style.display = !isOpen ? 'block' : 'none';

    // Toggle chevron (OOK hier: translate + rotate)
    chevron.style.transform = !isOpen
      ? 'translateY(-50%) rotate(180deg)'
      : 'translateY(-50%) rotate(0deg)';
  });
});


});

console.log('js end');
