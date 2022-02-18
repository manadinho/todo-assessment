<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Todo;
use Carbon\Carbon;

class TodoController extends Controller
{
    public function store(Request $request)
    {
        $validator = $request->validate([
            'title'     => 'required',
            'deadline'  => 'required'
        ]);
        $todo_data['title'] = $request->title;
        $todo_data['deadline'] = Carbon::createFromFormat('Y-m-d H:i:s', $request->deadline, session('timezone'))->setTimezone('UTC');
        Todo::create($todo_data);
        return redirect()->route('home');
    }
}
