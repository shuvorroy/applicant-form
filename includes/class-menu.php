<?php

namespace ApplicantForm;

/**
 * The Menu handler class
 */
class Menu {

	/**
	 * Initialize the class
	 */
	public function __construct() {
		add_action( 'admin_menu', array( $this, 'admin_menu' ) );
	}

	/**
	 * Register admin menu
	 */
	public function admin_menu() {
		$base_slug  = 'applicant-form';
		$capability = 'manage_options';

		add_menu_page(
			__( 'Applicants', 'applicant-form' ),
			__( 'Applicants', 'applicant-form' ),
			$capability,
			$base_slug,
			array( $this, 'submission_list' ),
			'dashicons-book-alt',
			55
		);
	}


	/**
	 * Display submisisons
	 */
	public function submission_list() {

		$id     = isset( $_GET['id'] ) ? intval( $_GET['id'] ) : 0;
		$action = isset( $_GET['action'] ) ? sanitize_text_field( wp_unslash( $_GET['action'] ) ) : '';
		if ( 'view' === $action ) {
			$item = Db::get_item( $id );
			include_once APPLICANTFORM_DIR . '/views/admin/submissions-details.php';
		} else {
			if ( 'delete' === $action ) {
				$result = Db::delete_item( $id );
			}
			include_once APPLICANTFORM_DIR . '/views/admin/submissions.php';
		}
	}


}
