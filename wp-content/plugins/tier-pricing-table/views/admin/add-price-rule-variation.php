<?php if ( ! defined( 'WPINC' ) ) die; ?>

<p class="form-field" style="clear:both; margin: 0"><?php _e("Tiered price", 'tier-pricing-table' ); ?></p>

<p class="form-field" style="margin-top: 0" data-price-rules-wrapper>

    <?php if(!empty($price_rules)): ?>
        <?php foreach ($price_rules as $amount => $price): ?>
            <span data-price-rules-container>
                <span data-price-rules-input-wrapper>
                    <input type="number" value="<?php echo $amount; ?>" min="2" placeholder="<?php _e('Quantity', 'tier-pricing-table' ); ?>" class="price-quantity-rule price-quantity-rule--variation" name="_dynamic_price_amount[<?php echo $i; ?>][]">
                    <input type="text"  value="<?php echo wc_format_localized_price($price); ?>" placeholder="<?php _e('Price', 'tier-pricing-table' ); ?>" class="wc_input_price price-quantity-rule--variation" name="_dynamic_price_value[<?php echo $i; ?>][]" >
                </span>
                <span class="notice-dismiss remove-price-rule" data-remove-price-rule></span>
                <br>
                <br>
            </span>

        <?php endforeach;?>
    <?php endif;?>

    <span data-price-rules-container>
        <span data-price-rules-input-wrapper>
            <input type="number" min="2" placeholder="<?php _e('Quantity', 'tier-pricing-table' ); ?>" class="price-quantity-rule price-quantity-rule--variation" name="_dynamic_price_amount[<?php echo $i; ?>][]">
            <input type="text"  placeholder="<?php _e('Price', 'tier-pricing-table' ); ?>" class="wc_input_price  price-quantity-rule--variation"name="_dynamic_price_value[<?php echo $i; ?>][]" >
        </span>
        <span class="notice-dismiss remove-price-rule" data-remove-price-rule></span>
        <br>
        <br>
    </span>

    <button class="button" data-add-new-price-rule><?php _e("New tier", 'tier-pricing-table' ); ?></button>
</p>