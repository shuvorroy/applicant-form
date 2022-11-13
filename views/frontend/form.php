<?php
/**
 * View file
 *
 * @package sr/applicant-form
 */

?>
<form action="" id="applicant-form" method="POST" accept-charset="UTF-8" enctype="multipart/form-data">
	<input type="hidden" name="action" value="submit_application">
	<input type="hidden" name="security" value="<?php echo esc_attr( wp_create_nonce( 'applicant_form' ) ); ?>">
	<fieldset>
		<legend>Job</legend>
		<label>
			Position
			<select name="post" required>
				<option>WordPress Plugin Developer</option>
				<option>WordPress Theme Developer</option>
				<option>Fullstack Developer</option>
			</select>
		</label>
	</fieldset>
	<fieldset>
		<legend>Personal data</legend>
		<div class="two-cols">
			<label>
				First Name *
				<input type="text" name="firstname" required>
			</label>
			<label>
				Last Name *
				<input type="text" name="lastname" required>
			</label>
		</div>
		<div class="two-cols">
			<label>
				Email address *
				<input type="email" name="email" required>
			</label>
			<label>
				Mobile No *
				<input type="tel" name="phone" required>
			</label>
		</div>
		<div class="one-cols">
			<label>
				Present Address *
			</label>
			<textarea type="text" name="present_address" required></textarea>
		</div>
	</fieldset>
	<fieldset>
		<legend>Application documents</legend>
		<div class="two-cols">
			<input type="hidden" name="cv_file_url" required>
			<label>
				Curriculum Vitae *
				<input type="file" name="cv" accept=".doc,.docx,.pdf" required>
			</label>
			<div class="upload-progressbar"><span class="progress"></span></div>
			<p class="file-message">Possible file types: DOC, PDF.</p>
		</div>
	</fieldset>
	<div class="btns">
		<input type="submit" value="Submit">
	</div>
	<div class="loader-container">
		<div class="loader"></div>
	</div>
</form>

