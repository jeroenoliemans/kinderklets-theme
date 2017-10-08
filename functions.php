<?php
/**
 * Kinderklets functions and definitions
 *
 * @link https://developer.wordpress.org/themes/basics/theme-functions/
 *
 * @package Kinderklets
 */

if ( ! function_exists( 'kinderklets_setup' ) ) :
	/**
	 * Sets up theme defaults and registers support for various WordPress features.
	 *
	 * Note that this function is hooked into the after_setup_theme hook, which
	 * runs before the init hook. The init hook is too late for some features, such
	 * as indicating support for post thumbnails.
	 */
	function kinderklets_setup() {
		/*
		 * Make theme available for translation.
		 * Translations can be filed in the /languages/ directory.
		 * If you're building a theme based on Kinderklets, use a find and replace
		 * to change 'kinderklets' to the name of your theme in all the template files.
		 */
		load_theme_textdomain( 'kinderklets', get_template_directory() . '/languages' );

		// Add default posts and comments RSS feed links to head.
		add_theme_support( 'automatic-feed-links' );

		/*
		 * Let WordPress manage the document title.
		 * By adding theme support, we declare that this theme does not use a
		 * hard-coded <title> tag in the document head, and expect WordPress to
		 * provide it for us.
		 */
		add_theme_support( 'title-tag' );

		/*
		 * Enable support for Post Thumbnails on posts and pages.
		 *
		 * @link https://developer.wordpress.org/themes/functionality/featured-images-post-thumbnails/
		 */
		add_theme_support( 'post-thumbnails' );

		// This theme uses wp_nav_menu() in one location.
		register_nav_menus( array(
			'main-navigation' => esc_html__( 'MainNavigation', 'kinderklets' ),
            'footer-navigation' => esc_html__( 'FooterNavigation', 'kinderklets' ),
		) );

		/*
		 * Switch default core markup for search form, comment form, and comments
		 * to output valid HTML5.
		 */
		add_theme_support( 'html5', array(
			'search-form',
			'comment-form',
			'comment-list',
			'gallery',
			'caption',
		) );

		// Set up the WordPress core custom background feature.
		add_theme_support( 'custom-background', apply_filters( 'kinderklets_custom_background_args', array(
			'default-color' => 'ffffff',
			'default-image' => '',
		) ) );

		// Add theme support for selective refresh for widgets.
		add_theme_support( 'customize-selective-refresh-widgets' );

		/**
		 * Add support for core custom logo.
		 *
		 * @link https://codex.wordpress.org/Theme_Logo
		 */
		add_theme_support( 'custom-logo', array(
			'height'      => 250,
			'width'       => 250,
			'flex-width'  => true,
			'flex-height' => true,
		) );
	}
endif;
add_action( 'after_setup_theme', 'kinderklets_setup' );

/**
 * Set the content width in pixels, based on the theme's design and stylesheet.
 *
 * Priority 0 to make it available to lower priority callbacks.
 *
 * @global int $content_width
 */
function kinderklets_content_width() {
	$GLOBALS['content_width'] = apply_filters( 'kinderklets_content_width', 640 );
}
add_action( 'after_setup_theme', 'kinderklets_content_width', 0 );

/**
 * Register widget area.
 *
 * @link https://developer.wordpress.org/themes/functionality/sidebars/#registering-a-sidebar
 */
function kinderklets_widgets_init() {
	register_sidebar( array(
		'name'          => esc_html__( 'Sidebar', 'kinderklets' ),
		'id'            => 'sidebar-1',
		'description'   => esc_html__( 'Add widgets here.', 'kinderklets' ),
		'before_widget' => '<section id="%1$s" class="widget %2$s">',
		'after_widget'  => '</section>',
		'before_title'  => '<h2 class="widget-title">',
		'after_title'   => '</h2>',
	) );
}
add_action( 'widgets_init', 'kinderklets_widgets_init' );

/**
 * Enqueue scripts and styles.
 */
function kinderklets_scripts() {
	wp_enqueue_style( 'kinderklets-style', get_stylesheet_uri() );

	wp_enqueue_script( 'kinderklets-navigation', get_template_directory_uri() . '/js/navigation.js', array(), '20151215', true );

	wp_enqueue_script( 'kinderklets-skip-link-focus-fix', get_template_directory_uri() . '/js/skip-link-focus-fix.js', array(), '20151215', true );
    // create object for javascript usage
    wp_localize_script( 'kinderklets-skip-link-focus-fix', 'kinderkletsData', array(
        'adminAjax' =>  admin_url('admin-ajax.php'),
        'security' => wp_create_nonce('kinderklets')
    ));

    if ( is_singular() && comments_open() && get_option( 'thread_comments' ) ) {
		wp_enqueue_script( 'comment-reply' );
	}
}

