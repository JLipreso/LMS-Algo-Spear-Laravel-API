<?php

namespace App\Http\Controllers\util_generator;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

/**
 * \App\Http\Controllers\util_generator\Token::create();
 */

class Token extends Controller
{
    public static function create() {
        return substr(str_shuffle("1234567890abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ"), 0, 32);
    }
}
