<?php

namespace App\Http\Controllers\util_quiz;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

/**
 * util_quiz/resetReading?user_refid=STD-02132025112925-RXF&group_code=SORTING
 */

class ResetReading extends Controller
{
    public static function reset(Request $request) {
        $groups     = DB::connection('npm_lms')->table('article_topic')->where('group_code', $request['group_code'])->get();
        $deleted    = [];
        foreach($groups as $group) {
            $deleted[]    = DB::connection('npm_lms')->table('article_reads')
            ->where([
                ['topic_refid', $group->topic_refid],
                ['user_refid', $request['user_refid']]
            ])
            ->delete();
        }
        return [
            "success"   => true,
            "message"   => "Delete",
            "list"      => $deleted
        ];
    }
}
