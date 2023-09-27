<?php
/*
 * Plugin Name: Easy WP To PDF
 * Version: 2.0.0
 * Plugin URI: https://franticape.com/plugins/faeasypdf
 * Description: WordPress to PDF made easy.
 * Author: Frantic Ape
 * Author URI: https://franticape.com
 * Requires at least: 5.0
 * Tested up to: 6.3.1
 * License: MIT
 * Text Domain: FA Easy pdf
 * Domain Path: /languages/
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

if ( ! class_exists( 'FAEASYPDF' ) ) {

	final class FAEASYPDF {

		private static $instance;
		public $admin;

		public static function instance() {

			if ( ! isset( self::$instance ) && ! ( self::$instance instanceof FAEASYPDF ) ) {

				self::$instance = new FAEASYPDF;

				self::$instance->setup_constants();

				add_action( 'plugins_loaded', array( self::$instance, 'faeasypdf_load_textdomain' ) );

				self::$instance->includes();

			}

			return self::$instance;

		}

		public function faeasypdf_load_textdomain() {

			load_plugin_textdomain( 'FA Easy pdf', false, dirname( plugin_basename( __FILE__ ) ) . '/languages' );

		}

		private function setup_constants() {

			if ( ! defined( 'FAEASYPDF_VERSION' ) ) {
				define( 'FAEASYPDF_VERSION', '2.0.0' );
			}
			if ( ! defined( 'FAEASYPDF_PLUGIN_DIR' ) ) {
				define( 'FAEASYPDF_PLUGIN_DIR', plugin_dir_path( __FILE__ ) );
			}
			if ( ! defined( 'FAEASYPDF_PLUGIN_URL' ) ) {
				define( 'FAEASYPDF_PLUGIN_URL', plugin_dir_url( __FILE__ ) );
			}
			if ( ! defined( 'FAEASYPDF_PLUGIN_FILE' ) ) {
				define( 'FAEASYPDF_PLUGIN_FILE', __FILE__ );
			}

		}

		private function includes() {

			// settings / metaboxes
			if ( is_admin() ) {

				require_once FAEASYPDF_PLUGIN_DIR . 'includes/class-faeasypdf-settings.php';
				$settings = new FAEASYPDF_Settings( $this );

				require_once FAEASYPDF_PLUGIN_DIR . 'includes/class-faeasypdf-admin-api.php';
				$this->admin = new FAEASYPDF_Admin_API();

				require_once FAEASYPDF_PLUGIN_DIR . 'includes/faeasypdf-metaboxes.php';

			}

			// load css / js
			require_once FAEASYPDF_PLUGIN_DIR . 'includes/faeasypdf-load-js-css.php';

			// functions
			require_once FAEASYPDF_PLUGIN_DIR . 'includes/faeasypdf-functions.php';

			// shortcodes
			require_once FAEASYPDF_PLUGIN_DIR . 'includes/class-faeasypdf-template-loader.php';
			require_once FAEASYPDF_PLUGIN_DIR . 'includes/faeasypdf-shortcodes.php';

		}

		public function __clone() {

			_doing_it_wrong( __FUNCTION__, __( 'Cheatin&#8217; huh?', 'faeasypdf' ), FAEASYPDF_VERSION );
		}

		public function __wakeup() {

			_doing_it_wrong( __FUNCTION__, __( 'Cheatin&#8217; huh?', 'faeasypdf' ), FAEASYPDF_VERSION );
		}

	}

}

function faeasypdf() {

	$minPHP= '7.4';

	if ( version_compare( phpversion(), $minPHP, '<' ) ) {

		require_once( ABSPATH . 'wp-admin/includes/plugin.php' );
		deactivate_plugins( '/fa-easypdf/fa-easypdf.php' );

		wp_die(
			'<p>' . 'FA Easy WP to PDF can\'t be activated because it requires at least PHP version ' . $minPHP
			. 'Please update your PHP version (it will also bring a nice performance and security boost!)'
			. '</p>'
			. '<a href="' . admin_url( 'plugins.php' ) . '">' . esc_attr__( 'Back', 'faeasypdf' ) . '</a>'
		);
	} else {

		return faeasypdf::instance();
	}
}

faeasypdf();
