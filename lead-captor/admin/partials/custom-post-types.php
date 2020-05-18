<?php

$labels = array(
	'name'               => _x( 'Subscribers', 'post type general name', 'lead-captor' ),
	'singular_name'      => _x( 'Subscriber', 'post type singular name', 'lead-captor' ),
	'menu_name'          => _x( 'Subscribers', 'admin menu', 'lead-captor' ),
	'name_admin_bar'     => _x( 'Subscriber', 'add new on admin bar', 'lead-captor' ),
	'add_new'            => _x( 'Add New', 'Subscriber', 'lead-captor' ),
	'add_new_item'       => esc_html__( 'Add New Subscriber', 'lead-captor' ),
	'new_item'           => esc_html__( 'New Subscriber', 'lead-captor' ),
	'edit_item'          => esc_html__( 'Edit Subscriber', 'lead-captor' ),
	'view_item'          => esc_html__( 'View Subscriber', 'lead-captor' ),
	'all_items'          => esc_html__( 'All Subscribers', 'lead-captor' ),
	'search_items'       => esc_html__( 'Search Subscriber', 'lead-captor' ),
	'parent_item_colon'  => esc_html__( 'Parent Subscriber:', 'lead-captor' ),
	'not_found'          => esc_html__( 'No Subscriber found.', 'lead-captor' ),
	'not_found_in_trash' => esc_html__( 'No Subscriber found in Trash.', 'lead-captor' )
);

$args = array(
	'labels'             => $labels,
    'description'        => esc_html__( 'Description.', 'lead-captor' ),
	'public'             => true,
	'publicly_queryable' => true,
	'show_ui'            => true,
	'show_in_menu'       => true,
	'query_var'          => true,
	'rewrite'            => array( 'slug' => 'lead-subscriber', 'with_front' => false ),
	'map_meta_cap'        => true,
	'has_archive'        => true,
	'menu_icon'          => 'dashicons-email-alt',
	'hierarchical'       => false,
	'menu_position'      => 75,
	'supports'           => array( 'title', 'custom-fields' )
);
register_post_type( 'lead-subscriber', $args );
