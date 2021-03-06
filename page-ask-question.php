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

            <section id="wordpressPage">
                <?php
                while ( have_posts() ) : the_post();

                    get_template_part( 'template-parts/content', 'page' );

                    // If comments are open or we have at least one comment, load up the comment template.
                    if ( comments_open() || get_comments_number() ) :
                        comments_template();
                    endif;

                endwhile; // End of the loop.
                ?>
            </section>

            <!-- start of the question form-->
            <form action="" id="user-question" data-parsley-validate="">
                <?php wp_nonce_field('kinderklets_nonce', 'kinderklets_nonce'); ?>
                <fieldset class="form-group">
                    <div class="form-check">
                        <label class="form-check-label">
                            <input type="radio" class="form-check-input" name="questionPrivacy" id="questionIsPublic" value="public" data-parsley-errors-container="#privacy-errors" data-parsley-required>
                            Mijn vraag en het antwoord mogen worden gebruikt door kinderklets.nl .
                        </label>
                    </div>
                    <div class="form-check">
                        <label class="form-check-label">
                            <input type="radio" class="form-check-input" name="questionPrivacy" id="questionIsPrivate" value="private" data-parsley-errors-container="#privacy-errors" data-parsley-required>
                            Mijn vraag en het antwoord zijn priv&eacute; en mogen niet worden gebruikt door kinderklets.nl, ik betaal voor het advies/antwoord &euro;19,95 .
                        </label>
                    </div>
                    <div id="privacy-errors"></div>
                </fieldset>
                <div class="form-group">
                    <textarea class="form-control" id="questionQuestion" rows="4" placeholder="Stel je vraag hier..." data-parsley-required></textarea>
                </div>
                <div id="forGroupEmail" class="form-group row">
                    <label class="col-lg-3 col-md-12 col-form-label" for="questionEmail">Email adres</label>
                    <div class="col-lg-9 col-md-12">
                        <input type="email" class="form-control" id="questionEmail" aria-describedby="emailHelp" value="" placeholder="email adres" data-parsley-required>
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
                        <input class="form-control" type="number" value="" id="questionAge"  data-parsley-required>
                    </div>
                </div>
                <div class="form-group row">
                    <label for="" class="col-lg-3 col-md-12 col-form-label">Geslacht kind</label>
                    <div class="col-lg-9 col-md-12">
                        <div class="form-check form-check-inline">
                            <label class="form-check-label">
                                <input class="form-check-input" type="radio" name="questionSex" id="questionSexMale" value="male" data-parsley-errors-container="#sex-errors" data-parsley-required> mannelijk
                            </label>
                        </div>
                        <div class="form-check form-check-inline">
                            <label class="form-check-label">
                                <input class="form-check-input" type="radio" name="questionSex" id="questionSexFemale" value="female" data-parsley-errors-container="#sex-errors" data-parsley-required> vrouwelijk
                            </label>
                        </div>
                        <div id="sex-errors"></div>
                    </div>
                </div>
                <div class="form-group row">
                    <label class="col-lg-3 col-md-12 col-form-label" for="questionSchool">Schooltype</label>
                    <div class="col-lg-9 col-md-12">
                        <select class="form-control" id="questionSchool" data-parsley-required>
                            <option value="">Maak een keuze</option>
                            <option value="regulier">Regulier</option>
                            <option value="speciaal">Speciaal</option>
                            <option value="groep">Groep</option>
                        </select>
                    </div>
                </div>
                <div class="form-group row">
                    <label class="col-lg-3 col-md-12 col-form-label" for="questionFamily">Opgroeiend in</label>
                    <div class="col-lg-9 col-md-12">
                        <select class="form-control" id="questionFamily" data-parsley-required>
                            <option value="">Maak een keuze</option>
                            <option value="1 ouder gezin">&Eacute;&eacute;n ouder gezin</option>
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
                                <input class="form-check-input" type="radio" name="questionSiblings" id="questionSiblingsNone" value="enig kind" data-parsley-errors-container="#sibling-errors" data-parsley-required> enig kind
                            </label>
                        </div>
                        <div class="form-check form-check-inline">
                            <label class="form-check-label">
                                <input class="form-check-input" type="radio" name="questionSiblings" id="questionSiblingsMultiple" value="niet enig kind" data-parsley-errors-container="#sibling-errors" data-parsley-required> &eacute;&eacute;n of meerdere broers zussen
                            </label>
                        </div>
                        <div id="sibling-errors"></div>
                    </div>
                </div>

                <button type="submit" id="questionSubmit" class="btn btn-primary">Verstuur je vraag</button>
            </form>
            <!-- #start of the question form-->

            <section class="is-none" id="thankyouSection">
                <h1>Bedankt</h1>
                <p>Bedankt voor je vraag, binnen 2 werkdagen verschijnt je vraag op de website</p>
                <p>Je vraag zal dan over 2 werkdagen hier <a class="text-link" id="futureQuestionLink" href="">hier</a> te lezen zijn. Kopieer deze link of schrijf het op.</p>

            </section>


		</main><!-- #main -->
	</div><!-- #primary -->


    <div class="col-md-4">
        <?php get_sidebar(); ?>
    </div>


<?php get_footer(); ?>
