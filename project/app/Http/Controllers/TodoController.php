<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\TodoList;
use App\Models\Task;

class TodoController extends Controller
{
    public function index() {
        $data = Task::get();

        return view('todo', ['data' => $data]);
    }

    public function createTodo(Request $request)
    {
        $this->validate($request,[
            'task' => 'required'
        ]);

        $task = $request->input('task');
        $description = $request->input('description');

        $todoList = new TodoList($task, $description);
        $todoList->setBackground($request->input('bg'))
                 ->setMusic($request->input('music'))
                 ->save();

        return back()->with('success', 'Todo created successfully');
    }

    public function deleteTodo($id) {
        Task::destroy($id);

        return back()->with('success', 'Todo deleted successfully');
    }

    public function checkedTodo($id, Request $request) {
        $checked = Task::where('id', $id)->update([
            'is_checked' => filter_var($request->checked ?? false, FILTER_VALIDATE_BOOLEAN)
        ]);

        return back()->with('success', 'Todo checked successfully');
    }
}
