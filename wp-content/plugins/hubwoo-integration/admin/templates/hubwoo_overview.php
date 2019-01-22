<?php 

/**
 * All HubSpot needed general settings.
 *
 * Template for showing/managing all the HubSpot general settings
 *
 * @since 1.0.0 
 */

global $hubwoo;

$GLOBALS['hide_save_button']  = true;

?>
<div class="hubwoo-overview-wrapper">
    <div class="hubwoo-overview-header hubwoo-common-header">
        <h2><?php _e("Connect With Us and Explore More About HubSpot", "hubwoo") ?></h2>
    </div>
   <iframe width="640" height="360" src="https://www.youtube.com/embed/qdu9s5zXSh4" frameborder="0" allow="autoplay; encrypted-media" allowfullscreen></iframe>
    <div class="hubwoo-overview-body">
    	<div class="hubwoo-overview-container">
            <a target="_blank" class="hubwoo-overview-go-pro" href="https://makewebbetter.com/product/hubspot-woocommerce-integration-pro/?utm_source=MWB-huspot-org&utm_medium=MWB-ORG&utm_campaign=ORG"><?php _e("Upgrade to Pro Now", "hubwoo")?></a>
            <?php if( self::hubwoo_get_started() ) { ?>
                
                <a class="hubwoo-next-connect-tab" href="<?php echo admin_url( 'admin.php?page=hubwoo&hubwoo_tab=hubwoo_connect' ) ?>"><?php _e("Next", "hubwoo")?></a>
            <?php } else {
                ?>
                    <a class="hubwoo-overview-get-started" href="javascript:void(0)"><?php _e("Get Started With Free", "hubwoo")?></a>
                <?php
                }
            ?>
        </div>
    </div>
</div>