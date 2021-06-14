define([
    'uiComponent',
    'jquery',
    'ko'
], function (Component, $, ko) {
    'use strict';
    return Component.extend({
        commenterName: ko.observable(''),
        commenterMessage: ko.observable(''),
        isLoading: ko.observable(false),
        url: '',
        initialize: function () {
            this._super();
            this.nextComment();
            return this;
        },
        nextComment: function () {
            this.isLoading(true);
            var self = this;
            $.ajax({
                url: self.url,
                type: 'post',
                dataType: 'json'
            })
                .done(function (data) {
                    // data = JSON.parse(data);
                    if (data.name && data.message) {
                        self.commenterName(data.name);
                        self.commenterMessage(data.message);
                    }
                }).always(function () {
                self.isLoading(false);
            });
        }
    });
});
