<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Tags;

class TagsController extends Controller
{
    /**
     * success response method.
     *
     * @return \Illuminate\Http\Response
     */
    public function listTags(Request $request)
    {
        $tags = Tags::query()->distinct()->pluck('tag');
        return response()->json($tags) ;
    }
}
