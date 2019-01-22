<?php

if ( ! defined ( 'ABSPATH' ) ) {

	exit (); // Exit if accessed directly
}
?>

<?php
	global $hubwoo;
	$active_tab = isset( $_GET['hubwoo_tab'] ) ? $_GET['hubwoo_tab'] : 'hubwoo_overview';
	$default_tabs = $hubwoo->hubwoo_default_tabs();
?>

<div class="hubwoo-go-pro">
	<div class="hubwoo-go-pro-banner">
		<div class="hubwoo-inner-container">
			<div class="hubwoo-name-wrapper"><p><?php _e("HubSpot WooCommerce Integration PRO", "hubwoo") ?></p></div>
			<div class="hubwoo-static-menu">
				<ul>
					<li><a href="https://makewebbetter.com/contact-us/" target="_blank"><?php _e("Contact US", "hubwoo")?></a></li>
					<li><a href="https://docs.makewebbetter.com/hubspot-woocommerce-integration/" target="_blank"><?php _e("Go to Docs", "hubwoo") ?></a></li>
					<li class="hubwoo-main-menu-button"><a id="hubwoo-go-pro-link" href="https://makewebbetter.com/product/hubspot-woocommerce-integration-pro/?utm_source=MWB-huspot-org&utm_medium=MWB-ORG&utm_campaign=ORG" class="" title="" target="_blank"><?php _e("GO PRO NOW", "hubwoo")?></a></li>
				</ul>
			</div>
		</div>
	</div>
</div>
<div class="hubwoo-main-template">
	<div class="hubwoo-header-template">
		<div class="hubwoo-hubspot-icon">
			<img width="90px" height="90px" src="<?php echo HUBWOO_URL . 'admin/images/hubspot-icon.png' ?>" class=""/>
		</div>
		<div class="hubwoo-header-text">
			<h2><?php _e( "HubSpot WooCommerce Integration", "hubwoo" ) ?></h2>
		</div>
		<div class="hubwoo-woo-icon">
			<img width="90px" height="90px" src="<?php echo HUBWOO_URL . 'admin/images/woo-icon.png' ?>" class=""/>
		</div>
	</div>
	<div class="hubwoo-body-template">
		<div class="hubwoo-navigator-template">
			<div class="hubwoo-navigations">
				<?php
					if( is_array( $default_tabs ) && count( $default_tabs ) ) {

						foreach( $default_tabs as $tab_key => $single_tab ) {

							$tab_classes = "hubwoo-nav-tab ";

							$dependency = $single_tab["dependency"];
							
							if( !empty( $active_tab ) && $active_tab == $tab_key ) {
								
								$tab_classes .= "nav-tab-active";
							}

							if( $tab_key == "hubwoo_lists" || $tab_key == "hubwoo_workflows" || $tab_key == "hubwoo_abncart" || $tab_key == "hubwoo_coupons" || $tab_key == "hubwoo_deals" || "hubwoo_ocs" == $tab_key ) {

								if( !empty( $dependency ) && !$hubwoo->check_dependencies( $dependency ) ) {

									$tab_classes .= " hubwoo-tab-disabled";
									$tab_classes .= " hubwoo-lock";
									?>
										<div class="hubwoo-tabs"><a class="<?php echo $tab_classes; ?>" id="<?php echo $tab_key; ?>" href="javascript:void(0);"><?php echo $single_tab["name"]; ?><img src="<?php echo HUBWOO_URL . 'admin/images/lock.png' ?>"></a></div>
									<?php
								}
								else {

									$tab_classes .= " hubwoo-lock";
									?>
										<div class="hubwoo-tabs"><a class="<?php echo $tab_classes; ?>" id="<?php echo $tab_key; ?>" href="<?php echo admin_url('admin.php?page=hubwoo').'&hubwoo_tab='.$tab_key; ?>"><?php echo $single_tab["name"]; ?><img src="<?php echo HUBWOO_URL . 'admin/images/lock.png' ?>"></a></div>
									<?php
								}
							}
							else {

								if( !empty( $dependency ) && !$hubwoo->check_dependencies( $dependency ) ) {

									$tab_classes .= " hubwoo-tab-disabled";
									?>
										<div class="hubwoo-tabs"><a class="<?php echo $tab_classes; ?>" id="<?php echo $tab_key; ?>" href="javascript:void(0);"><?php echo $single_tab["name"]; ?></a></div>

									<?php
								}
								else {

									?>
										<div class="hubwoo-tabs"><a class="<?php echo $tab_classes; ?>" id="<?php echo $tab_key; ?>" href="<?php echo admin_url('admin.php?page=hubwoo').'&hubwoo_tab='.$tab_key; ?>"><?php echo $single_tab["name"]; ?></a></div>

									<?php
								}
							}
						}
					}
				?>
			</div>
		</div>
		<div class="hubwoo-content-template">
			<div class="hubwoo-content-container">
				<?php
					// if submenu is directly clicked on woocommerce.
					if( empty( $active_tab ) ){

						$active_tab = "hubwoo_overview";
					}
					
					// look for the path based on the tab id in the admin templates.
					$tab_content_path = 'admin/templates/'.$active_tab.'.php';

					$hubwoo->load_template_view( $tab_content_path );
				?>
			</div>
		</div>
	</div>
	<div style="display: none;" class="loading-style-bg" id="hubwoo_loader">
		<img src="<?php echo HUBWOO_URL;?>admin/images/loader.gif">
	</div>
</div>