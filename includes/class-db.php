<?php

namespace ApplicantForm;

/**
 * The frontend class
 */
class Db {

	/**
	 * Initialize DB table.
	 */
	public static function init_db() {
		global $wpdb;

		$applicant_table_name = $wpdb->prefix . 'applicant_submissions';
		$charset_collate = $wpdb->get_charset_collate();

		if ( $wpdb->get_var( $wpdb->prepare( 'show tables like %s', $applicant_table_name ) ) !== $applicant_table_name ) {
			$sql = sprintf(
				'CREATE TABLE `%s` (
				`id`  bigint(20)   NOT NULL auto_increment,
				`firstname`  tinytext   NOT NULL,
				`lastname`  tinytext   NOT NULL,
				`present_address`  text   NOT NULL,
				`email`  varchar(100)   NOT NULL,
				`phone`  varchar(100)   NOT NULL,
				`post`  varchar(150)   NOT NULL,
				`cv_file_url`  varchar(150)   NOT NULL,
				`created_at` datetime DEFAULT CURRENT_TIMESTAMP NOT NULL,
				PRIMARY KEY (`id`)
			) %s;',
				$applicant_table_name,
				$charset_collate
			);

			require_once ABSPATH . '/wp-admin/includes/upgrade.php';

			dbDelta( $sql );
		}
	}

	/**
	 * Insert into DB table.
	 *
	 * @param array $post_data Submitted form data.
	 */
	public static function insert( $post_data ) {
		global $wpdb;
		if ( isset( $post_data['action'] ) && 'submit_application' === $post_data['action'] ) {
			$data = array();
			unset( $post_data['action'] );
			unset( $post_data['security'] );
			$table = $wpdb->prefix . 'applicant_submissions';

			foreach ( $post_data as $key => $value ) {
				$data[$key] = sanitize_text_field( $value );
			}

			$wpdb->insert( $table, $data );

			ob_start();
			include APPLICANTFORM_DIR . '/views/frontend/email.php';
			$email_content = ob_get_contents();
			ob_end_clean();
			$headers = array( 'Content-Type: text/html; charset=UTF-8' );
			wp_mail( $data['email'], 'Job Application', $email_content, $headers );

			return $wpdb->insert_id;
		}
		return false;
	}

	/**
	 * Get items from db table
	 *
	 * @param array $args Db filter data.
	 */
	public static function get_items( $args ) {
		global $wpdb;

		$applicant_table_name = $wpdb->prefix . 'applicant_submissions';

		$current_page = $args['current_page'];
		$per_page = $args['per_page'];

		$sql = "SELECT * FROM $applicant_table_name";

		$request = wp_unslash( $_REQUEST );

		$search = isset( $request['search'] ) ? esc_sql( $request['search'] ) : '';

		if ( ! empty( $search ) ) {
			$sql .= ' WHERE (firstname LIKE "%' . $search  . '%"' ;
			$sql .= ' OR lastname LIKE "%' . $search  . '%"' ;
			$sql .= ' OR present_address LIKE "%' . $search  . '%"' ;
			$sql .= ' OR email LIKE "%' . $search  . '%"' ;
			$sql .= ' OR phone LIKE "%' . $search  . '%"' ;
			$sql .= ' OR post LIKE "%' . $search  . '%")' ;
		}

		if ( ! empty( $request['orderby'] ) ) {
			$sql .= ' ORDER BY ' . esc_sql( $request['orderby'] );
			$sql .= ! empty( $request['order'] ) ? ' ' . esc_sql( $request['order'] ) : ' DESC';
		}

		$sql .= " LIMIT $per_page";

		$sql .= ' OFFSET ' . ( $current_page - 1 ) * $per_page;

		return array(
			'items'       => $wpdb->get_results( $sql, OBJECT ),
			'total_items' => $wpdb->get_var( "SELECT COUNT(*) FROM $applicant_table_name" ),
		);
	}

	/**
	 * Delete item from db table
	 *
	 * @param array $id Db item id.
	 */
	public static function delete_item( $id ) {
		global $wpdb;
		$applicant_table_name = $wpdb->prefix . 'applicant_submissions';
		return $wpdb->delete(
			$applicant_table_name,
			array( 'id' => $id ),
			array( '%d' ),
		);
	}

	/**
	 * Get item from db table
	 *
	 * @param array $id Db item id.
	 */
	public static function get_item( $id ) {
		global $wpdb;
		$applicant_table_name = $wpdb->prefix . 'applicant_submissions';
		return $wpdb->get_row( "SELECT * FROM $applicant_table_name WHERE `id` = $id", OBJECT );
	}
}

