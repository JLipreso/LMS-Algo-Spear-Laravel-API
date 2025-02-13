<?php

namespace App\Http\Controllers\util_validator;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

/**
 * \App\Http\Controllers\util_validator\Email::isValid($email);
 */

class Email extends Controller
{
    public static function isValid($email) {
        if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
            return false;
        }
        else {
            return true;
        }
    }
}
