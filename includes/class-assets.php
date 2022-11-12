<?php

namespace ApplicantForm;

/**
 * The assets class
 */
class Assets {

	/**
	 * The constructor
	 */
	public function __construct() {
		add_action( 'init', array( $this, 'register_all_scripts' ), 10 );

		if ( is_admin() ) {
			add_action( 'admin_enqueue_scripts', array( $this, 'enqueue_admin_scripts' ) );
		} else {
			add_action( 'wp_enqueue_scripts', array( $this, 'enqueue_front_scripts' ) );
		}
	}

	/**
	 * Register all scripts and styles
	 */
	public function register_all_scripts() {
		$styles  = $this->get_styles();
		$scripts = $this->get_scripts();

		$this->register_styles( $styles );
		$this->register_scripts( $scripts );
	}

	/**
	 * Get registered styles
	 *
	 * @return array
	 */
	public function get_styles() {
		// All CSS file list.
		$styles = array(
			'applicant-form-admin'  => array(
				'src'     => APPLICANTFORM_ASSETS . 'css/applicant-form-admin.css',
				'deps'    => array(),
				'version' => filemtime( APPLICANTFORM_DIR . '/assets/css/applicant-form-admin.css' ),
			),
			'applicant-form-public' => array(
				'src'     => APPLICANTFORM_ASSETS . 'css/applicant-form-public.css',
				'deps'    => array(),
				'version' => filemtime( APPLICANTFORM_DIR . '/assets/css/applicant-form-public.css' ),
			),
		);

		return $styles;
	}

	/**
	 * Get all registered scripts
	 *
	 * @return array
	 */
	public function get_scripts() {
		// All JS file list.
		$scripts = array(
			'applicant-form-admin'  => array(
				'src'       => APPLICANTFORM_ASSETS . 'js/applicant-form-admin.js',
				'deps'      => array( 'jquery' ),
				'version'   => filemtime( APPLICANTFORM_DIR . 'assets/js/applicant-form-admin.js' ),
			),
			'applicant-form-public' => array(
				'src'       => APPLICANTFORM_ASSETS . 'js/applicant-form-public.js',
				'deps'      => array( 'jquery', 'wp-util' ),
				'version'   => filemtime( APPLICANTFORM_DIR . 'assets/js/applicant-form-public.js' ),
			),
		);

		return $scripts;
	}

	/**
	 * Register scripts
	 *
	 * @param  array $scripts A collection of scripts file.
	 *
	 * @return void
	 */
	public function register_scripts( $scripts ) {
		foreach ( $scripts as $handle => $script ) {
			$deps      = isset( $script['deps'] ) ? $script['deps'] : false;
			$in_footer = isset( $script['in_footer'] ) ? $script['in_footer'] : true;
			$version   = isset( $script['version'] ) ? $script['version'] : APPLICANTFORM_VERSION;

			wp_register_script( $handle, $script['src'], $deps, $version, $in_footer );
		}
	}

	/**
	 * Register styles
	 *
	 * @param  array $styles A collection of style files.
	 */
	public function register_styles( $styles ) {
		foreach ( $styles as $handle => $style ) {
			$deps    = isset( $style['deps'] ) ? $style['deps'] : false;
			$version = isset( $style['version'] ) ? $style['version'] : APPLICANTFORM_VERSION;

			wp_register_style( $handle, $style['src'], $deps, $version );
		}
	}

	/**
	 * Enqueue admin scripts
	 *
	 * @param  array $hook A collection of style files.
	 */
	public function enqueue_admin_scripts( $hook ) {
		$default_script = array(
			'ajaxurl'  => admin_url( 'admin-ajax.php' ),
			'nonce'    => wp_create_nonce( 'admin_security' ),
		);

		$localize_data = apply_filters( 'applicant_form_localized_args', $default_script );

		// Enqueue scripts.
		wp_enqueue_script( 'applicant-form-admin' );
		wp_localize_script( 'applicant-form-admin', 'applicant_form_admin', $localize_data );

		// Enqueue Styles.
		wp_enqueue_style( 'applicant-form-admin' );
	}

	/**
	 * Enqueue front-end scripts
	 */
	public function enqueue_front_scripts() {
		$default_script = array(
			'ajaxurl'   => admin_url( 'admin-ajax.php' ),
			'security'  => wp_create_nonce( 'applicant_form' ),
		);

		$localize_data = apply_filters( 'applicant_form_localized_args', $default_script );

		// Enqueue scripts.
		wp_enqueue_script( 'applicant-form-public' );
		wp_localize_script( 'applicant-form-public', 'applicant_form', $localize_data );

		wp_enqueue_style( 'applicant-form-public' );
	}
}
