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
        // return redirect('/')->with($test);
        $markup = view('components.table._body',compact('test'))->render();
        return response()->json(['html' => $markup]);
    }
}
