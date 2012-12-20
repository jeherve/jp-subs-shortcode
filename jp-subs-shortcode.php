<?php
/*
 * Plugin Name: Jetpack Subscriptions shortcode
 * Plugin URI: http://wordpress.org/extend/plugins/jetpack-subscriptions-shortcode/
 * Description: Extends the Jetpack plugin and allows you to add a Subscription form anywhere inside your posts thanks to the [jpsub] shortcode
 * Author: Jeremy Herve
 * Version: 1.1
 * Author URI: http://jeremyherve.com
 * License: GPL2+
 * Text Domain: jetpack
 */

function tweakjp_sub_shortcode() {

	$args = array(
		'before_widget' => '<div class="widget jetpack_subscription_widget">',
		'after_widget'  => '</div>',
		'before_title'  => '<div class="widget-title">',
		'after_title'   => '</div>',
		'widget_id' => ''
	);
	
	$instance = array(
		'option' => 'value'
	);

	// Check if Jetpack and the subscriptions modules are active
	if (
		class_exists( 'Jetpack' ) && method_exists( 'Jetpack', 'get_active_modules' ) && in_array( 'subscriptions', Jetpack::get_active_modules() )
		) {
		ob_start();
		the_widget( 'Jetpack_Subscriptions_Widget', $instance, $args );
		return ob_get_clean();
	} else {
		return;
	}
}
add_shortcode( 'jpsub', 'tweakjp_sub_shortcode' );
