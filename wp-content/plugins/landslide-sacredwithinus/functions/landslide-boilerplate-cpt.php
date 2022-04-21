<?php 

// Painting CPT
function create_painting_post_type()
{
    $labels = array(
        'name'              => _x( 'Categories', 'taxonomy general name' ),
        'singular_name'     => _x( 'Category', 'taxonomy singular name' ),
        'search_items'      => __( 'Search Categories' ),
        'all_items'         => __( 'All Categories' ),
        'parent_item'       => __( 'Parent Category' ),
        'parent_item_colon' => __( 'Parent Category:' ),
        'edit_item'         => __( 'Edit Category' ),
        'update_item'       => __( 'Update Category' ),
        'add_new_item'      => __( 'Add New Category' ),
        'new_item_name'     => __( 'New Category Name' ),
        'menu_name'         => __( 'Categories' ),
        'not_found'         => __( 'No Categories found.' )
    );

    $args = array(
        'hierarchical'      => true,
        'labels'            => $labels,
        'show_ui'           => true,
        'show_admin_column' => false,
        'query_var'         => true,
        'rewrite'           => array( 'slug' => 'art/category', 'with_front' => false ),
    );

    register_taxonomy( 'art-category', array( 'painting' ), $args );

    register_post_type('painting',
        array(
        'labels' => array(
            'name' => __('Paintings', 'html5blank'),
            'singular_name' => __('Painting', 'html5blank'),
            'add_new' => __('Add Painting', 'html5blank'),
            'add_new_item' => __('Add New Painting', 'html5blank'),
            'edit_item' => __('Edit Painting', 'html5blank'),
            'new_item' => __('New Painting', 'html5blank'),
            'view_item' => __('View Painting', 'html5blank'),
            'view_items' => __('View Paintings', 'html5blank'),
            'search_items' => __('Search Paintings', 'html5blank'),
            'not_found' => __('No Paintings found', 'html5blank'),
            'not_found_in_trash' => __('No Paintings found in Trash', 'html5blank'),
            'featured_image' => __('Painting Image', 'html5blank'),
            'set_featured_image' => __('Set Painting Image', 'html5blank'), 
            'remove_featured_image' => __('Remove Painting Image', 'html5blank'),
            'use_featured_image' => __('Use Painting Image', 'html5blank'),
        ),
        'public' => true,
        'hierarchical' => false,
        'has_archive' => true,
        'menu_icon' => 'dashicons-format-image',
        'supports' => array(
            'title',
            'editor',
            'thumbnail',
            'excerpt'
        ),
        'taxonomies' => array(
            'art-category',
        ),
        'can_export' => true,
        'rewrite' => array( 'slug' => 'art', 'with_front' => false)
    ));
}

add_action('init', 'create_painting_post_type');

function remove_wp_seo_meta_box() {
}

add_action('add_meta_boxes', 'remove_wp_seo_meta_box', 100);