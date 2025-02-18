<?php

namespace App\Http\Controllers\util_query;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

/**
 * 
 */

class FetchRandomRow extends Controller
{
    public static function fetch(Request $request) {
        return DB::connection($request['connection'])
            ->table($request['table'])
            ->where(json_decode($request['where']))
            ->inRandomOrder()
            ->limit($request['limit'])
            ->get();
    }
}
