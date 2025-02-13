<?php

namespace App\Http\Controllers\util_query;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

/**
 * \App\Http\Controllers\util_query\FetchSingle::querySingle($connection, $table, $where);
 */

class FetchSingle extends Controller
{
    public static function fetchSingle(Request $request) {
        $orderby = json_decode($request['orderby']);
        return DB::connection($request['connection'])->table($request['table'])
                ->where(json_decode($request['where']))
                ->get();
    }

    public static function querySingle($connection, $table, $where) {
        return DB::connection($connection)
            ->table($table)
            ->where($where)
            ->get();
    }


}
