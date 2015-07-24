<?php
/**
 * Created by PhpStorm.
 * User: Tom_Bryant
 * Date: 7/23/15
 * Time: 5:31 PM
 */

include 'APICall.php';
include 'Header.php';
$format = $_POST['degrees'];
$cityJSON = json_decode(queryCity($_POST['choice'],$format));
$degFormat = "&deg;K";
if($format == "metric"){
    $degFormat = "&deg;C";
}
if($format == "imperial"){
    $degFormat = "&deg;F";
}
echo '<script>
           function initialize() {}
       </script>
        <div class="page">
           <div class ="middle">
           <center><div class ="weatherReport">
            <img src="http://openweathermap.org/img/w/' . $cityJSON->weather[0]->icon . '.png"/><p>Weather Conditions for ' . $cityJSON->name . '</p>
            <table>
            <tr><td>Longitude: </td><td>' . $cityJSON->coord->lon.'</td></tr>
            <tr><td>Latitude :</td><td>' . $cityJSON->coord->lat.'</td></tr>
            <tr><td>Current Conditions:</td><td>' . ucfirst($cityJSON->weather[0]->description) . '</td></tr>
             <tr><td>Current Temp: </td><td>' . $cityJSON->main->temp . ' ' . $degFormat . '</td></tr>
             <tr><td>Low: </td><td>' . $cityJSON->main->temp_min . ' ' . $degFormat . '</td></tr>
             <tr><td>High: </td><td>' . $cityJSON->main->temp_max . ' ' . $degFormat . '</td></tr>
            </table>
            </div>
            </center>
            <center><div id="gMap">
            <img src="https://maps.googleapis.com/maps/api/staticmap?center=' .$cityJSON->coord->lat .',' .$cityJSON->coord->lon. '&zoom=11&size=400x300&markers=icon:http://openweathermap.org/img/w/' . $cityJSON->weather[0]->icon . '.png|' .$cityJSON->coord->lat . ','  .$cityJSON->coord->lon . '"/>
            </div>
            </center>
            </div>
            </div></body></html>';