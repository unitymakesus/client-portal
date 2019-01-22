<?php if ( ! defined( 'WPINC' ) ) die; ?>

<p class="form-field">
    <label><?php _e("Tiered price", 'tier-pricing-table' ); ?></label>
    <span data-price-rules-wrapper>
        <?php if(!empty($price_rules)): ?>
            <?php foreach ($price_rules as $amount => $price): ?>
                <span data-price-rules-container>
                    <span data-price-rules-input-wrapper>
                        <input type="number" value="<?php echo $amount; ?>" min="2" placeholder="<?php _e('Quantity', 'tier-pricing-table' ); ?>" class="price-quantity-rule price-quantity-rule--simple" name="_dynamic_price_amount[]">
                        <input type="text"  value="<?php echo wc_format_localized_price($price); ?>" placeholder="<?php _e('Price', 'tier-pricing-table' ); ?>" class="wc_input_price price-quantity-rule--simple" name="_dynamic_price_value[]" >
                    </span>
                    <span class="notice-dismiss remove-price-rule" data-remove-price-rule></span>
                    <br>
                    <br>
                </span>

            <?php endforeach;?>
        <?php endif;?>

        <span data-price-rules-container>
            <span data-price-rules-input-wrapper>
                <input type="number" min="2" placeholder="<?php _e('Quantity', 'tier-pricing-table' ); ?>" class="price-quantity-rule price-quantity-rule--simple" name="_dynamic_price_amount[]">
                <input type="text"  placeholder="<?php _e('Price', 'tier-pricing-table' ); ?>" class="wc_input_price  price-quantity-rule--simple"name="_dynamic_price_value[]" >
            </span>
            <span class="notice-dismiss remove-price-rule" data-remove-price-rule></span>
            <br>
            <br>
        </span>
    <button data-add-new-price-rule class="button"><?php _e("New tier", 'tier-pricing-table' ); ?></button>

    </span>
</p>