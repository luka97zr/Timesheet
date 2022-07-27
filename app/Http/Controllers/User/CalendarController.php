<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use App\Models\Log;
use Illuminate\Http\Request;

class CalendarController extends Controller
{
    public function __invoke(Request $request,$from,$to) {
        $hoursArr=[];
        $key='';
        $logs = Log::whereBetween('date',[$from,$to])->where('user_id','=',auth()->user()->id)->with(['categoryProject'])->get();
        foreach($logs as $index => $log) {
            $key = array_search($log['date'],array_column($hoursArr,'date'));
            if($key === false) {
                array_push($hoursArr,[
                    'date' => $log['date'],
                    'hours' => $log['hours']
                ]);
            } else {
                $hoursArr[$key]['hours'] += $log['hours'];
            }
        }
      return $hoursArr;
    }
}
