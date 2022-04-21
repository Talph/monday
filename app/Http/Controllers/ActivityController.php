<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class ActivityController extends Controller
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
              boards(ids: 237326906) {
                name
                  activity_logs (from: "2021-07-23T00:00:00Z", to: "2022-02-26T00:00:00Z") {
                  id
                  event
                  data
                  entity
                  user_id
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

            $res = $response['data']['boards'][0]['activity_logs'];
            $cd = [];
                $d = (array)($res);
            for($i = 0; $i < count($res);$i++)
            {
                $items = $res[$i]['data'];

                $itemArr = json_decode($items);
                $d = (array) $itemArr;


                dd($d);


            }

            print_r($cd);

            // dd($response);
        }catch(\Exception $e){
            return redirect()->back()->with('err_message', $e->getMessage());
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
