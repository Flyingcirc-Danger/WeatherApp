<?php
/**
 * Created by PhpStorm.
 * User: Tom_Bryant
 * Date: 7/23/15
 * Time: 12:09 PM
 */

include 'refine-search.php';
include 'APICall.php';
include 'Header.php';



//If the "check weather in" button was selected
if(isset($_POST['loc'])){
    $searchJSON = json_decode(queryLatLon($_POST['loc'],$_POST['degrees']));
}



$format = $_POST["degrees"];
//figure out degree symbol representation
$degFormat = "&deg;K";
if ($format == "metric") {
    $degFormat = "&deg;C";
}
if ($format == "imperial") {
    $degFormat = "&deg;F";
}

if(isset($_POST[query])) {
    $zipPattern = '/(^\d{5}$)|(^\d{5}-\d{4}$)/';
    $zipTest = $_POST["query"];

//FIRST TEST FOR ZIP CODE
    if (preg_match($zipPattern, $zipTest) > 0) {
        //Do Zip search
        $searchJSON = json_decode(queryZip($zipTest, $format));
        //do a city search
    } else {
        $citySearch = "grep -i '" . $zipTest . "' city.list.json";
        $choices = trim(shell_exec($citySearch));

        //check to see if only one choice is
        if (strlen($choices) == 0) {
            echo '<div class="page">
           <div class ="middle">
           <p>' . $zipTest . ' not found please <a href="index.php">search again</a></p>
           </div></div></body></html>';
        } else {
            $choice_array = explode("\n", $choices);
        }
        if (count($choice_array) == 1) {
            $searchJSON = json_decode(queryCity(json_decode($choice_array[0])->_id, $format));
        } elseif (count($choice_array) > 1) {
            //Get City results (We'll search by id next)
            if (strlen($zipTest) > 0) {
                refineSearch($choice_array, $format);
            }

        }
    }
}
//if zip was successful or only one city result was successful.
if(isset($searchJSON)){


    echo '<div class="page">
           <div class ="middle">
           <center><div class ="weatherReport">
            <img src="http://openweathermap.org/img/w/' . $searchJSON->weather[0]->icon . '.png"/><p>Weather Conditions for ' . $searchJSON->name . '</p>
            <table>
            <tr><td>Longitude: </td><td>' . $searchJSON->coord->lon . '</td></tr>
            <tr><td>Latitude :</td><td>' . $searchJSON->coord->lat . '</td></tr>
            <tr><td>Current Conditions:</td><td>' . ucfirst($searchJSON->weather[0]->description) . '</td></tr>
             <tr><td>Current Temp: </td><td>' . $searchJSON->main->temp . ' ' . $degFormat . '</td></tr>
             <tr><td>Low: </td><td>' . $searchJSON->main->temp_min . ' ' . $degFormat . '</td></tr>
             <tr><td>High: </td><td>' . $searchJSON->main->temp_max . ' ' . $degFormat . '</td></tr>
            </table>
            </div>
            </center>
            <center><div id="gMap">
            <img src="https://maps.googleapis.com/maps/api/staticmap?center=' . $searchJSON->coord->lat . ',' . $searchJSON->coord->lon . '&zoom=11&size=400x300&markers=icon:http://openweathermap.org/img/w/' . $searchJSON->weather[0]->icon . '.png|' . $searchJSON->coord->lat . ',' . $searchJSON->coord->lon . '"/>
            </div>
            </div>
            </div></body></html>';

}









