<?php
/**
 * View file
 *
 * @package sr/applicant-form
 */

?>
<div class="wrap applicant-details">
	<fieldset>
		<legend>Job</legend>
		<label>
			Position
			<p><?php echo esc_html( $item->post ); ?></p>
		</label>
	</fieldset>
	<fieldset>
		<legend>Personal data</legend>
		<div class="two-cols">
			<label>
				First Name
				<p><?php echo esc_html( $item->firstname ); ?></p>
			</label>
			<label>
				Last Name
				<p><?php echo esc_html( $item->lastname ); ?></p>
			</label>
		</div>
		<div class="two-cols">
			<label>
				Email address
				<p><?php echo esc_html( $item->email ); ?></p>
			</label>
			<label>
				Mobile No
				<p><?php echo esc_html( $item->phone ); ?></p>
			</label>
		</div>
		<div class="one-cols">
			<label>
				Present Address
				<p><?php echo esc_html( $item->present_address ); ?></p>
			</label>
		</div>
	</fieldset>
	<fieldset>
		<legend>Application documents</legend>
		<div class="two-cols">
			<label>
				Curriculum Vitae *
				<p><a href="<?php echo esc_url( $item->cv_file_url ); ?>" class=""><?php echo esc_html( $item->cv_file_url ); ?></a></p>
			</label>
		</div>
	</fieldset>
</div>
