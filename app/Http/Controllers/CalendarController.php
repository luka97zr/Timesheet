<?php

namespace App\Http\Controllers;

use App\Models\Calendar;
use Illuminate\Http\Request;

class CalendarController extends Controller
{
    public function get() {
        return view('index');
    }

    public function show($date) {
        return Calendar::findOrFail($date);
    }


}
