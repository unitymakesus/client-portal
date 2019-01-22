<?php global $hubwoo; ?>
<?php

 if( isset( $_POST["hubwoo_save_pluginsettings"] ) ) {

 	unset( $_POST["hubwoo_save_pluginsettings"] );
 	woocommerce_update_options( Hubwoo_Admin::hubwoo_general_settings() );
 	$message = __( "Settings saved", "hubwoo");
 	Hubwoo::hubwoo_notice( $message, 'success' );
 }
?>

<div class="hubwoo-settings-header hubwoo-common-header">
	<h2><?php _e("General Settings","hubwoo") ?></h2>
</div>
<div class="hubwoo-settings-container">
<?php $property_update = get_option( "hubwoo_free_property_update", false ); ?>

	<?php if( !$property_update ) { ?>
		<div class="hubwoo-update-old-properties">
			<div class="hubwoo-old-update-text">
				<p><?php _e("It is important for you to update the existing properties of HubSpot. It is needed to make them compatible with our new updated version 2.0.0.", "hubwoo")?></p>
			</div>
			<span><?php _e("Following fields will be changed: ", "hubwoo")?></span>
			<ul>
				<li>
					<?php _e( "Customer Group/ User role", "hubwoo") ?>
				</li>
				<?php if( get_option( "hubwoo_abncart_added", false ) ): ?>
					<li>
						<?php _e( "Abandoned Cart Products", "hubwoo") ?>
					</li>
					<li>
						<?php _e( "Abandoned Cart Products SKUs", "hubwoo") ?>
					</li>
					<li>
						<?php _e( "Abandoned Cart Products Categories", "hubwoo") ?>
					</li>
				<?php endif; ?>
			</ul>
			<div class="hubwoo-old-update-button">
				<a href="javascript:void(0)" class="button-primary" id="hubwoo_old_properties_update"><?php _e("Update Now","hubwoo")?></a>
			</div>
		</div>
	<?php } ?>
	<div class="hubwoo-general-settings">
		<form action="" method="post">
			<?php woocommerce_admin_fields( Hubwoo_Admin::hubwoo_general_settings() ); ?>
			<p class="submit">
				<input type="submit" class="button button-primary" name="hubwoo_save_pluginsettings" value="<?php _e("Save settings","hubwoo") ?>">
			</p>
		</form>
	</div>
</div> 