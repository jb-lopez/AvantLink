'use strict';

var taskListApp = angular.module('taskListApp', ['taskList']);

taskListApp.controller('TaskListController', function($scope, $http) {
    $http.get('/tasks/json').success(function(data) {
        $scope.tasks = data;
    });

    $scope.addTask = function(formData) {
        $http.post('/task', formData).success(function(data) {
            $http.get('/tasks/json').success(function(data) {
                $scope.tasks = data;
            });
        });
    }

});
