<?php
/**
 * View file
 *
 * @package sr/applicant-form
 */

?>

<div class="wrap widget-recent-submission">
	<table>
		<tr>
			<th>Name</th>
			<th>Email</th>
			<th>View</th>
		</tr>
		<?php foreach ( $result['items'] as $item ) { ?>
			<tr>
				<td><?php echo esc_html( $item->firstname . ' ' . $item->lastname ); ?></td>
				<td><?php echo esc_html( $item->email ); ?></td>
				<td>
					<?php
					echo sprintf(
						'<a href="%s" title="%s">%s</a>',
						admin_url( 'admin.php?page=applicant-form&action=view&id=' . $item->id ),
						__( 'View', 'applicant-form' ),
						__( 'View', 'applicant-form' ),
						__( ' View', 'applicant-form' )
					);
					?>
				</td>
			</tr>
		<?php }; ?>
	</table>
</div>
