<?php
/**
 * The header for our theme
 *
 * This is the template that displays all of the <head> section and everything up until <div id="content">
 *
 * @link https://developer.wordpress.org/themes/basics/template-files/#template-partials
 *
 * @package Kinderklets
 */

?>
<!doctype html>
<html <?php language_attributes(); ?>>
<head>
	<meta charset="<?php bloginfo( 'charset' ); ?>">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<link rel="profile" href="http://gmpg.org/xfn/11">

	<?php wp_head(); ?>
</head>

<body <?php body_class(); ?>>
<div id="page" class="site">
	<a class="skip-link screen-reader-text is-none" href="#content"><?php esc_html_e( 'Skip to content', 'kinderklets' ); ?></a>

	<header id="masthead" class="kk-header">
        <a href="" class="kk-menu-toggle js-menu-toggle hidden-md-up">Menu</a>
        <a href="/" title="home">
            <img class="kk-logo" src="/wp-content/themes/kinderklets/assets/images/kinderklets-logo.svg"  alt="Kinderklets.nl logo">
        </a>
	</header><!-- #masthead -->
    <nav id="site-navigation" class="main-navigation">
        <?php
        wp_nav_menu( array(
            'theme_location' => 'main-navigation',
            'menu_id'        => 'main-navigation',
        ) );
        ?>
    </nav><!-- #site-navigation -->
	<div id="content" class="site-content container">
        <div class="row">
