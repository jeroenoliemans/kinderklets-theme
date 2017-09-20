<?php
/**
 * Template for displaying search forms in Twenty Sixteen
 *
 * @package WordPress
 * @subpackage Twenty_Sixteen
 * @since Twenty Sixteen 1.0
 */
?>

<form role="search" method="get" class="search-form form" action="<?php echo esc_url( home_url( '/' ) ); ?>">
    <div class="form-group row">
        <div class="col-7">
            <input type="search" class="form-control" placeholder="<?php echo esc_attr_x( 'Zoek &hellip;', 'placeholder', 'twentysixteen' ); ?>" value="<?php echo get_search_query(); ?>" name="s" />
        </div>
        <div class="col-5">
            <button type="submit" class="btn btn-primary"><span class="screen-reader-text"><?php echo _x( 'Zoek', 'submit button', 'twentysixteen' ); ?></span></button>
        </div>
    </div>
</form>
