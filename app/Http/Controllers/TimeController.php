<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Carbon\Carbon;
use App\Models\Time;
use Maatwebsite\Excel\Facades\Excel;
use App\Exports\TimeExport;
use App\Traits\UserNames;

class TimeController extends Controller
{
    use UserNames;
    //
    public function store(Request $request) {
        $eTime = '';
        $sTime = '';
        $userID = '';
        $res = '';

        if(!preg_match("/^[0-9]*$/", $request->limit_num)){
            return redirect()->back()->with("err_message", "Only positive numbers are valid");
        }
        $limit = $request->limit_num;
        if(!$limit){
            $limit = 50;
            $res .= "Default limit was used";
        }
        $boardNum = $request->board_id;
        if(!$boardNum){
            $boardNum = 1068170039;
            $res .= "Default board number was used";
        }
        $col_id = $request->column_id;
        if(!$col_id){
            $columnId = '(ids: time_tracking5)';
            $res .= "Default limit was used";
        }else{
            $columnId = '(ids: ' . $col_id . ')';
        }

        $hoursWorked = '';
        $url = env('MONDAY_API_URL');
        $token = env('MONDAY_API_TOKEN');
        $query = 'query { boards(ids: '.$boardNum.') { name items(limit: '.$limit.') { name state subscribers { id name } creator { name } column_values '.$columnId.' { id value text type title }}}}';
        $headers = [
            'Content-Type: application/json',
            'Authorization: ' . $token
        ];


        try {
            $data = @file_get_contents($url, false, stream_context_create([
                'http' => [
                    'method' => 'POST',
                    'header' => $headers,
                    'content' => json_encode(['query' => $query]),
                ]
            ]));

        #json decode response
        $response = json_decode($data, true);

        # Get board name
        $boardName = $response["data"]["boards"][0]["name"];

        if(Time::exists()){
            Time::truncate();
        }

        # loop through the items that are in the board
        for($i =0; $i < count($response["data"]["boards"][0]["items"]); $i++){
            $taskName = $response["data"]["boards"][0]["items"][$i]["name"];
            $taskStatus = $response["data"]["boards"][0]["items"][$i]["state"];
            $dr = $response["data"]["boards"][0]["items"][$i]["column_values"];

            #Create an object from $dr returned string
            $obj = json_decode($dr[0]["value"]);

            // dd($dr, $obj);
            if ($obj === []){
                continue;
            }

                $count = count($obj->additional_value);

                for ($a = 0; $a < $count; $a++) {
                    $arr = (array)($obj->additional_value[$a]);

                    $userID = $arr["started_user_id"];

                    // use trait to map user id to a user name
                    $username = $this->getUserNames($userID);

                    $sTime = $arr["started_at"];
                    $eTime = $arr["ended_at"];
                    $sT = Carbon::parse($sTime);
                    $eT = Carbon::parse($eTime);

                    $minsWorked = $eT->diffInMinutes($sT);
                    $hoursWorked = intdiv($minsWorked, 60).':'.($minsWorked % 60);
                    $data = [
                        "boardname" =>  $boardName,
                        "taskname" => $taskName,
                        "subtaskStatus" => $taskStatus,
                        "end_time" =>  $sT->toDayDateTimeString(),
                        "start_time" =>  $eT->toDayDateTimeString(),
                        "user" => $username,
                        "task_hours_used" => $hoursWorked
                    ];

                    if ($data) {
                        Time::insert($data, true);
                    }
                }
        }


        if($res){
            $res = "- Default data was used! Enter details below for a custom data pull!";
        }else{
            $res = '';
        }

        return redirect()->back()->with('message', 'Done '.$res.'');
            }
             catch(\Exception $e){
                     return redirect()->back()->with('err_message', ''.$e->getMessage().'');
             } catch (\Throwable $e) {
            return redirect()->back()->with('err_message', '' . $e->getMessage() . '');
        }
    }

}
