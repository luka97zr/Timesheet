<?php

namespace App\Http\Controllers;

use App\Models\Log;
use Carbon\Carbon;
use Illuminate\Http\Request;

class CalendarController extends Controller
{
    public function __invoke(Request $request,$from,$to) {
        // $startDate = Carbon::createFromFormat('Y-m-d',$request['from'])->date;
        // $endDate = new Carbon($request['to']);
        
        $logs = Log::whereBetween('date',[$from,$to])->where('user_id','=',$request['id'])->with(['category.project'])->get();
        
    }
}
