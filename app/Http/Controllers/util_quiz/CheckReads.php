<?php

namespace App\Http\Controllers\util_quiz;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

/**
 * 
 */

class CheckReads extends Controller
{
    public static function check(Request $request) {
        $groups = DB::connection('npm_lms')->table('article_topic')->where('group_code', $request['group_code'])->get();
        if(count($groups) == 0) {
            return [
                "success"   => false,
                "message"   => "Article group has no content yet."
            ];
        }
        else {
            foreach($groups as $group) {
                $reading = DB::connection('npm_lms')->table('article_reads')->where([
                    ["topic_refid", $group->topic_refid],
                    ['user_refid', $request["user_refid"]]
                ])
                ->count();
                if($reading == 0) {
                    return [
                        "success" => false,
                        "message" => "<p>Please read <span class='text-danger'>" . $group->name . "</span> first.</p>"
                    ];
                }
            }
            return [
                "success"   => true,
                "message"   => "<p>Done</p>"
            ];
        }
    }
}
