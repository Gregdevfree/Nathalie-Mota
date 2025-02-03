<!-- Template-part pour afficher les photos apparentées (related-photos) -->
<?php
if ( ! defined( 'ABSPATH' ) ) exit; // Sécurité WordPress

if ( isset( $photo ) && $photo instanceof WP_Post ) :
    $photo_id = $photo->ID;
    $photo_title = get_the_title( $photo_id );
    $photo_permalink = get_permalink( $photo_id );
    $photo_thumbnail = get_the_post_thumbnail( $photo_id, 'medium_large' );
    $photo_reference = get_field('reference', $photo_id);
?>
    <article class="related-photo-block">
        <a href="<?php echo esc_url( $photo_permalink ); ?>" class="photo-block-link">
            <div class="photo-block-image">
                <?php echo $photo_thumbnail ? $photo_thumbnail : '<p>Aucune image</p>'; ?>
                <div class="thumbnail-overlay">
                    <a href="<?php echo esc_url( $photo_permalink ); ?>" class="overlay-link overlay-link-eye">
                        <img src="<?php echo get_template_directory_uri(); ?>/assets/images/icon_eye.png" alt="Voir le détail de la photo">
                    </a>
                    <a href="#" class="overlay-link overlay-link-fullscreen" data-photo-id="<?php echo esc_attr($photo_id); ?>">
                        <img src="<?php echo get_template_directory_uri(); ?>/assets/images/icon_fullscreen.png" alt="Voir la photo en plein écran">
                    </a>
                    <div class="photo-info">
                        <div class="photo-info-left">
                            <p><?php echo esc_html($photo_title); ?></p>
                        </div>
                        <div class="photo-info-right">
                            <p><?php echo esc_html($photo_reference); ?></p>
                        </div>
                    </div>
                </div>
            </div>
        </a>
    </article>
<?php endif; ?>