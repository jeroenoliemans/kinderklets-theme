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
        $field_name = 'questionAge';
        $field_value = get_post_meta($post->ID, $field_name, true);
        wp_nonce_field('kinderklets_nonce', 'kinderklets_nonce');
        ?>
        <table class="form-table">
            <tr>
                <th> <label for="<?php echo $field_name; ?>">Leeftijd kind</label></th>
                <td>
                    <input id="<?php echo $field_name; ?>"
                           name="<?php echo $field_name; ?>"
                           type="text"
                           value="<?php echo esc_attr($field_value); ?>"
                    />
                </td>
            </tr>
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

/*
* init hooks
*/
add_action( 'init', 'kinderklets_custom_post_type', 0 );
add_action( 'init', 'kinderklets_create_meta_box');