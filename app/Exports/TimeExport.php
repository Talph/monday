<?php

namespace App\Exports;

use App\Models\Board;
use Maatwebsite\Excel\Concerns\FromCollection;

class TimeExport implements FromCollection
{
    /**
    * @return \Illuminate\Support\Collection
    */
    public function collection()
    {
        return Board::get();
    }

}