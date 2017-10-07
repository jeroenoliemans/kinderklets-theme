<?php
/**
 * The template for displaying all single posts
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/#single-post
 *
 * @package Kinderklets
 */

get_header(); ?>

    <div id="primary" class="col-md-8 content-area">
		<main id="main" class="site-main">

		<?php
		while ( have_posts() ) : the_post();

			get_template_part( 'template-parts/content-question', get_post_type() );

		endwhile; // End of the loop.
		?>

		</main><!-- #main -->
	</div><!-- #primary -->

<div class="col-md-4">
    <?php get_sidebar(); ?>
</div>


<?php get_footer(); ?>
