<?php
if ( ! defined( 'ABSPATH' ) ) exit;

add_action( 'wp_enqueue_scripts', 'faeasypdf_enqueue_styles', 15 );
add_action( 'wp_enqueue_scripts', 'faeasypdf_enqueue_scripts', 10 );
add_action( 'admin_enqueue_scripts', 'faeasypdf_admin_enqueue_scripts', 10, 1 );
add_action( 'admin_enqueue_scripts', 'faeasypdf_admin_enqueue_styles', 10, 1 );

function faeasypdf_enqueue_styles() {
	wp_register_style( 'font-awesome', '//maxcdn.bootstrapcdn.com/font-awesome/4.3.0/css/font-awesome.min.css', array(), '4.3.0' );
	wp_enqueue_style( 'font-awesome' );

	wp_register_style( 'faeasypdf-frontend', plugins_url( 'fa-easypdf/assets/css/frontend.css' ), array(), FAEASYPDF_VERSION );
	wp_enqueue_style( 'faeasypdf-frontend' );
}

function faeasypdf_enqueue_scripts() {
	wp_register_script( 'faeasypdf-frontend', plugins_url( 'fa-easypdf/assets/js/frontend.js' ), array( 'jquery' ), FAEASYPDF_VERSION, true );
	wp_enqueue_script( 'faeasypdf-frontend' );
}

function faeasypdf_admin_enqueue_styles( $hook = '' ) {
	if( isset( $_GET['page'] ) && $_GET['page'] == 'faeasypdf_settings' ) {
		wp_register_style( 'faeasypdf-admin', plugins_url( 'fa-easypdf/assets/css/admin.css' ), array(), FAEASYPDF_VERSION );
		wp_enqueue_style( 'faeasypdf-admin' );
	}
}

function faeasypdf_admin_enqueue_scripts( $hook = '' ) {
	if( isset( $_GET['page'] ) && $_GET['page'] == 'faeasypdf_settings' ) {
		wp_register_script( 'faeasypdf-settings-admin', plugins_url( 'fa-easypdf/assets/js/settings-admin.js' ), array( 'jquery' ), FAEASYPDF_VERSION );
		wp_enqueue_script( 'faeasypdf-settings-admin' );

		wp_register_script( 'faeasypdf-ace', plugins_url( 'fa-easypdf/assets/js/src-min/ace.js' ), array(), FAEASYPDF_VERSION );
		wp_enqueue_script( 'faeasypdf-ace' );

		wp_register_script( 'faeasypdf-admin', plugins_url( 'fa-easypdf/assets/js/admin.js' ), array( 'jquery' ), FAEASYPDF_VERSION );
		wp_enqueue_script( 'faeasypdf-admin' );
	}
}
