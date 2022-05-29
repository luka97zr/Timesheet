<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class CalendarController extends Controller
{
    public function get() {
        return view('index');
    }

    public function store() {
        $test = request()->all();
        $html = view('index',compact('test'))->render();
        return response()->json(['success'=>$test]);
    }
}
