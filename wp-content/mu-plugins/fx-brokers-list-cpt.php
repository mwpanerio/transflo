<?php
/*
Plugin Name: Broker List CPT
Plugin URI: https://webfx.com/
Description: Registers New Gallery post type
Version: 1.0
Author: WebFX
Author URI: https://webfx.com/
*/
add_action('init', 'fx_brokers_list');
function fx_brokers_list() {
    $labels = array(
        'name'               => _x( 'Broker List', 'post type general name' ),
        'singular_name'      => _x( 'Broker List', 'post type singular name' ),
        'menu_name'          => _x( 'Broker Lists', 'admin menu' ),
        'name_admin_bar'     => _x( 'Broker Lists', 'add new on admin bar' ),
        'add_new'            => _x( 'Add New', 'Broker List' ),
        'add_new_item'       => __( 'Add New Broker List ' ),
        'new_item'           => __( 'New Broker List' ),
        'edit_item'          => __( 'Edit Broker List' ),
        'view_item'          => __( 'View Broker List' ),
        'all_items'          => __( 'All Broker List' ),
        'search_items'       => __( 'Search Broker List' ),
        'parent_item_colon'  => __( 'Parent Broker List:' ),
        'not_found'          => __( 'No Broker List found.' ),
        'not_found_in_trash' => __( 'No Broker List found in Trash.' )
    );

    $args = array(
        'labels'             => $labels,
        'public'             => true,
        'publicly_queryable' => true,
        'show_ui'            => true,
        'show_in_rest'       => false,
        'show_in_menu'       => true,
        'query_var'          => true,
        'rewrite'            => true,
        'capability_type'    => 'post',
        'has_archive'        => true,
        'hierarchical'       => false,
        'menu_position'      => 8,
        'supports'           => array( 'title', 'author', 'editor', 'thumbnail' ),
        'menu_icon'          => 'dashicons-groups',
    );

    register_post_type( 'brokers_list', $args );
}

/* To register custom taxonomies under brand gallery: */
add_action('init', 'register_brokers_list_category');
function register_brokers_list_category() {

    // brand name
    $brokers_state_label = array(
        'name'              => 'Broker List State',
        'singular_name'     => 'Broker List State',
        'search_items'      => 'Search Broker List State',
        'all_items'         => 'All Broker List State',
        'parent_item'       => 'Parent Broker List State',
        'parent_item_colon' => 'Parent Broker List State:',
        'edit_item'         => 'Edit Broker List State',
        'update_item'       => 'Update Broker List State',
        'add_new_item'      => 'Add New Broker List State',
        'new_item_name'     => 'New Broker List State',
        'menu_name'         => 'Broker List State',
    );
    $brand_args = array(
        'hierarchical'      => true,
        'public'            => true,
        'labels'            => $brokers_state_label,
        'show_ui'           => true,
        'show_admin_column' => true,
        'query_var'         => true,
    );
    register_taxonomy( 'brokers_list_category', array( 'brokers_list' ), $brand_args );

}