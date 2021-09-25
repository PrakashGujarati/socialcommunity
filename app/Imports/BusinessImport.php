<?php

namespace App\Imports;

use App\Models\Business;
use Maatwebsite\Excel\Concerns\ToModel;

class BusinessImport implements ToModel
{
    /**
    * @param array $row
    *
    * @return \Illuminate\Database\Eloquent\Model|null
    */
    public function model(array $row)
    {
        return new Business([
            //
            'user_id' => 1,
            'first_name' => $row[0],
            'middle_name' => $row[1],
            'last_name' => $row[2],
            'company' => $row[3],
            'category' => $row[4],
            'description' => $row[5],
            'contact' => $row[6],
            'email' =>$row[7],
            'address' => $row[8],
            'status' => 'Inactive',
            'done_by' => 1
        ]);
    }
}
