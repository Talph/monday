<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Carbon\Carbon;
use App\Models\Board;
use Maatwebsite\Excel\Facades\Excel;
use App\Exports\TimeExport;
use PhpParser\Node\Stmt\Continue_;

class BoardController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $url = env('MONDAY_API_URL');
        $token = env('MONDAY_API_TOKEN');
        $query = 'query {
                    boards(ids: [244318841, 578790760]) {
                        name
                        items(limit: 2000) {
                        name
                        state
                        column_values (ids: [text2, status, person, date0, numbers, status_11]) {
                            id
                            text
                            type
                            title
                        }
                        group {
                            title
                        }
                        creator {
                            name
                        }
                        }
                    }
                    }';


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

            // dd($response);
            if (Board::exists()) {
                Board::truncate();
            }
            # Get board name
            for ($w = 0; $w < $response["data"]["boards"]; $w++){
                $boardName = $response["data"]["boards"][$w]["name"];
                $items = $response["data"]["boards"][$w]["items"];
                # loop through the items that are in the board
                for ($i = 0; $i < count($items); $i++) {


                    $taskName = $items[$i]["name"];
                    $groupName = $items[$i]["group"]["title"];
                    $c_values = $items[$i]["column_values"];
                    foreach($c_values as $key => $value){
                        if(isset($value)){
                            if ($value["id"] == "text2") {
                                $summary = $value["text"];
                            }
                            if ($value["id"] == 'person') {
                                $owner = $value["text"];
                            }
                            if ($value["id"] == "status") {
                                $status = $value["text"];
                            }
                            if ($value["id"] == "status_11") {
                                $priority = $value["text"];
                            }
                            if ($value["id"] == "numbers") {
                                $time_req = $value["text"];
                            }
                            if ($value["id"] == "date0") {
                                $d = Carbon::parse($value["text"]);
                                $dateLogged = $d;
                            }
                        }

                    }
                                        
                    $data = [
                        "boardname" =>  $boardName,
                        "group" => $groupName,
                        "taskname" => $taskName,
                        "summary" => $summary,
                        "status" => $status,
                        "time_req" => $time_req,
                        "date_logged" => $dateLogged,
                        "priority" => $priority,
                        "owner" => $owner,
                        "created_at" => \Carbon\Carbon::now()
                    ];

                        if ($data) {
                            Board::insert($data, true);
                        }
                    }
                }
           
        } catch (\Exception $e) {
            return redirect()->back()->with('err_message', '' . $e->getMessage() . '');
        } catch (\Throwable $e) {
            return redirect()->back()->with('err_message', '' . $e->getMessage() . '');
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
