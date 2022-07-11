<?php

namespace App\Http\Controllers;

use App\Models\CategoryProject;
use App\Models\Log;
use App\Models\UserProject;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Http\Request;

class LogController extends Controller
{
    public function index() {
    }

    public function show($date) {
        // return CategoryProject::whereHas('Log', function(Builder $query) use ($date) {
        //     $query->where('date','=',$date);
        // })->with(['log','project','category'])->get();

        return Log::where('date','=',$date)->with([
            'categoryProject',
            'categoryProject.project',
            'categoryProject.category'
            ])->get();
    }

    public function store(Request $request) {
        $data = $request->validate([
            'data.*.date'          => ['required','date_format:Y-m-d'],
            'data.*.hours'         => ['required','numeric','gt:0'],
            'data.*.description'   => ['max: 255','string','nullable'],
            'data.*.category_id'   => ['required'],
            'data.*.user_id'       => ['required'],
        ]);
        (Log::where('date',$data['data']))? Log::where('date',$data['data'])->delete() : null;

       collect($data['data'])->each(function($singleData) {
            Log::create($singleData);
        });

        return response()->json(['success' => true]);
    }

}
