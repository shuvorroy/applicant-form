<?php

namespace ApplicantForm;

/**
 * The main plugin class
 */
final class ApplicantFormPlugin {

	/**
	 * Instance of self
	 *
	 * @var ApplicantFormPlugin
	 */
	private static $instance = null;

	/**
	 * Class constructor
	 */
	private function __construct() {
		add_action( 'plugins_loaded', array( $this, 'init_plugin' ) );
		register_activation_hook( APPLICANTFORM, array( $this, 'activate' ) );
		register_deactivation_hook( APPLICANTFORM, array( $this, 'deactivate' ) );
	}

	/**
	 * Initiate a singleton for.
	 */
	public static function init() {

		if ( null === self::$instance ) {
			self::$instance = new self();
		}

		return self::$instance;
	}

	/**
	 * Initialize the plugin
	 *
	 * @return void
	 */
	public function init_plugin() {
		new Assets();
		new Ajax();

		if ( is_admin() ) {
			new Menu();
		} else {
			new Shortcode();
		}
	}

	/**
	 * Placeholder for activation function
	 *
	 * Nothing being called here yet.
	 *
	 * @return void
	 */
	public function activate() {

		$installed = get_option( 'applicant_form_installed' );

		if ( ! $installed ) {
			update_option( 'applicant_form_installed', time() );
		}

		update_option( 'applicant_form_installed_version', APPLICANTFORM_VERSION );

		// DB init.
		Db::init_db();

	}

	/**
	 * Placeholder for deactivation function
	 *
	 * Nothing being called here yet.
	 *
	 * @return void
	 */
	public function deactivate() {

	}
}
