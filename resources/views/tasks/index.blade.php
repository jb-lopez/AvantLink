@extends('layouts.app')

@section('content')

    <!-- Bootstrap Boilerplate... -->

    <div class="panel-body">
        <!-- Display Validation Errors -->
    @include('common.errors')

    <!-- New Task Form -->
        <form action="{{ url('task') }}" class="form-horizontal" id="add-task-form" >
        {{ csrf_field() }}

        <!-- Task Name -->
            <div class="form-group">
                <label for="task-name" class="col-sm-3 control-label">Task</label>

                <div class="col-sm-6">
                    <input type="text" name="name" id="task-name" class="form-control">
                </div>
            </div>

            <!-- Add Task Button -->
            <div class="form-group">
                <div class="col-sm-offset-3 col-sm-6">
                    <button type="button" onclick="createTask()" class="btn btn-default">
                        <i class="fa fa-plus"></i> Add Task
                    </button>
                </div>
            </div>
        </form>
    </div>

    <!-- Create Task Form... -->

    <!-- Current Tasks -->
    @if (count($tasks) > 0)
        <div class="panel panel-default">
            <div class="panel-heading">
                Current Tasks
            </div>

            <div class="panel-body">

                <table class="table table-striped task-table" ng-controller="TaskListController">

                    <!-- Table Headings -->
                    <thead>
                        <tr>
                            <th>Task</th>
                            <th>Created</th>
                            <th>&nbsp;</th>
                        </tr>
                    </thead>

                    <!-- Table Body -->
                    <tbody>
                        <tr ng-repeat="task in tasks">

                            <!-- Task Name -->
                            <td class="table-text">
                                <div>@{{task.name}}</div>
                            </td>

                            <!-- Task Created -->
                            <td class="table-text">
                                <div>@{{task.created_at}}</div>
                            </td>

                            <!-- Delete Button -->
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
                    </tbody>
                </table>

            </div>
        </div>

        <script>
            function deleteTask(id){
                var taskID = id.split('_');
                var ID = taskID[1];
                var taskForm = $('#form-delete-task-' + ID);
                var taskTR = taskForm.parent().parent();
                $.ajax({
                    type: "POST",
                    url: '/task/'+ID,
                    data: taskForm.serialize(),
                    success: function(data){
                        taskTR.remove();
                    },
                    error: function (jqXHR, textStatus, errorThrown) {
                        alert('There was an error communicating with the server.');
                    }
                });
            }

            function createTask(){
                var taskForm = $("#add-task-form");
                $.ajax({
                    type: "POST",
                    url: taskForm.attr('action'),
                    data: taskForm.serialize(),
                    success: function(data){
                        window.location.reload();
//                        $.ajax({
//                            type: "GET",
//                            url: '/tasks/json',
//                            success: function(data){
//                                $ctrl.tasks = data;
//                            }
//                        })
//                        taskListApp.addTask(taskForm.serialize());
                    },
                    error: function (jqXHR, textStatus, errorThrown) {
                        alert('There was an error communicating with the server.');
                    }
                });
            }

        </script>


    @endif

@endsection