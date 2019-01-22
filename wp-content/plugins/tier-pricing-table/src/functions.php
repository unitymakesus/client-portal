<?php

function render_price_quantity_table(){
    global $post;

    if(!$post){
        return false;
    }

    $product = wc_get_product($post->ID);

    if($product->is_type('simple')){
        $GLOBALS['price_table_frontend']->_renderPriceTable();
    } elseif ( $product->is_type('variable')) {
        echo '<div data-variation-price-rules-table></div>';
    }

    return false;
}