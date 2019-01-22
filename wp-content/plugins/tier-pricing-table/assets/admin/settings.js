jQuery(document).ready(function($){
    var prefix        = 'tier_pricing_table_';
    var displayType   = $('[name='+prefix+'display_type]');
    var tablePosition = $('[name='+prefix+'position_hook]');
    var tableTitle    = $('[name='+prefix+'table_title]');
    var tooltipColor  = $('[name='+prefix+'tooltip_color]');
    var tooltipSize  = $('[name='+prefix+'tooltip_size]');

    displayType.on('change', function() {
        if(displayType.val() === 'tooltip'){
            tooltipColor.attr('disabled', false);
            tablePosition.attr('disabled', true);
            tableTitle.attr('disabled', true);
            tooltipSize.attr('disabled', false);
        }else{
            tableTitle.attr('disabled', false);
            tablePosition.attr('disabled', false);
            tooltipColor.attr('disabled', true);
            tooltipSize.attr('disabled', true);
        }
    });

    displayType.trigger('change');
});