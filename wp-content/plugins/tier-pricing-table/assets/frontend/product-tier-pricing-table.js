jQuery(document).ready(function($){
    $.widget.bridge('uiTooltip', $.ui.tooltip);

    var quantityProductField = $('.cart').find('[name=quantity]');

    function triggerPriceRule(amount, price){
        var priceContainer;

        if(tierPricingTable['product_type'] === 'variable'){
            priceContainer = $('.woocommerce-variation-price > .price');

            if(priceContainer.children('ins').length > 0 ){
                priceContainer.find('ins').html(price);
            }else{
                priceContainer.find('span:first').html(price);
            }
        } else {
            priceContainer = $('.summary > .price');

            if(priceContainer.children('ins').length > 0 ){
                priceContainer.find('ins').html(price);
            }else{
                priceContainer.find('span:first').html(price);
            }
        }

        $('[data-price-rules-amount="'+amount+'"]').addClass('price-rule-active');
    }

    function setTierPrice(e){

        var priceRulesTable = $('[data-price-rules-table]');

        $('.price-rule-active').removeClass('price-rule-active');

        if(priceRulesTable.length > 0){

            var priceRules = JSON.parse(priceRulesTable.attr('data-price-rules'));

            var quantity   = parseInt(e.target.value);
            var _keys      = [];

            for (var k in priceRules) {
                if (priceRules.hasOwnProperty(k)) {
                    _keys.push(parseInt(k));
                }
            }

            _keys = _keys.sort(function(a, b){return a > b}).reverse();

            for (var i = 0; i < _keys.length; i++) {
                var amount = parseInt(_keys[i]);
                var findPrice = false;
                var _price;

                if(quantity >= amount){

                    _price = $('[data-price-rules-amount='+amount+']').find('[data-price-rules-formated-price]').html();

                    triggerPriceRule(amount, _price);

                    findPrice = true;
                    break;
                }
            }
            if(!findPrice){
                _price = $('[data-price-rules-amount=1]').find('[data-price-rules-formated-price]').html();
                triggerPriceRule(1, _price);
            }
        }
    }

    $(document).on('reset_data', function(){
        $('[data-variation-price-rules-table]').html('');
    });

    if(tierPricingTable['product_type'] === 'variable'){
        $( ".single_variation_wrap" ).on( "show_variation", function ( event, variation ) {
            $.post(document.location.pathname + '?wc-ajax=get_price_table', { product_id: variation['variation_id'] }, function(response){
                $('.price-rules-table').remove();

                $('[data-variation-price-rules-table]').html(response);
                quantityProductField.trigger('input');
            });
        });
    }


    if(tierPricingTable.settings.display_type === 'tooltip'){
        $(document).uiTooltip({
            items: '.price-table-tooltip-icon',
            tooltipClass: "price-table-tooltip",
            content: function () {
                return $('[data-price-rules-table]');
            },
            hide: {
                effect: "fade",
            },
            position: {
                my: "left bottom-30",
                at: "right bottom",
                using: function( position ) {
                    $( this ).css( position );
                }
            },
            close: function (e, tooltip) {
                tooltip.tooltip.innerHTML = '';
            }
        });
    }


    quantityProductField.on('input', setTierPrice);
    quantityProductField.trigger('input');
});

