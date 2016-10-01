'use strict';

angular
    .module('taskList')
    .component('taskList', {
        templateUrl: '/tasks/template',
        controller: function TaskListController($http) {
            var self = this;
            self.orderProp = 'id';

            $http.get('/tasks/json').then(function(response) {
                self.tasks = response.data;
            });
        }
    });