add_action( 'wp_enqueue_scripts', 'kinderklets_scripts' );

/**
 * Implement the Custom Header feature.
 */
require get_template_directory() . '/inc/custom-header.php';

/**
 * Custom template tags for this theme.
 */
require get_template_directory() . '/inc/template-tags.php';

/**
 * Functions which enhance the theme by hooking into WordPress.
 */
require get_template_directory() . '/inc/template-functions.php';

/**
 * Customizer additions.
 */
require get_template_directory() . '/inc/customizer.php';

/**
 * Load Jetpack compatibility file.
 */
if ( defined( 'JETPACK__VERSION' ) ) {
	require get_template_directory() . '/inc/jetpack.php';
}

/**
 * Kinderklets php includes into functions.
 */
require_once('kinderklets-includes/scriptsAndStyles.php');
require_once('kinderklets-includes/customPostTypeQuestion.php');
require_once('kinderklets-includes/customShortCodes.php');

/**
 * Kinderklets process question
 */
function kinderklets_process_question_post() {

    if(! check_ajax_referer('kinderklets_nonce', 'security')) {
        wp_send_json_error('security check failed');
    }

    $question_data = array(
        'post_title' => sanitize_text_field($_POST[data][questionQuestion]),
        'post_status' => 'draft',
        'post_type' => 'question'
    );

    $post_id = wp_insert_post($question_data, true);

    //update custom fields
    $field_name_age = 'questionAge';
    $field_name_email = 'questionEmail';
    $field_name_privacy = 'questionPrivacy';
    $field_name_sex = 'questionSex';
    $field_name_family = 'questionFamily';
    $field_name_school = 'questionSchool';
    $field_name_siblings = 'questionSiblings';

    if($post_id) {
        update_post_meta($post_id, $field_name_age, sanitize_text_field($_POST[data][questionAge]));
        update_post_meta($post_id, $field_name_email, sanitize_text_field($_POST[data][questionEmail]));
        update_post_meta($post_id, $field_name_privacy, sanitize_text_field($_POST[data][questionPrivacy]));
        update_post_meta($post_id, $field_name_sex, sanitize_text_field($_POST[data][questionSex]));
        update_post_meta($post_id, $field_name_family, sanitize_text_field($_POST[data][questionFamily]));
        update_post_meta($post_id, $field_name_school, sanitize_text_field($_POST[data][questionSchool]));
        update_post_meta($post_id, $field_name_siblings, sanitize_text_field($_POST[data][questionSiblings]));
    }

    wp_send_json_success($post_id);
}

add_action('wp_ajax_kinderklets_process_question_post', 'kinderklets_process_question_post');
add_action('wp_ajax_nopriv_kinderklets_process_question_post', 'kinderklets_process_question_post');

// make sure that the questions get displayed on the categorie pages
add_filter('pre_get_posts', 'query_post_type');
function query_post_type($query) {
    if( is_category() ) {
        $post_type = get_query_var('post_type');
        if($post_type)
            $post_type = $post_type;
        else
            $post_type = array('nav_menu_item', 'post', 'question'); // don't forget nav_menu_item to allow menus to work!
        $query->set('post_type',$post_type);
        return $query;
    }
}

// email from wp-admin function
function kinderklets_send_email($email_data){
    //Your submission processing
    $to = $email_data[emailAddress];
    $subject = 'Antwoord op je vraag via Kinderklets.nl';
    $message = $email_data[question];
    $headers = array('Content-Type: text/html; charset=UTF-8');

    wp_mail( $to, $subject, $message, $headers );
}


function kinderklets_email_question_answer() {
    if(! check_ajax_referer('kinderklets_nonce', 'security')) {
        wp_send_json_error('security check failed');
    }

    $email_data = array(
        'question' => sanitize_text_field($_POST[data][question]),
        'emailAddress' => sanitize_text_field($_POST[data][emailAddress])
    );

    kinderklets_send_email($email_data);

    wp_send_json_success($email_data[question]);
}

add_action('wp_ajax_kinderklets_email_question_answer', 'kinderklets_email_question_answer');
