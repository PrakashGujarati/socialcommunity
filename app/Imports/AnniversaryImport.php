<?php

namespace App\Imports;

use App\Models\Anniversary;
use Maatwebsite\Excel\Concerns\ToModel;

class AnniversaryImport implements ToModel
{
    /**
    * @param array $row
    *
    * @return \Illuminate\Database\Eloquent\Model|null
    */
    public function model(array $row)
    {
        return new Anniversary([
            //
            'name' => $row[0],
            'marriagedate' => $row[1],
            'time' => $row[2],
            'place' => $row[3],
            'wishes' => $row[4],
            'status' => 'Inactive'
        ]);
    }
}
