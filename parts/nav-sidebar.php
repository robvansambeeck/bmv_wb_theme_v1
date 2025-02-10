<div id="nav-sidebar-overlay" class="nav-sidebar-overlay"></div>

<div class="nav-sidebar">
    <div class="menu-icon" id="menu-icon">
        <div class="bar1"></div>
        <div class="bar2"></div>
        <div class="bar3"></div>
    </div>

    <nav class="sidebar" id="sidebar">
        <?php wp_nav_menu(array(
            'theme_location' => 'Sidebar',
            'menu_class' => 'sidebar-menu'
        )); ?>
    </nav>
</div>