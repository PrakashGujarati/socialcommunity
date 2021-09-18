<?php

namespace App\Imports;

use App\Models\Employee;
use Maatwebsite\Excel\Concerns\ToModel;

class EmployeeImport implements ToModel
{
    /**
    * @param array $row
    *
    * @return \Illuminate\Database\Eloquent\Model|null
    */
    public function model(array $row)
    {
        return new Employee([
            //
            'user_id' => 1,
            'first_name' => $row[0],
            'middle_name' => $row[1],
            'last_name' => $row[2],
            'office' => $row[3],
            'category' => $row[4],
            'designation' => $row[5],
            'contact' => $row[6],
            'email' => $row[7],
            'address' => $row[8],
            'status' => 'Inactive',
            'done_by' => 1
        ]);
    }
}
