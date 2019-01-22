<?php 

/**
 * HubSpot Setup
 *
 * Template for showing/managing all the HubSpot general settings
 *
 * @since 1.0.0 
 */

global $hubwoo;

$GLOBALS['hide_save_button']  = true;

?>

<?php add_thickbox(); ?>

<div id="hubwoo-setup-process" style="display: none;">
  <div class="popupwrap">
    <p> <?php _e('We are setting up custom groups and properties for contacts on HubSpot, Please do not navigate or reload the page before our confirmation message.', 'hubwoo')  ?></p>
    <div class="progress">
      <div class="progress-bar" role="progressbar" aria-valuenow="60" aria-valuemin="0" aria-valuemax="100" style="width:0%">
      </div>
    </div>
    <div class="hubwoo-message-area">
    </div>
  </div> 
</div>

<div class="modal fade" id="myModal" role="dialog">
  <div class="modal-dialog">
      <!-- Modal content-->
      <div class="modal-content">
        <div class="modal-header">
            <button type="button" class="close" data-dismiss="modal">&times;</button>
            <h4 class="modal-title"><?php _e("Get access to more Groups and Properties in our Paid Versions", "hubwoo")?></h4>
            <p><?php _e("Get Extension according to your CRM Package", "hubwoo")?></p>
        </div>
        <div class="modal-body">
            <div class="modal-body">
                <div class="hubwoo-pro"><a href="https://makewebbetter.com/product/hubspot-woocommerce-integration-pro/?utm_source=MWB-huspot-org&utm_medium=MWB-ORG&utm_campaign=ORG"><?php _e("Upgrade to Our Pro Plan in $199", "hubwoo")?></a></div>
                 <p><?php _e("OR", "hubwoo")?></p>
                <div class="hubwoo-starter"><a href="https://makewebbetter.com/product/hubspot-woocommerce-integration-pro/?utm_source=MWB-huspot-org&utm_medium=MWB-ORG&utm_campaign=ORG"><?php _e("Upgrade to Our Starter Plan in $149", "hubwoo")?></a></div>
                <p><?php _e("OR", "hubwoo")?></p>
                <div class="hubwoo-comp"><a href="https://makewebbetter.com/product/hubspot-woocommerce-integration-pro/?utm_source=MWB-huspot-org&utm_medium=MWB-ORG&utm_campaign=ORG"><?php _e("Upgrade to Our Free Plan in $99", "hubwoo")?></a></div>
            </div>
        </div>
        <div class="modal-footer">
            <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
        </div>
      </div> 
  </div>
</div>

