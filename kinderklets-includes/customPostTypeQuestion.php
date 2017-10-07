<?php
/**
 * Created by PhpStorm.
 * User: jeroen
 * Date: 24-9-17
 * Time: 15:14
 */
$kinderklets_labels = array(
    'name'                => _x( 'questions', 'Post Type General Name', 'kinderklets' ),
    'singular_name'       => _x( 'question', 'Post Type Singular Name', 'kinderklets' ),
    'menu_name'           => __( 'Vragen', 'kinderklets' ),
    'parent_item_colon'   => __( 'Parent Question', 'kinderklets' ),
    'all_items'           => __( 'Alle vragen', 'kinderklets' ),
    'view_item'           => __( 'Bekijk vraag', 'kinderklets' ),
    'add_new_item'        => __( 'Nieuwe vraag', 'kinderklets' ),
    'add_new'             => __( 'Nieuwe vraag', 'kinderklets' ),
    'edit_item'           => __( 'Wijzig vraag', 'kinderklets' ),
    'update_item'         => __( 'Update vraag', 'kinderklets' ),
    'search_items'        => __( 'Zoek vraag', 'kinderklets' ),
    'not_found'           => __( 'Not Found', 'kinderklets' ),
    'not_found_in_trash'  => __( 'Not found in Trash', 'kinderklets' ),
);

/*
 * Helper functions
 */
function empty_str( $str ) {
    return ! isset( $str ) || $str === "";
}


/*
 * Kinderklets custom post type Vraag
 */
function kinderklets_custom_post_type($customLabels) {
// retrieve labels
    global $kinderklets_labels;
// set Labels
    $type = 'question';
    $labels = $kinderklets_labels;

// Set other options for Custom Post Type

    $args = array(
        'label'               => __( 'vragen', 'kinderklets' ),
        'description'         => __( 'vragen', 'kinderklets' ),
        'menu-icon'           => 'dashicons-editor-help',
        'labels'              => $labels,
        // Features this CPT supports in Post Editor
        'supports'            => array( 'title', 'editor', 'excerpt', 'revisions', 'custom-fields', ),
        'hierarchical'        => false,
        'public'              => true,
        'show_ui'             => true,
        'show_in_menu'        => true,
        'show_in_nav_menus'   => true,
        'show_in_admin_bar'   => true,
        'menu_position'       => 5,
        'can_export'          => true,
        'has_archive'         => true,
        'taxonomies'          => array( 'category' ),
        'exclude_from_search' => false,
        'publicly_queryable'  => true,
        'capability_type'     => 'page',
    );

    // Registering your Custom Post Type
    register_post_type( $type, $args );

}

/*
 * Add custom fields
 */
