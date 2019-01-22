<?php 

global $hubwoo; 

$success_calls = get_option( "hubwoo-free-success-api-calls", 0 );
$failed_calls = get_option( "hubwoo-free-error-api-calls", 0 );

?>

<div class="hubwoo-connect-form-header">
	<h2><?php _e("Error Tracking","hubwoo") ?></h2>
</div>

<div class="hubwoo-extn-status">
	<p><?php _e("Extension Current Status", "hubwoo") ?></p>

	<?php if( get_option( "hubwoo_alert_param_set" ) ) {
		?>
		<img height="70px" width="70px" src="<?php echo HUBWOO_URL . 'admin/images/error.png' ?>">
		<?php
	}
	else {
	?>
	<img src="<?php echo HUBWOO_URL . 'admin/images/connected.png' ?>">
		<?php
	}
	?>
</div>

<div class="hubwoo-error-info">
	<div class="hubwoo-error">
		<p class="hubwoo-total-calls">
			<?php _e( "Total API Calls","hubwoo") ?>
		</p>
		<p class="hubwoo-error-text">
			<?php echo __( "Count: ", "hubwoo") . ( $success_calls + $failed_calls );?>
		</p>
	</div>
	<div class="hubwoo-error">
		<p class="hubwoo-success-calls">
			<?php _e( "Success API Calls","hubwoo") ?>
		</p>
		<p class="hubwoo-error-text">
			<?php echo __( "Count: ", "hubwoo" ) . $success_calls; ?>
		</p>
		</p>
	</div>
	<div class="hubwoo-error">
		<p class="hubwoo-failed-calls">
			<?php _e( "Failed API Calls","hubwoo") ?>
		</p>
		<p class="hubwoo-error-text">
			<?php echo __( "Count: ", "hubwoo" ) . $failed_calls; ?>
		</p>
	</div>
</div>