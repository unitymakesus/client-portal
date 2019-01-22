<?php

use TierPricingTable\TierPricingTablePlugin;

/**
 *
 * Plugin Name:       WooCommerce Tiered Price Table
 * Description:       Allow set price for certain count of price. Shows pricing table. Supports displaying table in tooltip
 * Version:           1.1
 * Author:            bycrik
 * License:           GPLv2 or later
 * License URI:       http://www.gnu.org/licenses/gpl-2.0.txt
 * Text Domain:       tier-pricing-table
 * Domain Path:       /languages
 *
 * WC requires at least: 3.0
 */

// If this file is called directly, abort.
if ( ! defined( 'WPINC' ) ) {
    die;
}

call_user_func( function () {

	require_once plugin_dir_path( __FILE__ ) . 'vendor/autoload.php';

	$main = new TierPricingTablePlugin( __FILE__ );

	register_activation_hook( __FILE__, [ $main, 'activate' ] );

	register_deactivation_hook( __FILE__, [ $main, 'deactivate' ] );

	register_uninstall_hook( __FILE__, [ TierPricingTablePlugin::class, 'uninstall' ] );

	$main->run();
} );