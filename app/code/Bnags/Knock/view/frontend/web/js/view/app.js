define([
    'uiComponent',
    'ko'
], function (Component, ko) {
    'use strict';

    return Component.extend({
        initialize: function () {
            this._super();

            this.firstName = ko.observable('Bert');
            this.lastName = ko.observable('Bertington');

            this.fullName = ko.pureComputed(function () {
                return this.firstName() + ' ' + this.lastName();
            }, this);

            return this;
        },

        capitalizeLastName: function () {
            let currentVal = this.lastName();
            this.lastName(currentVal.toUpperCase());
        }
    });
});