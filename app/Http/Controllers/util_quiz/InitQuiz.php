<?php

namespace App\Http\Controllers\util_quiz;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

/**
 * util_quiz/fetchRandomExam?user_refid=STD-02132025112925-RXF&limit=5&group_refid=QGR-02162025051009-MJF
 */

class InitQuiz extends Controller
{
    public static function quize(Request $request) {

        $categories = InitQuiz::fetchCategories();
        $list       = [];

        foreach($categories as $category) {
            
            $passed         = false;
            $passed_label   = "";
            $completed      = false;
            $quize          = DB::connection('npm_lms')->table('questionnaire_category_quiz')
                            ->where([
                                ['user_refid', $request['user_refid']],
                                ['category_refid', $category->group_refid]
                            ])
                            ->get();
            if(count($quize) > 0) {
                $completed  = true;
                if($quize[0]->passed == 1) {
                    $passed         = true;
                    $passed_label   = "Passed";
                }
                else if($quize[0]->passed == 0) {
                    $passed         = false;
                    $passed_label   = "Fail";
                }
            }
            else {
                $passed         = false;
                $passed_label   = "Pending";
            }

            $list[] = [
                "header"            => $category,
                "score"             => 0,
                "completed"         => $completed,
                "passed"            => $passed,
                "passed_label"      => $passed_label
            ];
        }
        return $list;
    }

    public static function isQuizePassed($user_refid, $category_refid) {
        $passed = DB::connection('npm_lms')->table('questionnaire_category_quiz')->where([
            ['user_refid', $user_refid],
            ['category_refid', $category_refid]
        ])
        ->get();

        if($passed > 0) {
            return true;
        }
        else {
            return false;
        }
    }

    public static function excercises(Request $request) {

        $categories = InitQuiz::fetchCategories();
        $list       = [];

        foreach($categories as $category) {
            
            $attempt        = InitQuiz::countAttempt($request['user_refid'], $category->group_refid);
            $passed         = InitQuiz::isPassed($request['user_refid'], $category->group_refid);
            $completed      = false;

            if($passed) {
                $completed  = true;
            }

            $list[] = [
                "header"    => $category,
                "score"     => 0,
                "completed" => $completed,
                "locked"    => false,
                "attempt"   => $attempt,
                "passed"    => $passed
            ];
        }
        return $list;
    }

    public static function isPassed($user_refid, $category_refid) {
        $passed = DB::connection('npm_lms')->table('questionnaire_category_done')->where([
            ['user_refid', $user_refid],
            ['category_refid', $category_refid],
            ['passed', 1]
        ])
        ->count();

        if($passed > 0) {
            return true;
        }
        else {
            return false;
        }
    }

    public static function countAttempt($user_refid, $category_refid) {
        return DB::connection('npm_lms')->table('questionnaire_category_done')->where([
            ['user_refid', $user_refid],
            ['category_refid', $category_refid]
        ])
        ->count();
    }

    public static function fetchRandomExam(Request $request) {
        return InitQuiz::fetchQuestions($request['group_refid'], $request['limit']);
    }

    public static function fetch(Request $request) {
        if(InitQuiz::isHasHistory($request)) {
            return $request;
        }
        else {
            $categories = InitQuiz::fetchCategories();
            $list       = [];
            foreach($categories as $category) {
                $questions      = InitQuiz::fetchQuestions($category->group_refid, $request['limit']);
                $list[] = [
                    "header"    => $category,
                    "questions" => $questions,
                    "score"     => 0,
                    "completed" => false
                ];
            }
            return $list;
        }
    }

    public static function fetchQuestions($category_refid, $limit) {
        return DB::connection('npm_lms')
            ->table('questionnaire')
            ->where('category_refid', $category_refid)
            ->inRandomOrder()
            ->limit($limit)
            ->get();
    }

    public static function fetchCategories() {
        return DB::connection('npm_lms')->table('questionnaire_category')->select('group_refid','name')->orderBy('sort', 'asc')->get();
    }

    public static function isHasHistory($request) {
        return false;
    }
}
