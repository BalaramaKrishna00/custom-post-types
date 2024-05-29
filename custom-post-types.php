<?php
// Register Authors Custom Post Type
function register_job_wave_authors_post_type() {
    // Set up the labels
    $labels = array(
        'name'               => 'authors', // Use the same name as the post type
        'singular_name'      => 'author', // Use the same name as the post type
        'menu_name'          => 'Authors',
        'name_admin_bar'     => 'Author',
        'add_new'            => 'Add New',
        'add_new_item'       => 'Add New Author',
        'new_item'           => 'New Author',
        'edit_item'          => 'Edit Author',
        'view_item'          => 'View Author',
        'all_items'          => 'All Authors',
        'search_items'       => 'Search Authors',
        'parent_item_colon'  => 'Parent Authors:',
        'not_found'          => 'No authors found.',
        'not_found_in_trash' => 'No authors found in Trash.'
    );

    // Set up the post type arguments
    $args = array(
        'label'              => 'authors',
        'labels'             => $labels,
        'description'        => 'Author profiles',
        'public'             => true,
        'publicly_queryable' => true,
        'show_ui'            => true,
        'show_in_menu'       => true,
        'query_var'          => true,
        'rewrite'            => array( 'slug' => 'author' ),
        'capability_type'    => 'post',
        'has_archive'        => true,
        'hierarchical'       => false,
        'menu_position'      => 20,
        'supports'           => array( 
            'title', 
            'editor', 
            'thumbnail'
        ),
        'menu_icon'          => 'dashicons-admin-users'
    );

    // Register the post type
    register_post_type( 'authors', $args );
}

add_action( 'init', 'register_job_wave_authors_post_type' );

// Add custom columns for Authors
function custom_author_columns( $columns ) {
    $columns['author_qualifications'] = 'Author Qualifications';
    $columns['author_bio'] = 'Author Bio';
    $columns['instagram_profile'] = 'Instagram Profile';
    $columns['facebook_profile'] = 'Facebook Profile';
    $columns['linkedin_profile'] = 'LinkedIn Profile';
    return $columns;
}

add_filter( 'manage_authors_posts_columns', 'custom_author_columns' );
    
function custom_author_column_data($column, $post_id) {
    switch ($column) {
        case 'author_qualifications':
            echo get_post_meta($post_id, 'author_qualifications', true);
            break;
        case 'author_bio':
            echo get_post_meta($post_id, 'author_bio', true);
            break;
        case 'instagram_profile':
            echo get_post_meta($post_id, 'instagram_profile', true);
            break;
        case 'facebook_profile':
            echo get_post_meta($post_id, 'facebook_profile', true);
            break;
        case 'linkedin_profile':
            echo get_post_meta($post_id, 'linkedin_profile', true);
            break;
    }
}

add_action('manage_authors_posts_custom_column', 'custom_author_column_data', 10, 2);
