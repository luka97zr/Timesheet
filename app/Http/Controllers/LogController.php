<?php

namespace App\Http\Controllers;

use App\Http\Requests\LogRequest;
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
        return Log::where([
            ['date',$date],
            ['user_id',auth()->user()->id]
        ])->with([
            'categoryProject',
            'categoryProject.project',
            'categoryProject.category',
            'categoryProject.project.client',
            ])->get();
    }

    public function store(Request $request) {
        $data = $request->validate([
            'data.*.date'          => ['required','date_format:Y-m-d'],
            'data.*.hours'         => ['required','numeric','gt:0'],
            'data.*.description'   => ['max: 255','string','nullable'],
            'data.*.category_project_id'   => ['required'],
        ]);
        Log::where([
            ['date',$data['data']],
            ['user_id', auth()->user()->id]
            ])->delete() ?? null;

            collect($data['data'])->each(function($singleData) {
            $singleData['user_id'] = auth()->user()->id;
            Log::create($singleData);
        });

        return response()->json(['success' => true]);
    }

}
