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
        <tr ng-repeat="task in $ctrl.tasks">

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