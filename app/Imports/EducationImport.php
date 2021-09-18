<?php

namespace App\Imports;

use App\Models\Education;
use Maatwebsite\Excel\Concerns\ToModel;

class EducationImport implements ToModel
{
    /**
    * @param array $row
    *
    * @return \Illuminate\Database\Eloquent\Model|null
    */
    public function model(array $row)
    {
        return new Education([
            //
        'name' => $row[0],
        'qualification' => $row[1],
        'note' => $row[2],
        'gender' => $row[3],
        'status' => 'Inactive'
        ]);
    }
}
