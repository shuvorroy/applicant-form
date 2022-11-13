<?php
/**
 * View file
 *
 * @package sr/applicant-form
 */

?>

<div class="wrap">
	<h1 class="wp-heading-inline"><?php esc_html_e( 'Submissions', 'applicant-form' ); ?></h1>
	<form action="" method="post">
		<?php
		$table = new ApplicantForm\Table();
		$table->views();
		$table->prepare_items();
		$table->display();
		?>
	</form>
</div>
