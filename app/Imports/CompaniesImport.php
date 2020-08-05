<?php

namespace App\Imports;

use App\Companies;
use Illuminate\Support\Facades\Auth;
use Maatwebsite\Excel\Concerns\ToModel;

class CompaniesImport implements ToModel
{
    /**
    * @param array $row
    *
    * @return \Illuminate\Database\Eloquent\Model|null
    */
    public function model(array $row)
    {
        if(is_array($row) && isset($row[1])){
            return new Companies([
                'user_id' => Auth::user()->id,
                'name'  => $row[0],
                'desc' => $row[1],
            ]);
        }
    }
}
