<?php

namespace App\Http\Controllers\util_parser;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

/**
 * \App\Http\Controllers\util_parser\ServiceType::parse($key);
 */

class ServiceType extends Controller
{
    public static function parse($key) {
        if($key == 'PBL') {
            return [
                "key"   => $key,
                "value" => "Pabili"
            ];
        }
        else if($key == 'FDL') {
            return [
                "key"   => $key,
                "value" => "Food"
            ];
        }
        else if($key == 'GRC') {
            return [
                "key"   => $key,
                "value" => "Grocery"
            ];
        }
        else if($key == 'OCL') {
            return [
                "key"   => $key,
                "value" => "On-call"
            ];
        }
        else if($key == 'RNT') {
            return [
                "key"   => $key,
                "value" => "Rents"
            ];
        }
        else if($key == 'RDS') {
            return [
                "key"   => $key,
                "value" => "Rides"
            ];
        }
        else if($key == 'SPU') {
            return [
                "key"   => $key,
                "value" => "Sent & Pick-up"
            ];
        }
        else {
            return [
                "key"   => $key,
                "value" => "Unknown"
            ];
        }
    }
}
