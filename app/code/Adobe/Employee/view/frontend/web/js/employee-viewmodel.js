/**
 * Copyright © Magento, Inc. All rights reserved.
 * See COPYING.txt for license details.
 */
define([
    'uiComponent',
    'ko',
    'jquery',
    'mage/url',
    'mage/storage'
], function (Component, ko, $, url, storage) {

    return Component.extend({

        initialize: function () {
            this._super();

            var self = this;

            self.employees = ko.observableArray([]);
            self.showForm = ko.observable(false);

            self.id = ko.observable(null);
            self.name = ko.observable('');
            self.joiningDate = ko.observable('');
            self.designation = ko.observable('');
            self.address = ko.observable('');
            self.status = ko.observable(1);
            self.hobbies = ko.observableArray([]);

            self.allHobbies = [
                'Reading', 'Gaming', 'Sports',
                'Music', 'Travel', 'Cooking'
            ];

            self.editEmployee = self.editEmployee.bind(self);
            self.deleteEmployee = self.deleteEmployee.bind(self);
            self.saveEmployee = self.saveEmployee.bind(self);

            self.loadEmployees();

            return this;
        },

        loadEmployees: function () {
            var self = this;

            storage.get(url.build('/employee/Ajax/listing'))
                .done(function (res) {
                    self.employees(res.items || []);
                });
        },

        addEmployee: function () {
            this.resetForm();
            this.showForm(true);
        },

        editEmployee: function (emp) {
            console.log("Button clicked");

            var self = this;

            self.id(emp.id || null);
            self.name(emp.name || '');
            self.joiningDate(emp.joining_date || '');
            self.designation(emp.designation || '');
            self.address(emp.address || '');
            self.status(emp.status || 1);

            /* FIXED HERE */
            if (Array.isArray(emp.hobbies)) {
                self.hobbies(emp.hobbies);
            } else if (emp.hobbies) {
                self.hobbies(emp.hobbies.split(','));
            } else {
                self.hobbies([]);
            }

            self.showForm(true);
        },

        saveEmployee: function () {
            var self = this;

            var payload = {
                id: self.id(),
                name: self.name(),
                joining_date: self.joiningDate(),
                designation: self.designation(),
                address: self.address(),
                status: self.status(),
                hobbies: self.hobbies()
            };

            storage.post(
                url.build('employee/Ajax/save'),
                JSON.stringify(payload)
            ).done(function (res) {
                if (res.success) {
                    self.showForm(false);
                    self.resetForm();
                    self.loadEmployees();
                }
            });
        },

        deleteEmployee: function (emp) {
            var self = this;

            if (!confirm('Are you sure?')) return;

            storage.post(
                url.build('employee/ajax/delete'),
                JSON.stringify({ id: emp.id })
            ).done(function (res) {
                if (res.success) {
                    self.loadEmployees();
                }
            });
        },

        cancelForm: function () {
            this.showForm(false);
        },

        resetForm: function () {
            this.id(null);
            this.name('');
            this.joiningDate('');
            this.designation('');
            this.address('');
            this.status(1);
            this.hobbies([]);
        }
    });
});