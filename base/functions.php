<?php 
function enqueue_my_scripts() {
	/* jQuery dependency is assumed */
	wp_enqueue_script('theme-js', get_stylesheet_directory_uri() . '/js/scripts.js', array( 'jquery' ));
	wp_enqueue_style('theme-css', get_stylesheet_directory_uri() . '/css/styles.css');
}
add_action( 'wp_enqueue_scripts', 'enqueue_my_scripts' );