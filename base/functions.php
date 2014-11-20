<?php 
function enqueue_my_scripts() {
    /* Uncompressed development version. Download custom build for production. */
    wp_enqueue_script('Modernizr', get_stylesheet_directory_uri() . '/js/modernizr.js');
    /* jQuery dependency is assumed */
    wp_enqueue_script('theme-js', get_stylesheet_directory_uri() . '/js/scripts.js', array( 'jquery' ));
    wp_enqueue_style('theme-css', get_stylesheet_directory_uri() . '/css/styles.css');
}
add_action( 'wp_enqueue_scripts', 'enqueue_my_scripts' );