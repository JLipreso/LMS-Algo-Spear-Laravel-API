<?php

namespace App\Http\Controllers\util_query;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

/**
 * 
 */

class Update extends Controller
{
    public static function update(Request $request) {
        
        $editColumn         = $request['columns'];
        $counts             = count($editColumn);
        $valuePerQuery      = 1 / $counts;
        $score              = 0;
        
        for($i = 0; $i < $counts; $i++) {
            $updated = DB::connection($request['connection'])->table($request["table"])->where(json_decode($request["where"]))->update($editColumn[$i]);
            if($updated) {
                $score = $score + $valuePerQuery;
            }
        }

        if($score > 0) {
            return [
                "success" => true,
                "score"   => $score,
            ];
        }
        else {
            return [
                "success" => false,
                "score"   => $score
          ];
        }
    }
}
