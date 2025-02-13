<?php

namespace App\Http\Controllers\util_calculator;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

/**
 * \App\Http\Controllers\util_calculator\DistanceMatrix::distanceOnly($origins, $destinations, $key)
 */

class DistanceMatrix extends Controller
{
    public static function distance(Request $request) {

        $origins        = $request['origins'];
        $destinations   = $request['destinations'];
        $key            = $request['key'];

        $url            = "https://maps.googleapis.com/maps/api/distancematrix/json?origins=" . $origins . "&destinations=" . $destinations . "&key=" . $key;
        $data           = json_decode(file_get_contents($url), true);

        if($data['status'] == 'OK') {
            return [
                "success"   => true,
                "matrix"    => [
                    "destination_addresses"     => $data['destination_addresses'][0],
                    "origin_addresses"          => $data['origin_addresses'][0],
                    "distance_text"             => $data['rows'][0]['elements'][0]['distance']['text'],
                    "distance_value_meter"      => $data['rows'][0]['elements'][0]['distance']['value'],
                    "distance_value_km"         => round((floatval($data['rows'][0]['elements'][0]['distance']['value']) / 1000), 1),
                    "duration_text"             => $data['rows'][0]['elements'][0]['duration']['text'],
                    "duration_value"            => $data['rows'][0]['elements'][0]['duration']['value']
                ]
            ];
        }
        else {
            return [
                "success"   => false,
                "matrix"    => []
            ];
        }
    }

    public static function distanceOnly($origins, $destinations, $key) {

        $url            = "https://maps.googleapis.com/maps/api/distancematrix/json?origins=" . $origins . "&destinations=" . $destinations . "&key=" . $key;
        $data           = json_decode(file_get_contents($url), true);

        if($data['status'] == 'OK') {
            return [
                "distance_text"             => $data['rows'][0]['elements'][0]['distance']['text'],
                "distance_value_meter"      => $data['rows'][0]['elements'][0]['distance']['value'],
                "distance_value_km"         => round((floatval($data['rows'][0]['elements'][0]['distance']['value']) / 1000), 1),
                "duration_text"             => $data['rows'][0]['elements'][0]['duration']['text'],
                "duration_value"            => $data['rows'][0]['elements'][0]['duration']['value']
            ];
        }
        else {
            return [];
        }
    }
}
