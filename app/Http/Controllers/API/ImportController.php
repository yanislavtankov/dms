<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Imports\CompaniesImport;
use Maatwebsite\Excel\Facades\Excel;
use Illuminate\Support\Facades\File;

class ImportController extends Controller
{
    public function importCsv(Request $request)
    {
        // $request->validate([
        //     'file' => 'required|mimes:xls,xlsx,text/plain'
        // ]);

        if($request->file('file')->getMimeType() == 'text/plain' && $request->file('file')){
            $path = $request->file('file');
            $data = Excel::import(new CompaniesImport, $path);
            return response()->json(['success' => $data], 200);
        } else {
            return response()->json(['error' => 'The file is missing or file type mishmash'], 201);
        }
    }
}
