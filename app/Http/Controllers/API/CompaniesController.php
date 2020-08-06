<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use App\Companies;
use App\Tags;

class CompaniesController extends Controller
{
    /**
     * success response method.
     *
     * @return \Illuminate\Http\Response
     */
    public function listCompanies (Request $request)
    {
        $superUser = ( Auth::user()->type ) ? " WHERE c.user_id > 0" : " WHERE ( c.user_id = " . Auth::user()->id . ")";
        $tagRequested = (request('tag')) ? " AND c.id IN (SELECT company_id FROM tags WHERE tag = '". request('tag') ."')" : "";
        $unique = ( env("DB_CONNECTION") == 'pgsql' ) ? 'array_agg' : 'group_concat';

        $companies = DB::select('
            SELECT c.id, c.name, c.desc,
                (SELECT '.$unique.'(t.tag)
                    FROM tags as t
                WHERE c.id = t.company_id)
            AS tags
            FROM companies AS c'
            . $superUser
            . $tagRequested . '
            ORDER BY c.id
        ');

        return response()->json([
            'companies' => $companies
            ], 200);
    }

    public function addCompany (Request $request)
    {
        $this->validate($request, [
            'name'        => 'required',
            'description' => 'required',
        ]);

        $company = Companies::create([
            'name' => request('name'),
            'desc' => request('description'),
            'user_id' => Auth::user()->id
        ]);


        if(request('tags')){
            DB::table('tags')->insert(
                $this->normalizeTags ( $company->id, request('tags') )
            );
        }

        return response()->json([
            'company'    => $company
        ], 200);

    }

    public function editCompany (Request $request, $id)
    {
        $this->validate($request, [
            'name'        => 'required',
            'description' => 'required',
        ]);

        DB::table('tags')->where('company_id', $id)->delete();

        $company = DB::table('companies')
            ->where('id', $id)
            ->where('user_id', Auth::user()->id)
            ->update(['name' => request('name'), 'desc' => request('description')]);

        if(request('tags')){
            DB::table('tags')->insert(
               $this->normalizeTags ( $id, request('tags') )
            );
        }

        return response()->json([
            'company'    => $company
        ], 200);

    }

    public function deleteCompany ( $id ) {
        DB::table('tags')->where('company_id', $id)->delete();
        DB::table('companies')->where('id', $id)->delete();
    }

    private function normalizeTags ( $company, $tags ) {
            $tagsArr = explode(',', $tags);
            foreach ($tagsArr as $key => $value) {
                $normalizedTags[] = ['company_id' => $company, 'tag' => $value];
            }
            return $normalizedTags;
    }
}
