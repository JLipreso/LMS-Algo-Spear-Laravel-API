<?php

namespace App\Http\Controllers\util_quiz;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

/**
 * 
 */

class VideoTutorials extends Controller
{
    public static function fetch() {
        $categories = DB::connection('npm_lms')->table('video_group')->select('video_group_refid', 'name', 'description')->orderBy('sort', 'asc')->get();
        $list       = [];
        foreach($categories as $category) {
            $videos         = DB::connection('npm_lms')->table('video_tutorial')->where('video_group_refid', $category->video_group_refid)->orderBy('title','asc')->get();
            $list[]  = [
                "header"    => $category,
                "videos"    => $videos
            ];
        }
        return $list;
    }
}
