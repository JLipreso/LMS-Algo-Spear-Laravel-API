<?php

namespace App\Http\Controllers\util_query;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

/**
 * util_query/fetchAll
 */

class FetchAll extends Controller
{
    public static function fetchAll(Request $request) {
        $orderby = json_decode($request['orderby']);
        return DB::connection($request['connection'])->table($request['table'])
                ->where(json_decode($request['where']))
                ->orderBy($orderby[0], $orderby[1])
                ->get();
    }
}
