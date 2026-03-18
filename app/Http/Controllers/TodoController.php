<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Todo;
use Illuminate\Support\Facades\Auth;

class TodoController extends Controller
{
    // get todos
    public function index()
    {
        $todos = Todo::where('user_id', Auth::id())->get();

        return view('todos.index', compact('todos'));

        //  return response()->json(['data' => $todos ]);
    }

    public function store(Request $req)
    {

        $validate = $req->validate([
            'title' => 'required|string|max:255'
        ]);

        Todo::create([
            'title' => $req->title,
            'user_id' => Auth::id()
        ]);

        return back()->with('success', 'Todo created successfully');
    }

    public function update(Todo $todo)
    {
        if ($todo->user_id !== Auth::id()) {
            abort(403);
        }


        $todo->update([
            'is_completed' => ! $todo->is_completed
        ]);

        return back()->with('success', 'Todo updated successfully');
    }

    public function destroy(Todo $todo)
    {

        if ($todo->user_id == Auth::id()) {

            $todo->delete();
            return back()->with('success', 'Todo deleted successfully');
        } else {
            abort(403);
        }
    }
}
