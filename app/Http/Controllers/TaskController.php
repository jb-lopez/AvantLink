<?php

namespace App\Http\Controllers;

use App\Http\Requests;
use App\Repositories\TaskRepository;
use App\Task;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class TaskController extends Controller
{

    /**
     * Create a new controller instance.
     *
     * @param  TaskRepository  $tasks
     */
    public function __construct(TaskRepository $tasks)
    {
        $this->middleware('auth');

        $this->tasks = $tasks;
    }

    /**
     * Display a list of all of the user's task.
     *
     * @param  Request  $request
     * @return Response
     */
    public function index(Request $request)
    {
        return view('tasks.index', [
            'tasks' => $this->tasks->forUser($request->user()),
        ]);
    }

    /**
     * Display a list of all of the user's task in json.
     *
     * @param  Request  $request
     * @return Response
     */
    public function json(Request $request)
    {
        return view('tasks.json', [
            'tasks' => $this->tasks->forUser($request->user()),
        ]);
    }

    /**
     * Display the angular template form.
     *
     * @param  Request  $request
     * @return Response
     */
    public function template(Request $request)
    {
        return view('tasks.template', [
            'tasks' => $this->tasks->forUser($request->user()),
        ]);
    }

    /**
     * Create a new task.
     *
     * @param  Request  $request
     * @return Response
     */
    public function store(Request $request)
    {
        $this->validate($request, [
            'name' => 'required|max:255',
        ]);

        $request->user()->tasks()->create(['name' => $request->name,]);
    }

    /**
     * Destroy the given task.
     *
     * @param  Request  $request
     * @param  Task  $task
     * @return Response
     */
    public function destroy(Request $request, Task $task)
    {
        $this->authorize('destroy', $task);
        $task->delete();
    }

}
