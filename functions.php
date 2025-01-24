<?php
/**
 * Functions and definitions for my theme.
 *
 * @link https://developer.wordpress.org/themes/basics/theme-functions/
 *
 * @package Nathalie Mota
 */

// Enqueue custom scripts and styles
function nathalie_mota_enqueue_scripts_and_styles() {
    // Enqueue the main stylesheet
    wp_enqueue_style('main-style', get_template_directory_uri() . '/style.css', array(), '1.0', 'all');

    // Enqueue the custom JavaScript file
    wp_enqueue_script('custom-script', get_template_directory_uri() . '/assets/js/script.js', array(), '1.0', true);
    
}
add_action('wp_enqueue_scripts', 'nathalie_mota_enqueue_scripts_and_styles');

// Ajouter la prise en charge des menus et du logo personnalisé dans le thème
function nathalie_mota_setup() {
    // Ajouter la prise en charge des menus
    add_theme_support('menus');

    register_nav_menus(array(
        'header-menu' => __('Menu Principal', 'nathalie-mota'),
        'footer-menu' => __('Menu Footer', 'nathalie-mota'),
    ));

    // Activer la prise en charge du logo personnalisé
    add_theme_support('custom-logo', array(
        'height' => 14,
        'width' => 216,
        'flex-height' => true,
        'flex-width' => true,
    ));
}
add_action('after_setup_theme', 'nathalie_mota_setup');
?>
