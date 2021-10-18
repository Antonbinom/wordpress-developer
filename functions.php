<?php
/*
Подключение стилей и скриптов
*/
add_action( 'wp_enqueue_scripts', 'wp_dev_scripts' );

function wp_dev_scripts() {
	// Подключение стилей
	wp_enqueue_style( 'main', get_stylesheet_uri() );
	// bootstrap.min css
	wp_enqueue_style( 'bootstrap', get_template_directory_uri() . '/plugins/bootstrap/css/bootstrap.css', array(), null );
	// fontawesome css
	wp_enqueue_style('fontawesome', get_template_directory_uri() . '/plugins/fontawesome/css/all.css', array(), null);
	// animate css
	wp_enqueue_style('animate', get_template_directory_uri() . '/plugins/animate-css/animate.css', array(), null );
	// icofont css
	wp_enqueue_style( 'icofont', get_template_directory_uri() . '/plugins/icofont/icofont.css', array(), null );
	// wp_dev css
	wp_enqueue_style( 'wp_dev', get_template_directory_uri() . '/css/style.css', array(), null );

	// Подключение скриптов
	wp_deregister_script('jquery' );
	wp_register_script('jquery', get_template_directory_uri() . '/plugins/jquery/jquery.min.js' );
	wp_enqueue_script('jquery');
	wp_enqueue_script('popper', get_template_directory_uri() . '/plugins/bootstrap/js/popper.min.js', array('jquery'), '1.0.0', true );
	wp_enqueue_script('bootstrap', get_template_directory_uri() . '/plugins/bootstrap/js/bootstrap.min.js', array('jquery'), '1.0.0', true );
	wp_enqueue_script('wow', get_template_directory_uri() . '/plugins/counterup/wow.min.js', array('jquery'), '1.0.0', true );
	wp_enqueue_script('easing', get_template_directory_uri() . '/plugins/counterup/jquery.easing.1.3.js', array('jquery'), '1.0.0', true );
	wp_enqueue_script('waypoint', get_template_directory_uri() . '/plugins/counterup/jquery.waypoints.js', array('jquery'), '1.0.0', true );
	wp_enqueue_script('counterup', get_template_directory_uri() . '/plugins/counterup/jquery.counterup.min.js', array('jquery'), '1.0.0', true );
	wp_enqueue_script('counterup', get_template_directory_uri() . '/plugins/counterup/jquery.counterup.min.js', array('jquery'), '1.0.0', true );
	wp_enqueue_script('google-map', get_template_directory_uri() . '/plugins/google-map/gmap3.min.js', array('jquery'), '1.0.0', true );
	wp_enqueue_script('contact', get_template_directory_uri() . '/plugins/form/contact.js', array('jquery'), '1.0.0', true );
	wp_enqueue_script('custom', get_template_directory_uri() . '/js/custom.js', array('jquery'), '1.0.0', true );

}
?>
