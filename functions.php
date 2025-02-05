<?php
/* Functions and definitions for my theme.
 *
 * @link https://developer.wordpress.org/themes/basics/theme-functions/
 *
 * @package Nathalie Mota
 */

// Enqueue custom scripts and styles
function nathalie_mota_enqueue_scripts_and_styles() {
    // Enqueue the main stylesheet
    wp_enqueue_style('main-style', get_template_directory_uri() . '/style.css', array(), '2.0', 'all');

    // Enqueue jQuery (WordPress l'inclut par défaut, mais il faut s'assurer qu'il est bien chargé)
    wp_enqueue_script('jquery');
    
    // Enqueue the custom JavaScript file
    wp_enqueue_script('custom-script', get_template_directory_uri() . '/assets/js/script.js', array('jquery'), '1.0', true);

    // Localize script to pass AJAX URL
    wp_localize_script('custom-script', 'ajax_object', array('ajax_url' => admin_url('admin-ajax.php')));
}
add_action('wp_enqueue_scripts', 'nathalie_mota_enqueue_scripts_and_styles');

// Ajout de la prise en charge des menus dans l'administration et du logo personnalisé dans le thème
function nathalie_mota_setup() {
    // Ajouter la prise en charge des menus
    add_theme_support('menus');

    add_theme_support('post-thumbnails');

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

// Fonction pour récupérer les photos apparentées
function get_related_photos($post_id, $taxonomy, $limit = 2) {
    $terms = wp_get_post_terms($post_id, $taxonomy, array('fields' => 'ids'));

    if (empty($terms)) {
        return new WP_Query();
    }

    $args = array(
        'post_type'      => 'photo',
        'posts_per_page' => $limit,
        'post__not_in'   => array($post_id),
        'tax_query'      => array(
            array(
                'taxonomy' => $taxonomy,
                'field'    => 'term_id',
                'terms'    => $terms,
            ),
        ),
    );

    return new WP_Query($args);
}

// Fonction pour récupérer une image aléatoire depuis les articles de type "photo" avec la taxonomie "formats" => "paysage"
function get_random_photo() {
    $args = array(
        'post_type'      => 'photo',
        'posts_per_page' => 1,
        'orderby'        => 'rand',
        'tax_query'      => array(
            array(
                'taxonomy' => 'formats',
                'field'    => 'slug',
                'terms'    => 'paysage', // Ajout du filtre sur la taxonomie
            ),
        ),
    );

    $query = new WP_Query($args);

    if ($query->have_posts()) {
        $query->the_post();
        $image_url = get_the_post_thumbnail_url(get_the_ID(), 'full');

        wp_send_json_success(array('image' => $image_url));
    } else {
        wp_send_json_success(array('image' => get_template_directory_uri() . '/assets/images/hero-poster-motaphoto.jpeg')); // Image par défaut
    }

    wp_die();
}

// Enregistrer les actions AJAX pour les utilisateurs connectés et non connectés
add_action('wp_ajax_get_random_photo', 'get_random_photo');
add_action('wp_ajax_nopriv_get_random_photo', 'get_random_photo');
