<?php
/*
 * Plugin Name: Jetpack Subscriptions shortcode
 * Plugin URI: http://wordpress.org/extend/plugins/jetpack-subscriptions-shortcode/
 * Description: Extends the Jetpack plugin and allows you to add a Subscription form anywhere inside your posts thanks to the [jpsub] shortcode
 * Author: Jeremy Herve
 * Version: 1.0
 * Author URI: http://jeremyherve.com
 * License: GPL2+
 * Text Domain: jetpack
 */

// Check if Jetpack and the subscriptions modules are active
function tweakjp_sub_shortcode_enable() {
	if (
		class_exists( 'Jetpack' ) && method_exists( 'Jetpack', 'get_active_modules' ) && in_array( 'subscriptions', Jetpack::get_active_modules() )
		) {
		add_shortcode( 'jpsub', 'tweakjp_sub_shortcode' );
	} else {
		add_filter( 'the_content', 'tweakjp_sub_rm_shortcode' );
	}
}
add_action( 'plugins_loaded', 'tweakjp_sub_shortcode_enable' );


// Shortcode
function tweakjp_sub_shortcode() {
	ob_start();
	the_widget( 'Jetpack_Subscriptions_Widget', $instance, $args );
	return ob_get_clean();
}

// Remove shortcode from content if any of the modules are not active
function tweakjp_sub_rm_shortcode( $content ) {
	return str_replace( '[jpsub]', '', $content );
}
