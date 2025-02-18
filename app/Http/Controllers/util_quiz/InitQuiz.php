<?php

namespace App\Http\Controllers\util_quiz;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

/**
 * 
 */

class InitQuiz extends Controller
{
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
