@extends('layouts.app')

@section('content')

    <!-- Bootstrap Boilerplate... -->

    <div class="panel-body">
        <!-- Display Validation Errors -->
    @include('common.errors')

    <!-- New Task Form -->
        <form action="{{ url('task') }}" method="POST" class="form-horizontal">
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
                    <button type="submit" class="btn btn-default">
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
                <table class="table table-striped task-table">

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
                        @foreach ($tasks as $task)
                            <tr id="task-{{$task->id}}">
                                <!-- Task Name -->
                                <td class="table-text">
                                    <div>{{ $task->name }}</div>
                                </td>

                                <!-- Task Created -->
                                <td class="table-text">
                                    <div>{{ $task->created_at }}</div>
                                </td>

                                <!-- Delete Button -->
                                <td>
                                    <form action="{{ url('task/'.$task->id) }}" method="POST">
                                        {{ csrf_field() }}
                                        {{ method_field('DELETE') }}

                                        <button type="submit" id="delete-task-{{ $task->id }}" class="btn btn-danger">
                                            <i class="fa fa-btn fa-trash"></i>Delete
                                        </button>
                                    </form>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>

                <task-list></task-list>

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

            function createTask(task){
                $.ajax({
                    type: "POST",
                    url: taskForm.attr('action'),
                    data: taskForm.serialize(),
                    success: function(data){
                        taskTR.remove();
                    },
                    error: function (jqXHR, textStatus, errorThrown) {
                        alert('There was an error communicating with the server.');
                    }
                });
            }
        </script>


    @endif

@endsection