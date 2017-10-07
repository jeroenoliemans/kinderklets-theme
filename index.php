<?php
/**
 * The main template file
 *
 * This is the most generic template file in a WordPress theme
 * and one of the two required files for a theme (the other being style.css).
 * It is used to display a page when nothing more specific matches a query.
 * E.g., it puts together the home page when no home.php file exists.
 *
 * @link https://codex.wordpress.org/Template_Hierarchy
 *
 * @package Kinderklets
 */

get_header(); ?>

	<div id="primary" class="col-md-8 content-area">
		<main id="main" class="site-main">
            <div class="card kk-content-box">
                <div class="card-block">
                    <p class="kk-intro">Kinderklets.nl is dè plek waar je terecht kunt om je zorgen en vragen over je kind te bespreken. Je vragen worden beantwoordt door een ervaren kinder GZ-psycholoog die ook moeder is van twee kinderen.</p>
                    <div class="d-flex justify-content-between">
                        <a href="#" class="btn btn-primary">Lees meer</a>
                        <p class="kk-intro kk-intro-small">of</p>
                        <a href="#" class="btn btn-primary">Stel een vraag</a>
                    </div>
                </div>
            </div>
            <div class="kk-content-box">
                <h2>De laatste vragen</h2>
                <?php echo do_shortcode('[getlatestquestion]'); ?>

                <?php
                if ( have_posts() ) :

                    if ( is_home() && ! is_front_page() ) : ?>
                        <header>
                            <h1 class="page-title screen-reader-text"><?php single_post_title(); ?></h1>
                        </header>

                    <?php
                    endif;

                    /* Start the Loop */
                    while ( have_posts() ) : the_post();

                        /*
                         * Include the Post-Format-specific template for the content.
                         * If you want to override this in a child theme, then include a file
                         * called content-___.php (where ___ is the Post Format name) and that will be used instead.
                         */
                        get_template_part( 'template-parts/content', get_post_format() );

                    endwhile;

                    the_posts_navigation();

                else :

                    //get_template_part( 'template-parts/content', 'none' );

                endif; ?>
            </div>

		</main><!-- #main -->
	</div><!-- #primary -->
    <div class="col-md-4">
        <?php get_sidebar(); ?>
    </div>


<?php get_footer(); ?>