function kinderklets_custom_fields(WP_Post $post) {
    add_meta_box('question_meta', 'Vraag Details', function() use ($post) {

        // all the field variables
        $field_name_age = 'questionAge';
        $field_name_email = 'questionEmail';
        $field_name_privacy = 'questionPrivacy';
        $field_name_sex = 'questionSex';
        $field_name_family = 'questionFamily';
        $field_name_school = 'questionSchool';
        $field_name_siblings = 'questionSiblings';

        $field_value_email =get_post_meta($post->ID, $field_name_email, true);
        $field_value_age = get_post_meta($post->ID, $field_name_age, true);

        wp_nonce_field('kinderklets_nonce', 'kinderklets_nonce');

        ?>
        <table class="form-table">
            <tr>
                <th>
                    <label>Privacy / betaald</label>
                </th>
                <td><?php echo get_post_meta($post->ID, $field_name_privacy, true); ?></td>
            </tr>
            <tr>
                <th>
                    <label>Volledige vraag</label>
                </th>
                <td><?php echo get_the_title($post); ?></td>
            </tr>
            <tr>
                <th>
                    <label>E-mailadres</label>
                </th>
                <td><?php echo get_post_meta($post->ID, $field_name_email, true); ?></td>
            </tr>
            <tr>
                <th>
                    <label>Leeftijd kind</label>
                </th>
                <td><?php echo get_post_meta($post->ID, $field_name_age, true); ?></td>
            </tr>
            <tr>
                <th>
                    <label>Geslacht kind</label>
                </th>
                <td><?php echo get_post_meta($post->ID, $field_name_sex, true); ?></td>
            </tr>
            <tr>
                <th>
                    <label>Schooltype</label>
                </th>
                <td><?php echo get_post_meta($post->ID, $field_name_school, true); ?></td>
            </tr>
            <tr>
                <th>
                    <label>Opgroeiend in</label>
                </th>
                <td><?php echo get_post_meta($post->ID, $field_name_family, true); ?></td>
            </tr>
            <tr>
                <th>
                    <label>Samenstelling gezin</label>
                </th>
                <td><?php echo get_post_meta($post->ID, $field_name_siblings, true); ?></td>
            </tr>

<!--            <tr>-->
<!--                <th>-->
<!--                    <label for="--><?php //echo $field_name_age; ?><!--">Leeftijd kind</label>-->
<!--                </th>-->
<!--                <td>-->
<!--                    <input id="--><?php //echo $field_name_age; ?><!--"-->
<!--                           name="--><?php //echo $field_name_age; ?><!--"-->
<!--                           type="text"-->
<!--                           value="--><?php //echo esc_attr($field_value_age); ?><!--"-->
<!--                    />-->
<!--                </td>-->
<!--            </tr>-->
        </table>
        <?php
    });
}

/*
 * create the meta box
 */
function kinderklets_create_meta_box() {
    // retrieve labels
    global $kinderklets_labels;
    $type = 'question';
    $labels = $kinderklets_labels;

    $arguments = [
        'register_meta_box_cb' => 'kinderklets_custom_fields', // Register a meta box
        'rewrite' => [ 'slug' => 'questions' ],
        'has_archive' => true,
        'rest_base' => 'questions',
        'show_in_rest' => false,
        'hierarchical' => false,
        'supports' => array( 'title', 'editor', 'excerpt', 'revisions', 'custom-fields', ),
        'public' => true,
        'description' => 'Kinderklets vragen.',
        'menu_icon' => 'dashicons-editor-help',
        'labels'  => $labels,
    ];
    register_post_type( $type, $arguments);
}

//add_action('save_post', function($post_id){
//    $post = get_post($post_id);
//    $is_revision = wp_is_post_revision($post_id);
//
//    $field_name_age = 'questionAge';
//    $field_name_email = 'questionEmail';
//
//    // Do not save meta for a revision or on autosave
//    if ( $post->post_type != 'question' || $is_revision )
//        return;
//
//    // Secure with nonce field check
//    if (isset($_REQUEST['kinderklets_nonce'])) {
//        check_admin_referer('kinderklets_nonce', 'kinderklets_nonce');
//    }
//
//        // Do not save meta if all fields are not present,
//    // like during a restore.
//    if( !isset($_POST[$field_name_age]) || !isset($_POST[$field_name_email]) )
//        return;
//
//    // Clean up data
//    $field_value_age = trim($_POST[$field_name_age]);
//    $field_value_email = trim($_POST[$field_name_email]);
//
//    // Do the saving and deleting
//    if( ! empty_str( $field_value_age ) ) {
//        update_post_meta($post_id, $field_name_age, $field_value_age);
//    } elseif( empty_str( $field_value_age ) ) {
//        delete_post_meta($post_id, $field_name_age);
//    }
//
//    if( ! empty_str( $field_value_email ) ) {
//        update_post_meta($post_id, $field_name_email, $field_value_email);
//    } elseif( empty_str( $field_value_email ) ) {
//        delete_post_meta($post_id, $field_name_email);
//    }
//});


/*
* init hooks
*/
add_action( 'init', 'kinderklets_custom_post_type', 0 );
add_action( 'init', 'kinderklets_create_meta_box');