<?php

namespace ApplicantForm;

/**
 * The ajax class.
 */
class Ajax {

	/**
	 * Initialize the class
	 */
	public function __construct() {
		add_action( 'wp_ajax_cv_upload', array( $this, 'cv_upload' ) );
		add_action( 'wp_ajax_nopriv_cv_upload', array( $this, 'cv_upload' ) );

		add_action( 'wp_ajax_submit_application', array( $this, 'submit_application' ) );
		add_action( 'wp_ajax_nopriv_submit_application', array( $this, 'submit_application' ) );
	}

	/**
	 * Upload CV
	 */
	public function cv_upload() {

		check_ajax_referer( 'applicant_form', 'security' );

		$upload = array();

		if ( isset( $_FILES['file']['name'] ) ) {
			$upload = wp_upload_bits( $_FILES['file']['name'], null, file_get_contents( $_FILES['file']['tmp_name'] ) );
		}
		wp_send_json( $upload );
	}

	/**
	 * Upload CV
	 */
	public function submit_application() {

		check_ajax_referer( 'applicant_form', 'security' );
		$response = array();
		$response = Db::insert( $_POST );
		wp_send_json( $response );
	}
}
