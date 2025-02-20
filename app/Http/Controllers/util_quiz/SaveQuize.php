<?php

namespace App\Http\Controllers\util_quiz;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

/**
 * /util_quiz/saveQuize?user_refid=&user_name=&quiz_json=&total=&score=
 */

class SaveQuize extends Controller
{
    public static function save(Request $request) {
        $quiz_refid = \App\Http\Controllers\util_generator\ReferenceID::create("SQZ");
        return DB::connection('npm_lms')->table('users_student_quiz')->insert([
            "quiz_refid"    => $quiz_refid,
            "user_refid"    => $request['user_refid'],
            "user_name"     => $request['user_name'],
            "quiz_json"     => $request['quiz_json'],
            "total"         => $request['total'],
            "score"         => $request['score']
        ]);
    }
}
