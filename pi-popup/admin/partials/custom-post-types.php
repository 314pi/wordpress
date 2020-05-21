<?php

$labels = array(
	'name'               => _x( 'Subscribers', 'post type general name', 'pi-popup' ),
	'singular_name'      => _x( 'Subscriber', 'post type singular name', 'pi-popup' ),
	'menu_name'          => _x( 'Subscribers', 'admin menu', 'pi-popup' ),
	'name_admin_bar'     => _x( 'Subscriber', 'add new on admin bar', 'pi-popup' ),
	'add_new'            => _x( 'Add New', 'Subscriber', 'pi-popup' ),
	'add_new_item'       => esc_html__( 'Add New Subscriber', 'pi-popup' ),
	'new_item'           => esc_html__( 'New Subscriber', 'pi-popup' ),
	'edit_item'          => esc_html__( 'Edit Subscriber', 'pi-popup' ),
	'view_item'          => esc_html__( 'View Subscriber', 'pi-popup' ),
	'all_items'          => esc_html__( 'All Subscribers', 'pi-popup' ),
	'search_items'       => esc_html__( 'Search Subscriber', 'pi-popup' ),
	'parent_item_colon'  => esc_html__( 'Parent Subscriber:', 'pi-popup' ),
	'not_found'          => esc_html__( 'No Subscriber found.', 'pi-popup' ),
	'not_found_in_trash' => esc_html__( 'No Subscriber found in Trash.', 'pi-popup' )
);

$args = array(
	'labels'             => $labels,
    'description'        => esc_html__( 'Description.', 'pi-popup' ),
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