<div class="hubwoo-overview-wrapper">
  <?php if( !$hubwoo->is_setup_completed() ) { ?>
  <div class="hubwoo-overview-header hubwoo-common-header">
    <h2><?php _e("Complete your basic setup just in one-click", "hubwoo") ?></h2>
  </div>
  <div class="hubwoo-overview-body">
    <div class="hubwoo-overview-container">
      <p><?php _e("We create best practised groups and properties for contacts on HubSpot so that you can manage your follow-ups with real-time data.", "hubwoo") ?></p>
      <span><?php _e("We create several custom groups on HubSpot", "hubwoo") ?></span>
      <div class="hubwoo-all-groups">
        <div class="hubwoo-enabled-groups hubwoo-grouping">
          <h4><?php _e("Groups in Free Version", "hubwoo")?></h4>
          <ul>
            <li class="hubwoo_enabled"><img src="<?php echo HUBWOO_URL . 'admin/images/checked.png' ?>"><span><?php _e("Customer Information", "hubwoo") ?></span></li>
            <li class="hubwoo_enabled"><img src="<?php echo HUBWOO_URL . 'admin/images/checked.png' ?>"><span><?php _e("Last Order", "hubwoo") ?></span></li>
            <li class="hubwoo_enabled"><img src="<?php echo HUBWOO_URL . 'admin/images/checked.png' ?>"><span><?php _e("RFM Information", "hubwoo") ?></span></li>
          </ul>
        </div>
        <div class="hubwoo-disabled-groups hubwoo-grouping">
          <h4><?php _e("Groups in Paid Version", "hubwoo")?></h4>
          <ul>
            <li data-toggle="modal" data-target="#myModal" class="hubwoo_disabled"><img src="<?php echo HUBWOO_URL . 'admin/images/locked.png' ?>"><span><?php _e("Shopping Cart Information", "hubwoo") ?></span></li>
            <li data-toggle="modal" data-target="#myModal" class="hubwoo_disabled"><img src="<?php echo HUBWOO_URL . 'admin/images/locked.png' ?>"><span><?php _e("Products Bought", "hubwoo") ?></span></li>
            <li data-toggle="modal" data-target="#myModal" class="hubwoo_disabled"><img src="<?php echo HUBWOO_URL . 'admin/images/locked.png' ?>"><span><?php _e("Categories Bought", "hubwoo") ?></span></li>
            <li data-toggle="modal" data-target="#myModal" class="hubwoo_disabled"><img src="<?php echo HUBWOO_URL . 'admin/images/locked.png' ?>"><span><?php _e("SKUs Bought", "hubwoo") ?></span></li>
            <li data-toggle="modal" data-target="#myModal" class="hubwoo_disabled"><img src="<?php echo HUBWOO_URL . 'admin/images/locked.png' ?>"><span><?php _e("ROI Tracking (for PRO Users)", "hubwoo") ?></span></li>
            <li data-toggle="modal" data-target="#myModal" class="hubwoo_disabled"><img src="<?php echo HUBWOO_URL . 'admin/images/locked.png' ?>"><span><?php _e("Subscription Details", "hubwoo") ?></span></li>
          </ul>
        </div>
      </div>
      <div class="hubwoo-free-setup">
        <a id="hubwoo-run-setup" href="javascript:void(0)"><?php _e("Start Running Setup", "hubwoo")?></a>
      </div>
    </div>
  </div>
  <?php } else { ?>
  <div class="hubwoo-overview-header hubwoo-common-header">
    <h2><?php _e("Basic Setup Completed", "hubwoo") ?></h2>
  </div>
  <div class="hubwoo-after-setup">
    <p><?php _e("Congratulations, you are going well with email marketing.", "hubwoo") ?></p>
    <div class="hubwoo-do-more">
      <p>
        <?php $message = sprintf( __("A lot more can be achieved through our paid plans. We have a well suitable featured packages for %s HubSpot FREE, Starter or Basic, Professional or Enterpirse Users %s", "hubwoo" ), "<strong>", "</strong>"); ?>
        <?php echo $message ?>
      </p> 
    </div>
  </div>
  <div class="hubwoo-pro-plans">
    <div class="row">
      <div class="col-lg-4 col-md-4 col-sm-6 col-xs-12">
        <div class="hubwoo-complimentary hubwoo-box">
          <ul>
            <li class="heading"></li>
            <li class="price"><span><?php _e("$99", "hubwoo") ?></span><br></br><?php _e("One Time Payment", "hubwoo" )?></li>
            <li class="upgrade-now"><a href="https://makewebbetter.com/product/hubspot-woocommerce-integration-pro/?utm_source=MWB-huspot-org&utm_medium=MWB-ORG&utm_campaign=ORG" target="_blank"><?php _e("Upgrade Now", "hubwoo") ?></a></li>
            <li class="features"><?php _e("70+ contact fields", "hubwoo") ?></li>
            <li class="features"><?php _e("Guest Order Sync", "hubwoo") ?></li>
            <li class="features"><?php _e("WooCommerce Subscriptions", "hubwoo") ?></li>
            <li class="features"><?php _e("Products Purchased", "hubwoo") ?></li>
            <li class="features"><?php _e("SKUs Purchased", "hubwoo") ?></li>
            <li class="features"><?php _e("Categories Purchased", "hubwoo") ?></li>
          </ul>
        </div>
      </div>

      <div class="col-lg-4 col-md-4 col-sm-6 col-xs-12">
        <div class="hubwoo-starter-basic hubwoo-box">
          <ul>
            <li class="heading"></li>
            <li class="price"><span><?php _e("$149", "hubwoo") ?></span><br></br><?php _e("One Time Payment", "hubwoo" )?></li>
            <li class="upgrade-now"><a href="https://makewebbetter.com/product/hubspot-woocommerce-integration-pro/?utm_source=MWB-huspot-org&utm_medium=MWB-ORG&utm_campaign=ORG" target="_blank"><?php _e("Upgrade Now", "hubwoo") ?></a></li>
            <li class="features"><?php _e("All features of Free Version", "hubwoo") ?></li>
            <li class="features"><?php _e("20+ smart lists", "hubwoo") ?></li>
            <li class="features"><?php _e("Guest Order Sync", "hubwoo") ?></li>
            <li class="features"><?php _e("WooCommerce Subscriptions", "hubwoo") ?></li>
            <li class="features"><?php _e("Order activity list enrolment", "hubwoo") ?></li>
            <li class="features"><?php _e("Customer activity list enrolment", "hubwoo") ?></li>
          </ul>
        </div>
      </div>

      <div class="col-lg-4 col-md-4 col-sm-6 col-xs-12">
        <div class="hubwoo-pro hubwoo-box">
          <ul>
            <li class="heading"></li>
            <li class="price"><span><?php _e("$199", "hubwoo") ?></span><br></br><?php _e("One Time Payment", "hubwoo" )?></li>
            <li class="upgrade-now"><a href="https://makewebbetter.com/product/hubspot-woocommerce-integration-pro/?utm_source=MWB-huspot-org&utm_medium=MWB-ORG&utm_campaign=ORG target="_blank"><?php _e("Upgrade Now", "hubwoo") ?></a></li>
            <li class="features"><?php _e("All features of Free & Basic", "hubwoo")?>
            <li class="features"><?php _e("10+ ready to use workflows") ?></li>
            <li class="features"><?php _e("Order activity list enrolment", "hubwoo") ?></li>
            <li class="features"><?php _e("Customer activity list enrolment", "hubwoo") ?></li>
            <li class="features"><?php _e("Order activity workflow enrolment", "hubwoo") ?></li>
            <li class="features"><?php _e("Customer activity workflow enrolment ", "hubwoo") ?></li>
          </ul>
        </div>
      </div>
    </div>
  </div>
  <?php } ?>
</div>




