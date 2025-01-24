<?php
/**
 * Template pour le footer
 */
?>

</main>
    <footer class="site-footer">
        <div class="container-footer">
            <nav class="footer-navigation">
                <?php
                if (has_nav_menu('footer-menu')) {
                    wp_nav_menu(array(
                        'theme_location' => 'footer-menu',
                        'menu_class' => 'footer-menu',
                        'container' => false,
                        'items_wrap' => '<ul id="%1$s" class="%2$s">%3$s<li class="copyright-item">TOUS DROITS RÉSERVÉS</li></ul>',
                    ));
                }
                ?>
            </nav>
        </div>
    </footer>
<?php
get_template_part("template-parts/modale");
?>

<?php wp_footer();?>

</body>
</html>