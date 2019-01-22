<?php 

/**
 * All HubSpot needed general settings.
 *
 * Template for showing/managing all the HubSpot general settings
 *
 * @since 1.0.0 
 */
//check if the connect is entered and have valid connect..

global $hubwoo;

if( isset( $_POST['hubwoo_activate_connect'] ) && check_admin_referer( 'hubwoo-settings' ) ) {

	unset( $_POST['hubwoo_activate_connect'] );

	woocommerce_update_options( Hubwoo_Admin::hubwoo_general_settings() );

	$message = __( 'Settings saved successfully.' , 'hubwoo' );

	$hubwoo->hubwoo_notice( $message, 'success' );
}

$oauth_success = $hubwoo->is_oauth_success();

if( !$oauth_success && $hubwoo->is_plugin_enable() == "yes" ) {

	$url 		= 'https://app.hubspot.com/oauth/authorize';
	$hapikey 	= HUBWOO_CLIENT_ID;
	$hubspot_url = add_query_arg( array(
	    'client_id'		=> $hapikey,
	    'scope' 		=> 'oauth%20contacts',
	    'redirect_uri' 	=> admin_url().'admin.php'
	), $url );
	?>
		<span class="hubwoo_oauth_span">
			<label><?php _e('Please Click this button to Authorize with HubSpot App.','hubwoo'); ?></label>
			<a href="<?php echo $hubspot_url; ?>" class="button-primary"><?php _e("Authorize","hubwoo")?></a>
		</span>
	<?php
}
?>

<?php 

if( !$oauth_success ) { 

	?>
	<div class="hubwoo-connection-container">
		<form class="hubwoo-connect-form" action="" method="post">
		    <?php woocommerce_admin_fields( Hubwoo_Admin::hubwoo_general_settings() ); ?>
		    <div class="hubwoo-connect-form-submit">
			    <p class="submit">
			        <input type="submit" name="hubwoo_activate_connect" value="<?php _e("Save","hubwoo")?>" class="button-primary" />
			    </p>
			    <?php wp_nonce_field( 'hubwoo-settings' ); ?>
		    </div>
	    </form>
	</div>
	<?php
}
else {

	?>
		<div class="hubwoo-connect-form-header">
			<h2><?php _e("HubSpot Connection","hubwoo") ?></h2>
		</div>
		<div class="hubwoo_pro_support_dev">
			<?php $support_dev = get_option( 'hubwoo_suggestions_sent', false ); ?>
			<?php if( !$support_dev ) : ?>
				<a href="javascript:void(0);" class="hubwoo_connect_page_actions hubwoo_tracking"><?php _e('Support Plugin Development','hubwoo'); ?></a>
			<?php endif; ?>
		</div>
		<div class="hubwoo-connection-info">
			<div class="hubwoo-connection-status hubwoo-connection">
				<img src="<?php echo HUBWOO_URL . 'admin/images/connected.png' ?>">
				<p class="hubwoo-connection-label">
					<?php _e( "Connection Status","hubwoo") ?>
				</p>
				<p class="hubwoo-connection-status-text">
					<?php
						if( $hubwoo->is_valid_client_ids_stored() ) {

							_e( "Connected","hubwoo");
						}
					?>
				</p>
			</div>
			<div class="hubwoo-acc-email hubwoo-connection">
				<img src="<?php echo HUBWOO_URL . 'admin/images/email-icon.png' ?>">
				<p class="hubwoo-acc-email-label">
					<?php _e( "Account Email","hubwoo") ?>
				</p>
				<p class="hubwoo-connection-status-text">
					<?php
						if( $hubwoo->is_valid_client_ids_stored() ) {

							$acc_email = $hubwoo->hubwoo_owners_email_info();

							echo $acc_email;
						}
					?>
				</p>
			</div>
			<div class="hubwoo-token-info hubwoo-connection">
				<img src="<?php echo HUBWOO_URL . 'admin/images/timer.png' ?>">
				<p class="hubwoo-token-expiry-label">
					<?php _e( "Token Renewal","hubwoo") ?>
				</p>
				<?php
					if( $oauth_success ) {

						if( $hubwoo->is_valid_client_ids_stored() ) {

							$token_timestamp = get_option( "hubwoo_token_expiry", '' );

							if( !empty( $token_timestamp ) ) {

								$exact_timestamp = $token_timestamp - time();

								if( $exact_timestamp > 0 ) { 

									?>
									<p class="hubwoo-acces-token-renewal">
										<?php

										$day_string = sprintf( _n( ' In %s second', 'In %s seconds', $exact_timestamp, 'hubwoo' ), number_format_i18n( $exact_timestamp ) );

										$day_string = '<span id="hubwoo-day-count" >'.$day_string.'</span>';
										echo $day_string;
										?>
									</p>
									<?php
								}
								else {

									?>
									<p class="hubwoo-acces-token-renewal">
										<a href="javascript:void(0);" class="" id="hubwoo-refresh-token"><?php _e("Refresh Token","hubwoo")?></a>
									</p>
									<?php
								}
							}
							else {

								?>
								<p class="hubwoo-acces-token-renewal">
									<a href="javascript:void(0);" class="" id="hubwoo-refresh-token"><?php _e("Refresh Token","hubwoo")?></a>
								</p>
								<?php
							}
						}
						else {
							?>
							<p class="hubwoo-acces-token-renewal">
								<a href="?page=hubwoo&hubwoo_tab=hubwoo_connect&action=reauth" class="" id="hubwoo-reauthorize"><?php _e("Re-Authorize with HubSpot","hubwoo")?></a>
							</p>
							<?php
						}
					}
				?>
			</div>
		</div>
		<?php

		$display = "none";

		if ( $oauth_success && $hubwoo->is_display_suggestion_popup() ) {
			
			$display = "block";
		}

		?>
		<div class="hubwoo_pop_up_wrap" style="display: <?php echo $display; ?>">
			<div class="pop_up_sub_wrap">
				<p>
					<?php _e('Unlock your free access to our full documentation just by sending us the tracking data. We need your HubSpot Portal ID and email that too only once.','hubwoo'); ?>
				</p>
				<div class="button_wrap">
					<a href="javascript:void(0);" class="hubwoo_accept"><?php _e('Yes support it','hubwoo'); ?></a>
					<a href="javascript:void(0);" class="hubwoo_later"><?php _e("I'll decide later",'hubwoo'); ?></a>
				</div>
			</div>
		</div>
	<?php
}