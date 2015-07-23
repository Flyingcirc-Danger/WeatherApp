<?php
/**
 * Created by PhpStorm.
 * User: Tom_Bryant
 * Date: 7/23/15
 * Time: 12:09 PM
 */

include 'refine-search.php';

//FIRST TEST FOR ZIP CODE
$zipPattern = '/(^\d{5}$)|(^\d{5}-\d{4}$)/';
$zipTest = $_POST["query"];

if(preg_match($zipPattern,$zipTest) > 0){
    //Do Zip search
    echo "Zip Code: " . $zipTest;

} else {
    //Check to see the number of results. (We'll search by id next)
    refineSearch($zipTest);
}










