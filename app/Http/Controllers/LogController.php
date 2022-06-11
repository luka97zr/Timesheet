<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Log;
use Illuminate\Http\Request;

class LogController extends Controller
{
    public function index() {
        return view('index');
    }

    public function show($date) {
        return Log::where('date', $date)->first();
    }

    public function store() {
        $data = request()->validate([
            'date'          => ['required','date_format:Y-m-d'],
            'hours'         => ['required'],
            'description'   => ['max: 255'],
            // 'category_id'   => ['required'],
            // 'user_id'       => ['required'],
        ]);
        
        // $log = Log::create($data);
        return response()->json(['success' => true]);
    }

}
