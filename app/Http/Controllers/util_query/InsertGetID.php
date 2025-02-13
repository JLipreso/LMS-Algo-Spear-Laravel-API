<?php

namespace App\Http\Controllers\util_query;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class InsertGetID extends Controller
{
    public static function insertGetID(Request $request) {
        $dataid     = DB::connection($request['connection'])
                    ->table($request["table"])
                    ->insertGetId($request['columns']); 

        if($dataid) {
            return [
                "success"   => true,
                "message"   => "Inserted successfully.",
                 "dataid"    => $dataid
            ];
        }
        else {
            return [
                "success"   => false,
                "message"   => "Insertion not successful.",
                "dataid"    => null
            ];
        }

      }
}
