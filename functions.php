<?php
function one_one_enqueue_styles() {
    wp_enqueue_style(
        'Tree-one',
        get_stylesheet_uri('style.css')
    );
}

function register_custom_menu() {
    register_nav_menu('header-menu', __('Header Menu'));
}
add_action('after_setup_theme', 'register_custom_menu');

function custom_breadcrumbs() {
    // Nastavení
    $separator = ' > '; // Oddělovač mezi drobky
    $home = 'Home'; // Text na HOME link
    $before = '<span class="current">'; // Tag před aktuálním drobkem
    $after = '</span>'; // Tag za aktuálním drobkem

    if (!is_front_page()) {
        echo '<nav class="breadcrumbs">';
        echo '<a href="' . home_url() . '">' . $home . '</a>' . $separator;

        if (is_category() || is_single()) {
            the_category(' ');
            if (is_single()) {
                echo $separator . $before . get_the_title() . $after;
            }
        } elseif (is_page()) {
            echo $before . get_the_title() . $after;
        } elseif (is_home()) {
            echo $before . 'Blog' . $after;
        }

        echo '</nav>';
    }
}

?>