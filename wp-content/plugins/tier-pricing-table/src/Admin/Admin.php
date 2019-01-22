<?php namespace TierPricingTable\Admin;

use Premmerce\SDK\V2\FileManager\FileManager;
use TierPricingTable\PriceManager;
use WP_Post;
use WC_Product;

/**
 * Class Admin
 *
 * @package TierPricingTable\Admin
 */
class Admin
{
    /**
     * @var FileManager
     */
    private $fileManager;

    /**
     * @var Settings
     */
    private $settings;

    /**
     * Admin constructor.
     *
     * Register menu items and handlers
     *
     * @param FileManager $fileManager
     * @param Settings $settings
     */
    public function __construct(FileManager $fileManager, Settings $settings)
    {
        $this->fileManager = $fileManager;
        $this->settings = $settings;

        add_action('admin_enqueue_scripts', [$this, 'enqueueAssets']);

        add_action('woocommerce_product_options_pricing', [$this, 'renderPriceRulesSimple']);
        add_action('woocommerce_variation_options_pricing', [$this, 'renderPriceRulesVariation'], 1, 3);

        add_action('woocommerce_save_product_variation', [$this, 'updateVariationPriceRules'], 1, 3);
        add_action('save_post_product', [$this, 'updateSimplePriceRules']);

        if(get_transient('tier_pricing_table_activated')){
           add_action('admin_notices', [$this, 'showActivationMessage']);
        }
    }

    public function showActivationMessage(){
        $link = $this->settings->getLink();
        $this->fileManager->includeTemplate('admin/activation-message.php', ['link' => $link]);

        delete_transient('tier_pricing_table_activated');
    }

    /**
     * Update price quantity rules for variation product
     *
     * @param int $variation_id
     * @param int $loop
     */
    public function updateVariationPriceRules($variation_id, $loop)
    {
        if(isset($_POST['_dynamic_price_amount'][$loop])){
            $amounts = $_POST['_dynamic_price_amount'][$loop];
            $prices  = !empty($_POST['_dynamic_price_value'][$loop]) ? $_POST['_dynamic_price_value'][$loop] : [];

            $this->updatePriceRules($amounts, $prices, $variation_id);
        }
    }

    /**
     * Update price quantity rules for simple product
     *
     * @param int $post_id
     */
    public function updateSimplePriceRules($post_id)
    {
        if(isset($_POST['_dynamic_price_amount'])){
            $amounts = $_POST['_dynamic_price_amount'];
            $prices  = !empty($_POST['_dynamic_price_value']) ? $_POST['_dynamic_price_value'] : [];

            $this->updatePriceRules($amounts, $prices, $post_id);
        }
    }
    /**
     * Register assets on product create/update page
     *
     * @param $page
     */
    public function enqueueAssets($page)
    {
        global $post;

        if(($page == 'post.php' || $page = 'post_new.php') && $post && $post->post_type == 'product'){
            wp_enqueue_script('tier-pricing-table-admin-js', $this->fileManager->locateAsset('admin/main.js'), 'jquery');
            wp_enqueue_style('tier-pricing-table-admin-css', $this->fileManager->locateAsset('admin/style.css'));
        }
    }

    /**
     * Update price rules
     *
     * @param array $amounts
     * @param array $prices
     * @param int $post_id
     */
    protected function updatePriceRules($amounts, $prices, $post_id)
    {
        $rules = [];

        foreach ($amounts as $key => $amount){
            if(!empty($amount) && !empty($prices[$key]) && !key_exists($amount, $rules)){
                $rules[$amount] = wc_format_decimal($prices[$key]);
            }
        }

        update_post_meta($post_id, '_price_rules', $rules);
    }

    /**
     * Render inputs for price rules on simple product
     *
     * @global WC_Product $product_object
     */
    public function renderPriceRulesSimple()
    {
        global $product_object;

        $this->fileManager->includeTemplate('admin/add-price-rule-simple.php', ['price_rules' => PriceManager::getPriceRules($product_object->get_id())]);
    }

    /**
     * Render inputs for price rules on variation
     *
     * @param int $loop
     * @param array $variation_data
     * @param WP_Post $variation
     */
    public function renderPriceRulesVariation($loop, $variation_data, $variation)
    {
        $this->fileManager->includeTemplate('admin/add-price-rule-variation.php', ['price_rules' => PriceManager::getPriceRules($variation->ID), 'i' => $loop, 'variation_data' => $variation_data]);
    }
}