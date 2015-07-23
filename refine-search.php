<?php
/**
 * Created by PhpStorm.
 * User: Tom_Bryant
 * Date: 7/23/15
 * Time: 2:06 PM
 * @param $searchTerm
 */


function refineSearch($searchTerm)
{
    $citySearch = "grep " . $searchTerm . " city.list.json";
    $choices = shell_exec($citySearch);
    $choice_array = explode("\n", $choices);
    echo '<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="">
    <meta name="author" content="">
    <link rel="icon" href="../../favicon.ico">
    <script src="../../js/choices.js"></script>

    <title>Project Juicebox</title>

    <!-- Bootstrap core CSS -->
    <link href="../../dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="../../dist/css/weather.css" rel="stylesheet">

    <!-- Custom styles for this template -->
    <link href="grid.css" rel="stylesheet">

    <!-- HTML5 shim and Respond.js for IE8 support of HTML5 elements and media queries -->
    <!--[if lt IE 9]>
    <script src="https://oss.maxcdn.com/html5shiv/3.7.2/html5shiv.min.js"></script>
    <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
    <![endif]-->
</head>
<body>
<div id="choices"><p>Please Refine Your Search: </p><form><ol>';

    foreach ($choice_array as $choiceNo) {
        if (strlen($choiceNo) > 2) {
            $choiceJSON = json_decode($choiceNo);
            echo "<li><input type = 'radio' name='choice' value ='" . $choiceJSON->_id . "'/>  ". $choiceJSON->name . ", " . $choiceJSON->country . "</li>";
        }

    }


    echo '<button type="submit" class="btn btn-primary">Go</button></td></form></ol></div></body>
</html>';
    return;

}