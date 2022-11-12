<?php
$searchby = ! empty( $_REQUEST['search'] ) ? sanitize_text_field( wp_unslash( $_REQUEST['search'] ) ) : '';
?>

<div class="alignleft actions">
	<input class="searchby-term" type="text" name="search" value="<?php echo esc_html( $searchby ); ?>" placeholder="<?php esc_html_e( 'Enter Name, Email or Post', 'applicant-form' ); ?>">
	<?php
	submit_button(
		__( 'Filter', 'applicant-form' ),
		false,
		false,
		false,
		array(
			'id' => 'post-query-submit',
			'name' => 'do-filter',
		)
	);
	?>
</div>

