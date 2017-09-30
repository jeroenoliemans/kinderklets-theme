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
</div><!-- #page -->

<footer class="kk-footer">
    <div class="kk-footer-navigation">
        <nav id="site-navigation" class="footer-navigation">
            <?php
            wp_nav_menu( array(
                'theme_location' => 'footer-navigation',
                'menu_id'        => 'footer-navigation',
            ) );
            ?>
        </nav><!-- #site-navigation -->
    </div><!-- #colophon -->
    <div class="kk-footer-meta">
        <div class="container text-center">
            kvk btw iban <a href="mailto:info@kinderklets.nl">info@kinderklets.nl</a>
        </div>
    </div>
</footer>

<div id="kkLoader" class="kk-loader is-none">
    <i class="icon-spinning icon-loader icon-refresh-cw"></i>
</div>


<?php wp_footer(); ?>

</body>
</html>
