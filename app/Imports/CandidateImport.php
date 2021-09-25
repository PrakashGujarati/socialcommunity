<?php

namespace App\Imports;

use App\Models\Candidate;
use Maatwebsite\Excel\Concerns\ToModel;

class CandidateImport implements ToModel
{
    /**
    * @param array $row
    *
    * @return \Illuminate\Database\Eloquent\Model|null
    */
    public function model(array $row)
    {
        return new Candidate([
            //
            'user_id' => 1,
            'first_name' => $row[0],
            'middle_name' => $row[1],
            'last_name' => $row[2],
            'birth_date' => $row[3],
            'birth_time' => $row[4],
            'birth_place' => $row[5],
            'height' => $row[6],
            'weight' => $row[7],
            'education' => $row[8],
            'occupation' => $row[9],
            'father_name' => $row[10],
            'mother_name' => $row[11],
            'brothers' => $row[12],
            'sisters' => $row[13],
            'father_occupation' => $row[14],
            'mother_occupation' => $row[15],
            'father_contact' => $row[16],
            'contact' => $row[17],
            'email' => $row[18],
            'resident_address' => $row[19],
            'native_address' => $row[20],
            'maternal' => $row[21],
            'maternal_place' => $row[22],
            'hobbies' => $row[23],
            'expectations' => $row[24],
            'remark' => $row[25],
            'status' => 'Inactive',
            'done_by' => 1
        ]);
    }
}
