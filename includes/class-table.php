<?php

namespace ApplicantForm;

if ( ! class_exists( 'WP_List_Table' ) ) {
	require_once ABSPATH . 'wp-admin/includes/class-wp-list-table.php';
}

/**
 * The submission list class
 */
class Table extends \WP_List_Table {

	/**
	 * Initialize the class
	 */
	public function __construct() {
		parent::__construct(
			array(
				'singular' => 'submission',
				'plural'   => 'submissions',
				'ajax'     => false,
			)
		);
	}

	/**
	 * Message to show if no vendor found.
	 *
	 * @return void
	 */
	public function no_items() {
		esc_html_e( 'No applicant found', 'applicant-form' );
	}

	/**
	 * Get the column names.
	 *
	 * @return array
	 */
	public function get_columns() {
		return array(
			'post'            => __( 'Post', 'applicant-form' ),
			'firstname'       => __( 'First Name', 'applicant-form' ),
			'lastname'        => __( 'Last Name', 'applicant-form' ),
			'email'           => __( 'E-mail', 'applicant-form' ),
			'phone'           => __( 'Phone', 'applicant-form' ),
			'present_address' => __( 'Address', 'applicant-form' ),
			'created_at'      => __( 'Submission Date', 'applicant-form' ),
			'actions'         => __( 'Actions', 'applicant-form' ),
		);
	}

	/**
	 * Render the actions column.
	 *
	 * @param object $item Row item.
	 *
	 * @return string
	 */
	public function column_actions( $item ) {

		$actions['delete']   = sprintf(
			'<a href="%s" title="%s">%s</a>',
			admin_url( 'admin.php?page=applicant-form&action=delete&id=' . $item->id ),
			__( 'Delete', 'applicant-form' ),
			__( 'Delete', 'applicant-form' ),
			__( ' Delete', 'applicant-form' )
		);

		$actions['view']   = sprintf(
			'<a href="%s" title="%s">%s</a>',
			admin_url( 'admin.php?page=applicant-form&action=view&id=' . $item->id ),
			__( 'View', 'applicant-form' ),
			__( 'View', 'applicant-form' ),
			__( ' View', 'applicant-form' )
		);

		return sprintf( '%s', $this->row_actions( $actions, true ) );
	}

	/**
	 * Extra table nav -- at top of table.
	 *
	 * @param string $which table nav position.
	 */
	public function extra_tablenav( $which ) {
		if ( 'top' === $which ) :
			include_once APPLICANTFORM_DIR . '/views/admin/table-nav.php';
		endif;
	}

	/**
	 * Get sortable columns.
	 *
	 * @return array
	 */
	public function get_sortable_columns() {
		$sortable_columns = array(
			'created_at' => array( 'created_at', false ),
		);
		return $sortable_columns;
	}

	/**
	 * Default column values.
	 *
	 * @param object $item table row.
	 * @param string $column_name column name.
	 *
	 * @return string
	 */
	protected function column_default( $item, $column_name ) {
		return isset( $item->$column_name ) ? $item->$column_name : '';
	}

	/**
	 * Prepare the address items.
	 *
	 * @return void
	 */
	public function prepare_items() {
		$column   = $this->get_columns();
		$sortable = $this->get_sortable_columns();
		$hidden   = array();

		$this->_column_headers = array( $column, $hidden, $sortable );

		$per_page     = 10;
		$current_page = $this->get_pagenum();

		$args = array(
			'per_page'     => $per_page,
			'current_page' => $current_page,
		);

		$result = Db::get_items( $args );

		$this->items = $result['items'];

		$this->set_pagination_args(
			array(
				'total_items' => $result['total_items'],
				'per_page'    => $per_page,
			)
		);
	}
}
