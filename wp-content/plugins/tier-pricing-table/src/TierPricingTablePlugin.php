<?php namespace TierPricingTable;

use Premmerce\SDK\V2\Notifications\AdminNotifier;
use TierPricingTable\Admin\Settings;
use Premmerce\SDK\V2\FileManager\FileManager;
use TierPricingTable\Admin\Admin;
use TierPricingTable\Frontend\Frontend;

/**
 * Class TierPricingTablePlugin
 *
 * @package TierPricingTable
 */
class TierPricingTablePlugin {

	/**
	 * @var FileManager
	 */
	private $fileManager;

	/**
     * @var Settings
     */
	private $settings;

    /**
     * @var AdminNotifier
     */
	private $notifier;

    /**
	 * TierPricingTablePlugin constructor.
	 *
     * @param string $mainFile
	 */
    public function __construct($mainFile) {

        $this->fileManager = new FileManager($mainFile, 'tier-pricing-table');
        $this->settings    = new Settings($this->fileManager);
        $this->notifier    = new AdminNotifier();

        add_action('plugins_loaded', [ $this, 'loadTextDomain' ]);
        add_action( 'admin_init', [ $this, 'checkRequirePlugins'] );

        add_filter( 'plugin_action_links_' . plugin_basename($this->fileManager->getMainFile()), [$this, 'addPluginAction'], 10, 4 );
	}

	public function addPluginAction($actions)
    {
        $actions[] = '<a href="' . $this->settings->getLink() . '">' . __('Settings', 'tier-pricing-table') . '</a>';
        return $actions;
    }

	/**
	 * Run plugin part
	 */
	public function run() {

        $valid = count( $this->validateRequiredPlugins() ) === 0;

        if ( $valid ) {
            if ( is_admin() ) {
                new Admin( $this->fileManager, $this->settings );
            } else {
                $GLOBALS['price_table_frontend'] = new Frontend( $this->fileManager, $this->settings );
            }
        }
	}

    /**
     * Load plugin translations
     */
    public function loadTextDomain()
    {
        $name = $this->fileManager->getPluginName();
        load_plugin_textdomain('tier-pricing-table', false, $name . '/languages/');
    }

    /**
     * Validate required plugins
     *
     * @return array
     */
    private function validateRequiredPlugins()
    {
        $plugins = [];

        if ( ! function_exists('is_plugin_active')) {
            include_once(ABSPATH . 'wp-admin/includes/plugin.php');
        }

        /**
         * Check if WooCommerce is active
         **/
        if ( ! (is_plugin_active('woocommerce/woocommerce.php') || is_plugin_active_for_network('woocommerce/woocommerce.php'))) {
            $plugins[] = '<a target="_blank" href="https://wordpress.org/plugins/woocommerce/">WooCommerce</a>';
        }

        return $plugins;
    }

    /**
     * Check required plugins and push notifications
     */
    public function checkRequirePlugins()
    {
        $message = __('The %s plugin requires %s plugin to be active!', 'tier-pricing-table');

        $plugins = $this->validateRequiredPlugins();

        if (count($plugins)) {
            foreach ($plugins as $plugin) {
                $error = sprintf($message, 'Tiered Price Table', $plugin);
                $this->notifier->push($error, AdminNotifier::ERROR, false);
            }
        }
    }

	/**
	 * Fired during plugin uninstall
	 */
	public static function uninstall() {
        delete_post_meta_by_key( '_price_rules' );
	}

	public function activate(){
        set_transient('tier_pricing_table_activated', true, 100);

        add_option(Settings::PREFIX . 'display', 'yes');
        add_option(Settings::PREFIX . 'position_hook', 'woocommerce_after_add_to_cart_button');
        add_option(Settings::PREFIX . 'head_quantity_text', __('Quantity', 'tier-pricing-table'));
        add_option(Settings::PREFIX . 'head_price_text', __('Price', 'tier-pricing-table'));
        add_option(Settings::PREFIX . 'display_type', 'tooltip');
        add_option(Settings::PREFIX . 'selected_quantity_color', '#cc99c2');
        add_option(Settings::PREFIX . 'table_title', '');
        add_option(Settings::PREFIX . 'table_css_class', '#fff');
        add_option(Settings::PREFIX . 'tooltip_size', 15);
    }

	public function deactivate(){}
}