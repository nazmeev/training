define([
    'uiComponent',
    'jquery',
    'ko'
], function (Component, $, ko) {
    'use strict';
    return Component.extend({
        qtyFunc: ko.observable(''),
        isLoading: ko.observable(false),
        product_id: ko.observable(false),
        url: '',
        initialize: function () {
            this._super();
            this.getQty();
            return this;
        },
        getQty: function () {
            this.isLoading(true);
            var self = this;
            $.ajax({
                url: self.url,
                type: 'post',
                data: {productId: this.product_id },
                // data: {productId: self.product_id },  ????? what is better ?????
                dataType: 'json'
            })
                .done(function (data) {
                    // data = JSON.parse(data);
                    if (data.qty) {
                        self.qtyFunc(data.qty);
                    }else{
                        self.qtyFunc('');
                        alert('Something wrong ... ')
                    }
                }).always(function () {
                self.isLoading(false);
            });
        }
    });
});
