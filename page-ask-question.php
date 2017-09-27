<?php
/**
 * Template Name: Ask Question
 *
 * @package WordPress
 * @subpackage Kinderklets
 */

get_header(); ?>

	<div id="primary" class="col-md-8 content-area">
		<main id="main" class="site-main">

			<?php
			while ( have_posts() ) : the_post();

				get_template_part( 'template-parts/content', 'page' );

				// If comments are open or we have at least one comment, load up the comment template.
				if ( comments_open() || get_comments_number() ) :
					comments_template();
				endif;

			endwhile; // End of the loop.
			?>

            <!-- start of the question form-->
            <form action="" id="user-post">
                <?php wp_nonce_field('kinderklets_nonce', 'kinderklets_nonce'); ?>
                <fieldset class="form-group">
                    <div class="form-check">
                        <label class="form-check-label">
                            <input type="radio" class="form-check-input" name="questionPrivacy" id="questionIsPublic" value="public">
                            Mijn vraag en het antwoord mogen worden gebruikt door kinderklets.nl .
                        </label>
                    </div>
                    <div class="form-check">
                        <label class="form-check-label">
                            <input type="radio" class="form-check-input" name="questionPrivacy" id="questionIsPrivate" value="private">
                            Mijn vraag en het antwoord zijn priv&eacute; en mogen niet worden gebruikt door kinderklets.nl, ik betaal voor het advies/antwoord &euro;19,95 .
                        </label>
                    </div>
                </fieldset>
                <div class="form-group">
                    <textarea class="form-control" id="questionQuestion" rows="4" placeholder="Stel je vraag hier..."></textarea>
                </div>
                <div class="form-group row">
                    <label class="col-lg-3 col-md-12 col-form-label" for="questionEmail">Email adres</label>
                    <div class="col-lg-9 col-md-12">
                        <input type="email" class="form-control" id="questionEmail" aria-describedby="emailHelp" placeholder="email adres">
                        <small id="emailHelp" class="form-text text-muted">Om je eventueel een extra vraag te stellen, om tot een goed antwoord te komen.</small>
                    </div>
                </div>

                <hr />

                <p class="text-muted">
                    Onderstaande vragen worden gebruikt voor het advies maar verschijnen niet op de site
                </p>

                <div class="form-group row">
                    <label for="questionAge" class="col-lg-3 col-md-12 col-form-label">Leeftijd kind</label>
                    <div class="col-lg-9 col-md-12">
                        <input class="form-control" type="number" value="" id="questionAge">
                    </div>
                </div>
                <div class="form-group row">
                    <label for="" class="col-lg-3 col-md-12 col-form-label">Geslacht kind</label>
                    <div class="col-lg-9 col-md-12">
                        <div class="form-check form-check-inline">
                            <label class="form-check-label">
                                <input class="form-check-input" type="radio" name="questionSex" id="questionSexMale" value="male"> mannelijk
                            </label>
                        </div>
                        <div class="form-check form-check-inline">
                            <label class="form-check-label">
                                <input class="form-check-input" type="radio" name="questionSex" id="questionSexFemale" value="female"> vrouwelijk
                            </label>
                        </div>
                    </div>
                </div>
                <div class="form-group row">
                    <label class="col-lg-3 col-md-12 col-form-label" for="questionSchool">Schooltype</label>
                    <div class="col-lg-9 col-md-12">
                        <select class="form-control" id="questionSchool">
                            <option value="regulier">Regulier</option>
                            <option value="speciaal">Speciaal</option>
                            <option value="groep">Groep</option>
                        </select>
                    </div>
                </div>
                <div class="form-group row">
                    <label class="col-lg-3 col-md-12 col-form-label" for="questionFamily">Opgroeiend in</label>
                    <div class="col-lg-9 col-md-12">
                        <select class="form-control" id="questionFamily">
                            <option value="1 ouder gzin">&Eacute;&eacute;n ouder gezin</option>
                            <option value="beide ouders">Beide ouders gezin</option>
                            <option value="Samengesteld gezin">Samengesteld gezin</option>
                        </select>
                    </div>
                </div>
                <div class="form-group row">
                    <label for="" class="col-lg-3 col-md-12 col-form-label">Samenstelling gezin
                    </label>
                    <div class="col-lg-9 col-md-12">
                        <div class="form-check form-check-inline">
                            <label class="form-check-label">
                                <input class="form-check-input" type="radio" name="questionSiblings" id="questionSiblingsNone" value="enig kind"> enig kind
                            </label>
                        </div>
                        <div class="form-check form-check-inline">
                            <label class="form-check-label">
                                <input class="form-check-input" type="radio" name="questionSiblings" id="questionSiblingsMultiple" value="niet enig kind"> &eacute;&eacute;n of meerdere broers zussen
                            </label>
                        </div>
                    </div>
                </div>

                <button type="submit" id="questionSubmit" class="btn btn-primary">Verstuur je vraag</button>
            </form>
            <!-- #start of the question form-->


		</main><!-- #main -->
	</div><!-- #primary -->


    <div class="col-md-4">
        <?php get_sidebar(); ?>
    </div>


<?php get_footer(); ?>
