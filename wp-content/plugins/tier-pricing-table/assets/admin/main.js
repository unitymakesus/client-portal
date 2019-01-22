jQuery(document).ready(tierPricinTable);
jQuery(document).on('woocommerce_variations_loaded', tierPricinTable);

function tierPricinTable(){
    var $ = jQuery;

    var addNewButton = $('[data-add-new-price-rule]');

    addNewButton.on('click', function(e){
        e.preventDefault();

        var newRuleInputs  = $(e.target.parentElement).parent().find('[data-price-rules-input-wrapper]').first().clone();

        $('<span data-price-rules-container></span>').insertBefore($(e.target))
            .append(newRuleInputs)
            .append('<span class="notice-dismiss remove-price-rule" data-remove-price-rule></span>')
            .append('<br><br>');

        newRuleInputs.children('input').val('');
    });

    $('body').on('click', '.remove-price-rule', function(e){
        e.preventDefault();

        var element    = $(e.target.parentElement);
        var wrapper    = element.parent('[data-price-rules-wrapper]');
        var containers = wrapper.find('[data-price-rules-container]');

        if((containers.length) < 2){
            containers.find('input').val('');
            return;
        }

        $('.wc_input_price').trigger('change');

        element.remove();
    });
}
