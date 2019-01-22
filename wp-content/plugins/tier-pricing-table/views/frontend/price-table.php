<?php if ( ! defined( 'WPINC' ) ) die; ?>

<?php if(!empty($price_rules)): ?>

    <div class="price-rules-table-wrapper">
        <?php if(!empty($settings['table_title'])): ?>
            <h3 style="clear:both;"><?php echo $settings['table_title']; ?></h3>
        <?php endif; ?>

        <?php do_action('before_tier_pricing_table'); ?>

        <table class="shop_table price-rules-table <?php echo $settings['table_css_class'] ?>" data-price-rules-table data-product-id="<?php echo $product_id; ?>" data-price-rules="<?php echo htmlspecialchars(json_encode($price_rules)); ?>">
        <thead>
            <tr>
                <th><span class="nobr"><?php echo sanitize_text_field($settings['head_quantity_text']); ?></span></th>
                <th><span class="nobr"><?php echo sanitize_text_field($settings['head_price_text']); ?></span></th>
            </tr>
        </thead>

        <tbody>
            <tr data-price-rules-amount="1" data-price-rules-price="<?php echo $real_price ?>" data-price-rules-row>
                <td>
                    <?php if(1 === array_keys($price_rules)[0] - 1): ?>
                        <span>1</span>
                    <?php else: ?>
                        <span>1 - <?php echo array_keys($price_rules)[0] - 1; ?></span>
                    <?php endif; ?>
                </td>
                <td>
                    <span data-price-rules-formated-price><?php echo wc_price($real_price); ?></span>
                </td>
            </tr>

            <?php $iterator = new ArrayIterator($price_rules); ?>

                <?php while($iterator->valid()): ?>
                    <?php
                        $current_price    = $iterator->current();
                        $current_quantity = $iterator->key();

                        $iterator->next();

                        if($iterator->valid()){
                            if($iterator->key() - $current_price == 1){
                                $quantity = $current_quantity;
                            }else{
                                $quantity = $current_quantity . ' - ' . intval($iterator->key() - 1 );
                            }

                        }else{
                            $quantity = $current_quantity . '+';
                        }
                    ?>
                    <tr data-price-rules-amount="<?php echo $current_quantity ?>" data-price-rules-price="<?php echo $current_price ?>" data-price-rules-row >
                        <td>
                            <span><?php echo $quantity ?></span>
                        </td>
                        <td>
                            <span data-price-rules-formated-price><?php echo wc_price($current_price) ?></span>
                        </td>
                    </tr>
                <?php endwhile; ?>

        </tbody>
    </table>

    <?php do_action('before_tier_pricing_table'); ?>

    </div>

    <style>
        .price-rule-active td{
            background-color: <?php echo $settings['selected_quantity_color'] ?> !important;
        }
        .price-rules-table-wrapper{
            <?php echo $settings['display_type'] == 'tooltip' ? 'display: none; ' : ''; ?>
        }
    </style>
<?php endif; ?>