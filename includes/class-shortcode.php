<?php

namespace ApplicantForm;

/**
 * The Menu handler class
 */
class Shortcode {

	/**
	 * Initialize the class
	 */
	public function __construct() {
		add_shortcode( 'applicant_form', array( $this, 'show_applicant_form' ) );
	}


	/**
	 * Display applicant form in shortcode
	 *
	 * @param array $atts shortcode attribute.
	 *
	 * @return string
	 */
	public function show_applicant_form( $atts ) {
		$atts = shortcode_atts( array(), $atts );
		ob_start();
		include_once APPLICANTFORM_DIR . '/views/frontend/form.php';
		return ob_get_clean();
	}
}
