<?php
/**
 * WeDevs assigmennt
 *
 * @package sr/applicant-form
 * Plugin Name:       Applicant Form
 * Plugin URI:        https://wedevs.com
 * Description:       A plugin for applicant form
 * Version:           1.0.0
 * Author:            Shuvo Roy
 * Author URI:        https://wedevs.com
 * License:           GNU General Public License v2 or later
 * Text Domain:       applicant-form
 * Domain Path:       /languages
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

require_once __DIR__ . '/vendor/autoload.php';

const VERSION = '1.0.0';


define( 'APPLICANTFORM', __FILE__ );
define( 'APPLICANTFORM_NAME', 'applicant-form' );
define( 'APPLICANTFORM_VERSION', VERSION );
define( 'APPLICANTFORM_DIR', trailingslashit( plugin_dir_path( APPLICANTFORM ) ) );
define( 'APPLICANTFORM_URL', trailingslashit( plugin_dir_url( APPLICANTFORM ) ) );
define( 'APPLICANTFORM_ASSETS', trailingslashit( APPLICANTFORM_URL . 'assets' ) );
define( 'APPLICANTFORM_REST_BASE', 'applicant-form/' );

function log_me($message) {
	if (WP_DEBUG === true) {
		if (is_array($message) || is_object($message)) {
			error_log(print_r($message, true));
		} else {
			error_log($message);
		}
	}
}

/**
 * Load Applicant Form when all plugins loaded
 */

$applicant_form = ApplicantForm\ApplicantFormPlugin::init();
