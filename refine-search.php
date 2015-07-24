<?php
/**
 * Created by PhpStorm.
 * User: Tom_Bryant
 * Date: 7/23/15
 * Time: 2:06 PM
 */

/**
 * Given an array of cities, builds
 * the form for refining a search
 * @param $choice_array the array of cities
 * @param $format the format to display search results in.
 */
function refineSearch($choice_array, $format)
{

    echo '
<div class="page">
<div class ="middle">
<center><div class="choices"><p>Please Refine Your Search: </p><form method="post" action="city.php" ><center><table>';


        foreach ($choice_array as $choiceNo) {
            if (strlen($choiceNo) > 2) {
                $choiceJSON = json_decode($choiceNo);
                echo "<tr><td><input type = 'radio' name='choice' value ='" . $choiceJSON->_id . "'/>  " . $choiceJSON->name . ", " . $choiceJSON->country . "</td></tr>";
            }

        }
        echo '<tr><td style="text-align:center"><input type="hidden" value=' . $format . ' name="degrees"/><button type="submit" class="btn btn-primary" style="text-align:center">Go</button></td></tr></table></center></form></div></center></div></div></body>
</html>';
        return;


}

/**
 * Calculates the distance in miles between a lat/lon pair.
 * @param $geoLat the geoIP latitude
 * @param $geoLon the geoIP longitude
 * @param $searchLat the searchResult latitude
 * @param $searchLon the searchResul longitude
 * @return float the distance, in miles between a pair of lat/lon coords.
 */
function distance($geoLat, $geoLon, $searchLat, $searchLon) {

    $theta = $geoLon - $searchLon;
    $dist = sin(deg2rad($geoLat)) * sin(deg2rad($searchLat)) +  cos(deg2rad($geoLat)) * cos(deg2rad($searchLat)) * cos(deg2rad($theta));
    $dist = acos($dist);
    $dist = rad2deg($dist);
    return $dist * 60 * 1.1515;
}

