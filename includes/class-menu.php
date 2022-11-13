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
		add_action( 'wp_dashboard_setup', array( $this, 'dashboard_widget' ) );
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

	/**
	 * Register dashboard widget
	 */
	public function dashboard_widget() {
		$base_slug  = 'applicant-form';
		wp_add_dashboard_widget(
			'applicant-form',
			__( 'Recent Applicants', 'applicant-form' ),
			array( $this, 'widget_content' )
		);
	}

	/**
	 * Display dashboard widget
	 */
	public function widget_content() {
		$args = array(
			'per_page'     => 5,
			'current_page' => 1,
		);
		$result = Db::get_items( $args );
		include_once APPLICANTFORM_DIR . '/views/admin/widget.php';
	}


}
