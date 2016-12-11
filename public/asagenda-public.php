<?php

/**
 * The public-facing functionality of the plugin.
 *
 * @link       http://jeanbaptisteaudras.com
 * @since      1.0.0
 *
 * @package    Asagenda
 * @subpackage Asagenda/public
 */

/**
 * The public-facing functionality of the plugin.
 *
 * Defines the plugin name, version, and two examples hooks for how to
 * enqueue the admin-specific stylesheet and JavaScript.
 *
 * @package    Asagenda
 * @subpackage Asagenda/public
 * @author     audrasjb <audrasjb@gmail.com>
 */
 	add_action( 'wp_enqueue_scripts', 'enqueue_styles_asagenda_public' );
	function enqueue_styles_asagenda_public() {
		wp_enqueue_style( 'asagenda-monthly', plugin_dir_url( __FILE__ ) . 'css/monthly.css', array(), '', 'all' );
		wp_enqueue_style( 'asagenda-public', plugin_dir_url( __FILE__ ) . 'css/asagenda-public.css', array(), '', 'all' );
	}

 	add_action( 'wp_enqueue_scripts', 'enqueue_scripts_asagenda_public' );
	function enqueue_scripts_asagenda_public() {
		wp_enqueue_script( 'asagenda-monthly', plugin_dir_url( __FILE__ ) . 'js/monthly.js', array( 'jquery' ), '', false );
		wp_enqueue_script( 'asagenda-public', plugin_dir_url( __FILE__ ) . 'js/asagenda-public.js', array( 'jquery' ), '', false );
	}


