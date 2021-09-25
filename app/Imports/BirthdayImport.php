<?php

namespace App\Imports;

use App\Models\Birthday;
use Maatwebsite\Excel\Concerns\ToModel;

class BirthdayImport implements ToModel
{
    /**
    * @param array $row
    *
    * @return \Illuminate\Database\Eloquent\Model|null
    */
    public function model(array $row)
    {
        return new Birthday([
            //
            'name' => $row[0],
            'birthdate' => $row[1],
            'time' => $row[2],
            'place' => $row[3],
            'wishes' => $row[4],
            'status' => 'Inactive'
        ]);
    }
}