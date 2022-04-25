<?php

namespace App\Http\Controllers;

use App\Services\BoardService;
use Exception;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use App\Models\Board;
use Maatwebsite\Excel\Facades\Excel;
use App\Exports\BoardExport;

class BoardController extends Controller
{
    /**
     * Store a newly created resource in storage.
     *
     * @param Request $request
     * @return RedirectResponse
     */
    public function store(BoardService $service): RedirectResponse
    {
        try {
            #SET THE MONDAY API URL AND TOKEN IN THE ENV FILE
        $url = env('MONDAY_API_URL');
        $token = env('MONDAY_API_TOKEN');
        $query = 'query { boards(ids: [244318841, 578790760]) { name items(limit: 2000) { name state column_values (ids: [text2, status, person, date0, numbers, status_11]) { id text type title } group { title }
                        creator { name }}}}';
        $headers = [
            'Content-Type: application/json',
            'Authorization: ' . $token
        ];

            $data = @file_get_contents($url, false, stream_context_create([
                'http' => [
                    'method' => 'POST',
                    'header' => $headers,
                    'content' => json_encode(['query' => $query]),
                ]
            ]));

            #json decode response
            $responseData = json_decode($data, true);

            #Trancate board if there is data
            Board::exists() ? Board::truncate() : '';

            $service->GetBoardData($responseData);

        } catch (Exception $e) {
            return redirect()->back()->with('err_message', $e->getMessage());
        }

        return redirect()->back()->with('message', 'Successful');
    }

    public function export()
    {
        return Excel::download(new BoardExport, 'epicerp_tasks_timings.xlsx');
    }
}
