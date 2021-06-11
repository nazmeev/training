define([
    'underscore',
    'jquery',
    'mage/utils/wrapper'
], function (_, $, wrapper) {
    'use strict';

    return function (placeOrderAction) {
        return wrapper.wrap(placeOrderAction, function (originalAction, paymentData, messageContainer) {

            var additionalData = [];
            additionalData['additional_data'] = [];
            additionalData['additional_data']['printed-invoice'] = '999999999'; //$('#printed-invoice').prop('checked');

            paymentData = _.extend(paymentData, additionalData);
            return originalAction(paymentData, messageContainer);
        });
    };
});
