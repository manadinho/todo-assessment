<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Todo;

class HomeController extends Controller
{

    public function home()
    {
        $todos = Todo::paginate(10);
        return view('home',['todos' => $todos]);
    }
}
