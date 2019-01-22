<?php namespace TierPricingTable\Admin;

use Premmerce\SDK\V2\FileManager\FileManager;

class Settings
{
    const PREFIX = 'tier_pricing_table_';

    /**
     * @var FileManager
     */
    private $fileManager;

    /**
     * Settings constructor.
     * @param FileManager $fileManager
     */
    public function __construct(FileManager $fileManager)
    {
        add_filter('woocommerce_general_settings', [$this, 'addPriceQuantityTableSettings']);
        $this->fileManager = $fileManager;
    }

    public function addPriceQuantityTableSettings($settings)
    {
        wp_enqueue_script('quantity-table-settings-js', $this->fileManager->locateAsset('admin/settings.js'));

        $settings[] = [
            "title" => __('Tiered price table settings', 'tier-pricing-table'),
            "desc" => __('This controls what and where quantity table prices are displayed at product page', 'tier-pricing-table'),
            "id" => self::PREFIX . "options",
            "type" => "title",
        ];

        $settings[] = [
            "title"    => __('Show tiered price table', 'tier-pricing-table'),
            "id"       => self::PREFIX . "display",
            "type"     => "checkbox",
            "default"  => "yes",
            "desc"     => __('Display a table on frontend? Prices will change even if it is off', 'tier-pricing-table'),
            "desc_tip" => true,
        ];

        $settings[] = [
            "title" => __('Display', 'tier-pricing-table'),
            "id" => self::PREFIX . "display_type",
            "type" => "select",
            "options" => [
                'tooltip' => __('Tooltip', 'tier-pricing-table'),
                'table'   => __('Table', 'tier-pricing-table'),
            ],
            "desc" => __('Type of displaying', 'tier-pricing-table'),
            "desc_tip" => true,
        ];

        $settings[] = [
            "title" => __('Table name', 'tier-pricing-table'),
            "id"    => self::PREFIX . "table_title",
            "type"  => "text",
            "default" => '',
            "desc"     => __('The name is being displayed above the table', 'tier-pricing-table'),
            "desc_tip" => true,
        ];

        $settings[] = [
            "title" => __('Table position', 'tier-pricing-table'),
            "id" => self::PREFIX . "position_hook",
            "type" => "select",
            "options" => [
                'woocommerce_before_add_to_cart_button' => __('Above buy button', 'tier-pricing-table'),
                'woocommerce_after_add_to_cart_button'  => __('Below buy button', 'tier-pricing-table'),
                'woocommerce_single_product_summary'  => __('Above product title', 'tier-pricing-table'),
                'woocommerce_after_single_product_summary'  => __('After product summary', 'tier-pricing-table'),
            ],
            "desc" => __('Where to display the table', 'tier-pricing-table'),
            "desc_tip" => true,
        ];

        $settings[] = [
            "title" => __('Tooltip icon color', 'tier-pricing-table'),
            "id"    => self::PREFIX . "tooltip_color",
            "type"  => "color",
            "css"   => "width:6em;",
            "default" => "#cc99c2",
            "desc" => __('Color of icon', 'tier-pricing-table'),
            "desc_tip" => true,
        ];

        $settings[] = [
            "title" => __('Tooltip icon size (px)', 'tier-pricing-table'),
            "id"    => self::PREFIX . "tooltip_size",
            "type"  => "number",
            "default" => "15",
            "desc" => __('Size of icon', 'tier-pricing-table'),
            "desc_tip" => true,
        ];

        $settings[] = [
            "title" => __('Active price background color', 'tier-pricing-table'),
            "id"    => self::PREFIX . "selected_quantity_color",
            "type"  => "color",
            "css"   => "width:6em;",
            "default" => "#cc99c2",
            "desc" => __('Active tired price background color', 'tier-pricing-table'),
            "desc_tip" => true,
        ];

        $settings[] = [
            "title"   => __('Quantity text', 'tier-pricing-table'),
            "id"      => self::PREFIX . "head_quantity_text",
            "type"    => "text",
            "default" => __('Quantity', 'tier-pricing-table'),
            "desc" => __('Name of quantity column', 'tier-pricing-table'),
            "desc_tip" => true,
        ];

        $settings[] = [
            "title"   => __('Price text', 'tier-pricing-table'),
            "id"      => self::PREFIX . "head_price_text",
            "type"    => "text",
            "default" => __('Price', 'tier-pricing-table'),
            "desc" => __('Name of price column', 'tier-pricing-table'),
            "desc_tip" => true,
        ];

        $settings[] = [
            "title"    => __('CSS class', 'tier-pricing-table'),
            "id"       => self::PREFIX . "table_css_class",
            "type"     => "text",
            "default"  => "",
            "desc"     => __('You can add your own css styles for this class. The class will be added to the table', 'tier-pricing-table'),
            "desc_tip" => true,
        ];

        $settings[] = [
            "type" => "sectionend",
            "id"   => self::PREFIX . "options"
        ];

        return $settings;
    }


    public function getAll()
    {
        return [
            'display'                 => $this->get('display', 'yes'),
            'position_hook'           => $this->get('position_hook', 'woocommerce_after_add_to_cart_button'),
            'head_quantity_text'      => $this->get('head_quantity_text', __('Quantity', 'tier-pricing-table')),
            'head_price_text'         => $this->get('head_price_text', __('Price', 'tier-pricing-table')),
            'display_type'            => $this->get('display_type', 'tooltip'),
            'selected_quantity_color' => $this->get('selected_quantity_color', '#cc99c2'),
            'table_title'             => $this->get('table_title', ''),
            'table_css_class'         => $this->get('table_css_class', '#fff'),
            'tooltip_size'            => $this->get('tooltip_size', 15),
        ];
    }

    public function get($option_name, $default = null)
    {
        return get_option(self::PREFIX . $option_name, $default);
    }

    public function getLink()
    {
        return admin_url('admin.php?page=wc-settings#'. self::PREFIX . 'display');
    }
}