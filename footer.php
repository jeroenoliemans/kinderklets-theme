<?php
/**
 * The template for displaying the footer
 *
 * Contains the closing of the #content div and all content after.
 *
 * @link https://developer.wordpress.org/themes/basics/template-files/#template-partials
 *
 * @package Kinderklets
 */

?>
        </div><!-- #main bootstrap row -->
	</div><!-- #content -->

	<footer id="colophon" class="kk-footer">
        <nav id="site-navigation" class="footer-navigation">
            <?php
            wp_nav_menu( array(
                'theme_location' => 'footer-navigation',
                'menu_id'        => 'footer-navigation',
            ) );
            ?>
        </nav><!-- #site-navigation -->
	</footer><!-- #colophon -->
</div><!-- #page -->

<?php wp_footer(); ?>

</body>
</html>
