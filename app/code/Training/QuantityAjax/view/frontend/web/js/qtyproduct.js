define([
    'uiComponent',
    'jquery',
    'ko'
], function (Component, $, ko) {
    'use strict';
    return Component.extend({
        qty: ko.observable(''),
        isLoading: ko.observable(false),
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
                dataType: 'json'
            })
                .done(function (data) {
                    // data = JSON.parse(data);
                    if (data.qty) {
                        self.qty(data.qty);
                    }
                }).always(function () {
                self.isLoading(false);
            });
        }
    });
});
