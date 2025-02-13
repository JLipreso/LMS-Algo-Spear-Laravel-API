<?php

namespace App\Http\Controllers\util_query;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

/**
 * 
 */

class Delete extends Controller
{
    public static function delete(Request $request) {
        $deleted = DB::connection($request['connection'])->table($request["table"])->where(json_decode($request['where']))->delete();
        if($deleted) {
            return [
                "success"   => true,
                "message"   => "Deleted successfully"
            ];
        }
        else {
            return [
                "success"   => false,
                "message"   => "Fail to deleted"
            ];
        }
    }
}
