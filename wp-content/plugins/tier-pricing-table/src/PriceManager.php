<?php namespace TierPricingTable;

class PriceManager{

    /**
     * Return price rules or empty array if not exist rules
     *
     * @param $product_id
     * @return array
     */
    static function getPriceRules($product_id)
    {
        $rules = get_post_meta($product_id, '_price_rules', true);
        $rules = empty($rules) ? [] : $rules;

        ksort($rules );

        return $rules;
    }

    /**
     * @param int $quantity
     * @param int $product_id
     * @return bool|float|int
     */
    public static function getPriceByRules($quantity, $product_id){

        $rules = self::getPriceRules($product_id);

        foreach(array_reverse($rules, true) as $_amount => $price){
            if($_amount <= $quantity) {
                return $price;
            }
        }

        return false;
    }
}