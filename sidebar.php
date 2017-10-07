<?php
/**
 * The sidebar containing the main widget area
 *
 * @link https://developer.wordpress.org/themes/basics/template-files/#template-partials
 *
 * @package Kinderklets
 */

if ( ! is_active_sidebar( 'sidebar-1' ) ) {
	return;
}
?>

<aside id="secondary" class="widget-area kk-aside">
    <div class="kk-profile">
        <img src="/public_html/wp-content/themes/kinderklets/assets/images/debbie-profile.png" alt="Debbie Brugman" class="kk-profile-image rounded-circle">
        <p class="kk-intro kk-intro-small">Debbie Brugman, GZ-Psycholoog (voor kinderen)</p>
    </div>
    <h2>Zoek je vraag</h2>
    <div class="kk-content-box">
	    <?php dynamic_sidebar( 'sidebar-1' ); ?>
    </div>
</aside><!-- #secondary -->
