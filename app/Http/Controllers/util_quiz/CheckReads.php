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

    public static function visualViewsChecker(Request $request) {
        return [
            "ARRAY"            => CheckReads::visualByCode($request['user_refid'], 'ARRAY'),
            "LINKED_LIST"      => CheckReads::visualByCode($request['user_refid'], 'LINKED_LIST'),
            "GRAPHS"           => CheckReads::visualByCode($request['user_refid'], 'GRAPHS'),
            "STACKS"           => CheckReads::visualByCode($request['user_refid'], 'STACKS'),
            "QUEUES"           => CheckReads::visualByCode($request['user_refid'], 'QUEUES'),
            "SORTING"          => CheckReads::visualByCode($request['user_refid'], 'SORTING'),
            "SEARCH"           => CheckReads::visualByCode($request['user_refid'], 'SEARCH')
        ];
    }

    public static function visualByCode($user_refid, $group_code) {
        $views = DB::connection('npm_lms')->table('visual_views')
        ->where([
            ['user_refid', $user_refid],
            ['group_code', $group_code]
        ])
        ->count();

        if($views > 0) {
            return true;
        }
        else {
            return false;
        }
    }
}
