<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\File;
use App\Documents;

require_once base_path().'/vendor/autoload.php';
use Dompdf\Dompdf;

class FileController extends Controller
{
    /**
     * success response method.
     *
     * @return \Illuminate\Http\Response
     */
    public function listFiles ( $id ){
        $superUser = ( Auth::user()->type ) ? " WHERE user_id > 0" : " WHERE user_id = " . Auth::user()->id;
        $companiesSQL = ($id == 0 ) ? '' : ' AND documents.company_id = ' . $id;
        $files = DB::select('
            SELECT documents.id as id, companies.id as cid, companies.name as name, title, description, path FROM documents JOIN companies on companies.id = documents.company_id WHERE companies.id IN (SELECT id FROM companies '. $superUser .')'. $companiesSQL);

        return response()->json([
            'files' => $files
        ], 200);

    }

    public function addFile ( Request $request ) {
        if($request->hasFile('files') && request('user') == Auth::user()->id)
        {
            $fileNum = 0;
            $files = $request->file('files');
            foreach ($files as $file) {
                $fileName = time().'_'.$file->getClientOriginalName();
                $file->move(public_path('upload'), $fileName);

                $FilePathDoc = public_path()."/upload/". $fileName;
                $FilePathPdf = public_path()."/upload/". $fileName . '.pdf';

                \PhpOffice\PhpWord\Settings::setPdfRendererPath(base_path() .'/vendor/dompdf/dompdf');
                \PhpOffice\PhpWord\Settings::setPdfRendererName( 'DomPDF' );
                $phpWord = \PhpOffice\PhpWord\IOFactory::load( $FilePathDoc );
                $pdfWriter = \PhpOffice\PhpWord\IOFactory::createWriter( $phpWord, 'PDF' );
                $pdfWriter->save($FilePathPdf);

                $this->validate($request, [
                    'company' => 'required',
                    'title' => 'required',
                    'description' => 'required',
                ]);
                $fileIndex = ($fileNum == 0) ? '' : '(' . $fileNum . ')';
                $document[] = Documents::create([
                    'company_id' => request('company'),
                    'title' => request('title') . $fileIndex,
                    // 'title' => request('title') . ' (' . $fileName . ')',
                    'description' => request('description'),
                    'path' => $fileName.'.pdf'
                ]);
                $fileNum++;
            }

            return response()->json([
                'files' => $document
            ], 200);
        }

        return response()->json([
            'error' => 'Error saving'
        ], 501);
    }

    public function getFile ( $id ) {
        $fileName = DB::select('SELECT path FROM documents WHERE id =' . $id);
        $file = '\upload\\' . $fileName[0]->path;

        return response()->json([
            'id' => $id,
            'fileName' => $file
        ], 200);
    }

    public function deleteFile ( $id ) {
        $fileName = DB::select('SELECT path FROM documents WHERE id =' . $id);
        File::delete( public_path() . '/upload/' . $fileName[0]->path,  public_path() . '/upload/' . str_replace('.pdf', '', $fileName[0]->path) );
        DB::table('documents')->where('id', $id)->delete();
    }

}
