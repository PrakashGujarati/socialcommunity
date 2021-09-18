<?php

namespace App\Imports;

use App\Models\Contact;
use Maatwebsite\Excel\Concerns\ToModel;

class ContactImport implements ToModel
{
    /**
    * @param array $row
    *
    * @return \Illuminate\Database\Eloquent\Model|null
    */
    public function model(array $row)
    {
        return new Contact([
            //
            'name' => $row[0],
            'designation' => $row[1],
            'mobile' => $row[2],
            'email' => $row[3],
            'status' => 'Inactive'
        ]);
    }
}
