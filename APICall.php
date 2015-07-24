<?php
/**
 * Created by PhpStorm.
 * User: Tom_Bryant
 * Date: 7/23/15
 * Time: 3:51 PM
 */

include 'API.php';



/**
 * Queries the Open weather map API for a current weather at the provided zip
 * @param $zip the zip code requested
 * @param $units the degree format requested
 * @return string JSON string weather data
 */
function queryZip($zip,$units){
    if($units == "kelvin"){
        return file_get_contents("http://api.openweathermap.org/data/2.5/weather?zip=" . $zip . ",us&APPID={". getKey() . "}");
    } else{
        return file_get_contents("http://api.openweathermap.org/data/2.5/weather?zip=" . $zip . ",us&units=".$units ."&APPID={". getKey() . "}");
    }
}

/**
 * Queries the Open weather map API for a current weather at the provided cityID
 * @param $cityNo the cityID requested
 * @param $units the degree format requested
 * @return string JSON string weather data
 */
function queryCity($cityNo,$units){
    if($units == "kelvin"){
        return file_get_contents("http://api.openweathermap.org/data/2.5/weather?id=" . $cityNo . "&APPID={". getKey() . "}");
    } else {
        return file_get_contents("http://api.openweathermap.org/data/2.5/weather?id=" . $cityNo .  "&units=".$units . "&APPID={". getKey() . "}");
    }
}

/**
 * Queries the Open weather map API for a current weather at the provided lat and lon
 * @param $latLon the lat lon requested
 * @param $units the degree format requested
 * @return string JSON string weather data
 */
function queryLatLon($latLon,$units){
    $data = explode(",", $latLon);
    return file_get_contents("http://api.openweathermap.org/data/2.5/weather?lat=" . $data[0] . "&lon=" . $data[1] . "&units=".$units . "&APPID={". getKey() . "}");

}
