<?php

namespace App\Imports;

use App\Models\Late;
use Maatwebsite\Excel\Concerns\ToModel;

class LateImport implements ToModel
{
    /**
    * @param array $row
    *
    * @return \Illuminate\Database\Eloquent\Model|null
    */
    public function model(array $row)
    {
        return new Late([
            //
            'first_name' => $row[0],
            'middle_name' => $row[1],
            'last_name' => $row[2],
            'late_date' => $row[3],
            'birth_date' => $row[4],
            'gujarati_savant' => $row[5],
            'address' => $row[6],
            'shradhhanjali' => $row[7],
            'notifications' => $row[8],
            'contact' => $row[9],
            'status' => 'Inactive',
            'done_by' => 1
        ]);
    }
}
