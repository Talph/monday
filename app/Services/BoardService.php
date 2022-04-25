<?php

namespace App\Services;

use App\Models\Board;
use Carbon\Carbon;

class BoardService {

    public function GetBoardData($responseData): bool
    {

        $summary = '';
        $status = '';
        $time_req = '';
        $dateLogged = '';
        $priority = '';
        $owner = '';

        if(isset($responseData["data"]["boards"])) {
            # Get board name
            for ($w = 0; $w < $responseData["data"]["boards"]; $w++){
                $boardName = $responseData["data"]["boards"][$w] ? $responseData["data"]["boards"][$w]["name"] : null;
                $items = $responseData["data"]["boards"][$w] ? $responseData["data"]["boards"][$w]["items"] : null;
                if (isset($items)) {
                    # loop through the items that are in the board
                    for ($i = 0; $i < count($items); $i++) {
                        $taskName = $items ? $items[$i]["name"] : '';
                        $groupName = $items ? $items[$i]["group"]["title"] : '';
                        $c_values = $items ? $items[$i]["column_values"] : '';
                        foreach ($c_values as $value) {
                            if (isset($value)) {
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
                            "boardname" => $boardName,
                            "group" => $groupName,
                            "taskname" => $taskName,
                            "summary" => $summary,
                            "status" => $status,
                            "time_req" => $time_req,
                            "date_logged" => $dateLogged,
                            "priority" => $priority,
                            "owner" => $owner,
                            "created_at" => Carbon::now()
                        ];
                        if ($data) {
                            Board::insert($data, true);
                        }
                    }
                }
            }
        }


        return true;
    }
}
