@extends('layouts.app')

@section('content')

    <div ng-app="taskListApp">
        <div class="panel-body">
            @include('common.errors')

            <form action="{{ url('task') }}" class="form-horizontal" id="add-task-form">
                {{ csrf_field() }}

                <div class="form-group">
                    <label for="task-name" class="col-sm-3 control-label">Task</label>

                    <div class="col-sm-6">
                        <input type="text" name="name" id="task-name" class="form-control">
                    </div>
                </div>

                <div class="form-group">
                    <div class="col-sm-offset-3 col-sm-6">
                        <button type="button" onclick="createTask();" class="btn btn-default">
                            <i class="fa fa-plus"></i> Add Task
                        </button>
                    </div>
                </div>
            </form>
        </div>

        <div class="panel panel-default">
            <div class="panel-heading">
                Current Tasks
            </div>

            <div class="panel-body">

                <table id="task-table" class="table table-striped task-table" ng-controller="TaskListController">

                    <thead>
                        <tr>
                            <th>Task</th>
                            <th>Created</th>
                            <th>&nbsp;</th>
                        </tr>
                    </thead>

                    <tbody>
                        <tr ng-repeat="task in tasks" ng-show="tasks.length">

                            <td class="table-text">
                                <div>@{{task.name}}</div>
                            </td>

                            <td class="table-text">
                                <div>@{{task.created_at}}</div>
                            </td>

                            <td>
                                <form id="form-delete-task-@{{task.id}}" onsubmit="return false;">
                                    {{ csrf_field() }}
                                    {{ method_field('DELETE') }}

                                    <button type="button" id="button-delete-task_@{{task.id}}" onclick="deleteTask($(this).attr('id'))" class="btn btn-danger">
                                        <i class="fa fa-btn fa-trash"></i>Delete
                                    </button>
                                </form>
                            </td>
                        </tr>
                        <tr ng-show="!tasks.length">
                            <td colspan="3">There are no tasks in the task list.</td>
                        </tr>
                    </tbody>
                </table>

            </div>
        </div>

        <script>

            function deleteTask(id) {
                var ngController = angular.element($('#task-table')).scope();
                var ID = id.split('_')[1];
                var taskForm = $('#form-delete-task-' + ID);
                $.ajax({
                    type: "POST",
                    url: '/task/' + ID,
                    data: taskForm.serialize(),
                    success: function(data) {
                        ngController.refresh();
                    },
                    error: function(jqXHR, textStatus, errorThrown) {
                        alert('There was an error communicating with the server.');
                    }
                });
            }

            function createTask() {
                var ngController = angular.element($('#task-table')).scope();
                var taskForm = $("#add-task-form");
                $.ajax({
                    type: "POST",
                    url: taskForm.attr('action'),
                    data: taskForm.serialize(),
                    success: function(data) {
                        ngController.refresh();
                        $("#task-name").val('');
                    },
                    error: function(jqXHR, textStatus, errorThrown) {
                        alert('There was an error communicating with the server.');
                    }
                });
            }

        </script>

    </div>

@endsection