<?php namespace TierPricingTable\Frontend;

use TierPricingTable\Admin\Settings;
use Premmerce\SDK\V2\FileManager\FileManager;
use TierPricingTable\PriceManager;
use WP_Post;
use WC_Cart;
use WC_Product;

/**
 * Class Frontend
 *
 * @package TierPricingTable\Frontend
 */
class Frontend
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
     * Frontend constructor.
     * @param FileManager $fileManager
     * @param Settings $settings
     */
    public function __construct(FileManager $fileManager, Settings $settings)
    {
        $this->fileManager = $fileManager;
        $this->settings    = $settings;


        if($this->settings->get('display') == 'yes'){
            // Render price table
            add_action($this->settings->get('position_hook'), 'render_price_quantity_table', -999);
        }

        // Get table for variation
        add_action('wc_ajax_get_price_table', [$this, 'getPriceTableVariation']);

        add_action('wp_enqueue_scripts', [$this, 'enqueueAssets']);

        add_action('woocommerce_before_calculate_totals', [$this, 'calculateTotals']);

        if($this->settings->get('display') == 'yes' && $this->settings->get('display_type') == 'tooltip'){
            add_filter('woocommerce_get_price_html', [$this, 'renderTooltip'], 1, 2);
        }
    }

    /**
     * @param string $price
     * @param WC_Product $instance
     * @return string
     */
    public function renderTooltip($price, $instance)
    {
        $current_url = "//{$_SERVER['HTTP_HOST']}{$_SERVER['REQUEST_URI']}";
        $current_product_id = url_to_postid($current_url);

        if(get_post_meta($instance->get_id(), '_price_rules', true)){
            if($instance->is_type('variation') && $instance->get_parent_id() === $current_product_id
                || (is_product() && $instance->is_type('simple') && $current_product_id == $instance->get_id())){
                return $price . $this->fileManager->renderTemplate('frontend/tooltip.php',
                        [
                            'color' => $this->settings->get('tooltip_color'),
                            'size'  => $this->settings->get('tooltip_size') . 'px',
                        ]
                    );
            }
        }

        return $price;
    }
    /**
     * Change price by quantity rules
     *
     * @param WC_Cart $cart
     */
    public function calculateTotals($cart)
    {
        foreach ($cart->cart_contents as $key => $product_item) {
            $product_id = !empty($product_item['variation_id']) ? $product_item['variation_id'] : $product_item['product_id'];
            $new_price = PriceManager::getPriceByRules($product_item['quantity'], $product_id);

            if ($new_price !== false) {
                $product_item['data']->set_price($new_price);
            }
        }
    }

    /**
     * Enqueue assets at simple product and variation product page.
     * @global WP_Post $post .
     */
    public function enqueueAssets()
    {
        global $post;

        if (is_product()) {
            $product = wc_get_product($post->ID);

            if ($product->is_type('variable') || $product->is_type('simple')) {
                wp_enqueue_script('jquery');
                wp_enqueue_script('jquery-ui-tooltip');
                wp_enqueue_script('tier-pricing-table-front-js',
                    $this->fileManager->locateAsset('frontend/product-tier-pricing-table.js'), 'jquery');
                wp_enqueue_style('tier-pricing-table-front-css', $this->fileManager->locateAsset('frontend/main.css'));
                wp_localize_script('tier-pricing-table-front-js', 'tierPricingTable', ['product_type' => $product->get_type(), 'settings' => $this->settings->getAll()]);
            }
        }
    }

    /**
     * Fired when user choose some variation. Render price rules table for it if it exists
     * @global WP_Post $post .
     */
    public function getPriceTableVariation()
    {
        $variation_id = isset($_POST['product_id']) ? $_POST['product_id'] : false;
        if ($variation_id) {
            $this->_renderPriceTable($variation_id);
        }
    }

    /**
     * @param int $variation_id
     */
    public function _renderPriceTable($variation_id = null)
    {
        global $post;

        $settings = $this->settings->getAll();

        $product = wc_get_product($post->ID);
        $product_id = !is_null($variation_id) ? $variation_id : $product->get_id();

        if ($product && !$product->is_type('simple') && !$product->is_type('variable')) {
            return;
        }

        $rules = PriceManager::getPriceRules($product_id);
        $real_price = !is_null($variation_id) ? wc_get_product($variation_id)->get_price() : $product->get_price();

        if (!empty($rules)) {
            $this->fileManager->includeTemplate('frontend/price-table.php', [
                'price_rules' => $rules,
                'real_price' => $real_price,
                'product_id' => $product_id,
                'settings'   => $settings
            ]);
        }
    }
}