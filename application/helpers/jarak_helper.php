<?php
ob_start();
defined('BASEPATH') or exit('No direct script access allowed');
if (!function_exists('hitung_jarak')) {
    function hitung_jarak($lat1, $lon1, $lat2, $lon2) {
        $theta = $lon1 - $lon2;
        $miles = (sin(deg2rad($lat1)) * sin(deg2rad($lat2))) + (cos(deg2rad($lat1)) * cos(deg2rad($lat2)) * cos(deg2rad($theta)));
        $miles = acos($miles);
        $miles = rad2deg($miles);
        $miles = $miles * 60 * 1.1515;
        $feet  = $miles * 5280;
        $yards = $feet / 3;
        $kilometers = number_format($miles * 1.609344,2);
        $meters = $kilometers * 1000;
        return compact('miles','feet','yards','kilometers','meters'); 
    }
}
?>