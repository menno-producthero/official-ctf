<?php

namespace App\Http\Controllers;

use App\Models\Todo;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use Illuminate\Support\Facades\DB;
use Inertia\Inertia;

class TodoController extends Controller
{
    public function index(Request $request)
    {
        $search = $request->get('search');
        $todos = DB::select("SELECT * FROM todos WHERE title LIKE '%$search%' ORDER BY created_at DESC");

        return Inertia::render('Todos/Index', ['todos' => $todos]);
    }

    public function store(Request $request)
    {
        $request->validate([
            'title' => ['required', 'string'],
        ]);

        Todo::create([
            'title' => $request->title,
        ]);

        return redirect()->back();
    }

    public function update(Request $request, Todo $todo)
    {
        $todo->update([
            'completed' => !$todo->completed,
        ]);

        return;
    }

    public function destroy(Todo $todo)
    {
        $todo->delete();

        return;
    }
}
