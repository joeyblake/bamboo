<?php
add_action('init', 'bam_init');
add_action('admin_bar_menu', 'bam_admin_bar_menu', 1000);
add_action('wp_enqueue_scripts', 'bam_wp_enqueue_scripts');
add_action('admin_enqueue_scripts', 'bam_wp_enqueue_scripts');

function bam_init() {
  
  register_post_type('bb_purchase', array(
    'public' => false,
    'publicly_queryable' => false,
    'show_ui' => false, 
    'show_in_menu' => false, 
    'query_var' => false,
    'rewrite' => false,
    'capability_type' => 'post',
    'has_archive' => false, 
    'hierarchical' => false,
    'menu_position' => null
  ));

  register_post_type('bb_product', array(
    'public' => false,
    'publicly_queryable' => false,
    'show_ui' => false, 
    'show_in_menu' => false, 
    'query_var' => false,
    'rewrite' => false,
    'capability_type' => 'post',
    'has_archive' => false, 
    'hierarchical' => false,
    'menu_position' => null
  ));
}

function bam_wp_enqueue_scripts() {

}

function bam_admin_bar_menu() {

}
