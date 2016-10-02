"use strict";

var taskListApp = angular.module("taskListApp", []);

taskListApp.controller("TaskListController", function($scope, $http) {
    $scope.refresh = function() {
        $http.get("/tasks/json").success(function(data) {
            $scope.tasks = data;
        });
    };

    $scope.refresh();

});
