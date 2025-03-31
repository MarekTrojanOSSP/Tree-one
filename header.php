<div class="hero-section">
    <div class="hero-background" style="background-image: url('<?php echo get_template_directory_uri(); ?>/images/plemeno.jpg');">
        <div class="hero-overlay"></div>
        <div class="hero-content">
            <h1 class="hero-title"><?php echo get_bloginfo('name'); ?></h1>
            <p class="hero-subtitle"><?php echo get_bloginfo('description'); ?></p>
            <a href="#about" class="hero-button">Learn More</a>
        </div>
    </div>
</div>

<nav class="custom-menu">
    <ul class="menu">
        <li><a href="<?php echo get_permalink(get_page_by_title('Produk stránka')); ?>">Test stránka</a></li>
        <?php
        wp_nav_menu(array(
            'theme_location' => 'header-menu',
            'container' => false,
            'menu_class' => '',
            'depth' => 1,
            'items_wrap' => '%3$s'
        ));
        ?>
    </ul>
</nav>


<?php if (function_exists('custom_breadcrumbs')) custom_breadcrumbs(); ?>
