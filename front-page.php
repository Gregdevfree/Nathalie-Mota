<?php
/**
 * Template Name: Front Page
 *
 * @package Nathalie Mota
 */

global $post;

get_header();

// Récupérer une image aléatoire parmi les custom post types 'photo' avec la taxonomie 'Formats' => 'paysage'
$args = array(
    'post_type'      => 'photo',
    'posts_per_page' => 1,
    'orderby'        => 'rand',
    'tax_query'      => array(
        array(
            'taxonomy' => 'format',
            'field'    => 'slug',
            'terms'    => 'paysage',
        ),
    ),
);

$query = new WP_Query($args);
$background_image = get_template_directory_uri() . '/assets/images/hero-poster-motaphoto.jpeg'; // Image par défaut

if ($query->have_posts()) {
        $query->the_post();
        if (has_post_thumbnail()) {
            $background_image = get_the_post_thumbnail_url(get_the_ID(), 'full');
        }
        wp_reset_postdata();
}
?>

<div class="hero-overlay">
	<div id="hero-header" class="hero-header" style="background-image: url('<?php echo esc_url($background_image); ?>');">
        <div class="hero-content">
            <h1 class="hero-title">PHOTOGRAPHE EVENT</h1>
        </div>
    </div>
</div>

<!-- Photo Gallery Section -->
<div class="photo-gallery">
    <div class="photo-gallery-container">
        <?php
        $gallery_args = array(
            'post_type'      => 'photo',
            'posts_per_page' => 8,
            'orderby'        => 'date',
            'order'          => 'DESC'
        );

        $gallery_query = new WP_Query($gallery_args);

        if ($gallery_query->have_posts()) :
            while ($gallery_query->have_posts()) : $gallery_query->the_post();
                set_query_var('photo', get_post());
                get_template_part('assets/template_parts/photo_block');
            endwhile;
        endif;
        wp_reset_postdata();
        ?>
    </div>
</div>

<?php get_footer(); ?>
