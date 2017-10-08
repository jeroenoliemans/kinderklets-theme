<?php
/**
 * Created by PhpStorm.
 * User: jeroen
 * Date: 19-9-17
 * Time: 12:57
 */

function kinderklets_all_scriptsandstyles() {
//Load JS and CSS files in here
    wp_register_script ('placeholder', get_stylesheet_directory_uri() . '/build/bundle.js', array( 'jquery' ),'1.0.0',true);

    wp_register_style ('kinderklets-css', get_stylesheet_directory_uri() . '/build/style.css', array(),'1.0.0','all');
    wp_register_style ('googlefonts', 'https://fonts.googleapis.com/css?family=Annie+Use+Your+Telescope', array(),'1.0.0','all');

    wp_enqueue_script('placeholder');

    wp_enqueue_style( 'kinderklets-css');
    wp_enqueue_style( 'googlefonts');
}

add_action( 'wp_enqueue_scripts', 'kinderklets_all_scriptsandstyles' );

function kinderklets_admin_scripts() {
    wp_register_script( 'custom-admin', get_stylesheet_directory_uri() . '/js/kinderklets-wp-admin.js', array('jquery'), true, true);
    wp_enqueue_script('custom-admin');
    wp_localize_script( 'custom-admin', 'kinderkletsData', array(
        'adminAjax' =>  admin_url('admin-ajax.php')
    ));
}

add_action( 'admin_enqueue_scripts','kinderklets_admin_scripts');