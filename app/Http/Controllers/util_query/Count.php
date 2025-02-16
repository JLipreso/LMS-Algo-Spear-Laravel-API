<?php

namespace App\Http\Controllers\util_query;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class Count extends Controller
{
    public static function count(Request $request) {
        return DB::connection($request['connection'])->table($request['table'])
                ->where(json_decode($request['where']))
                ->count();
    }
}
