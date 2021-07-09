define([
    'jquery',
    'mage/translate',
    'jquery/ui'
], function ($, $t) {

    console.log('OK');

    return function (widget) {
        $.widget('mage.catalogAddToCart', widget, {
            submitForm: function (form) {
                if (confirm('Are you sure?')) {
                    this._super(form);
                } else {
                    return false;
                }
            }
        });

        return $.widget.catalogAddToCart;
    }
});
