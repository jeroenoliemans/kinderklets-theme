<?php
/**
 * Template part for displaying posts
 *
 * @link https://codex.wordpress.org/Template_Hierarchy
 *
 * @package Kinderklets
 */

?>
    <article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
        <header class="entry-header">
            <h3>Vraag</h3>
            <?php the_title( '<h1 class="kk-seo-header-question">', '</h1>' );


            if ( 'post' === get_post_type() ) : ?>
            <div class="entry-meta">
                <?php kinderklets_posted_on(); ?>
            </div><!-- .entry-meta -->
            <?php
            endif; ?>
        </header><!-- .entry-header -->

        <h3>Antwoord</h3>
        <div class="entry-content">
            <?php
                the_content( sprintf(
                    wp_kses(
                        /* translators: %s: Name of current post. Only visible to screen readers */
                        __( 'Continue reading<span class="screen-reader-text"> "%s"</span>', 'kinderklets' ),
                        array(
                            'span' => array(
                                'class' => array(),
                            ),
                        )
                    ),
                    get_the_title()
                ) );

                wp_link_pages( array(
                    'before' => '<div class="page-links">' . esc_html__( 'Pages:', 'kinderklets' ),
                    'after'  => '</div>',
                ) );
            ?>
        </div><!-- .entry-content -->

    </article><!-- #post-<?php the_ID(); ?> -->
