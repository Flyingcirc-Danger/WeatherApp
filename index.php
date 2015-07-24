<?php
/**
 * Created by PhpStorm.
 * User: Tom_Bryant
 * Date: 7/23/15
 * Time: 11:17 AM
 */

include 'Header.php';

//get geoip data
$ip = $_SERVER['REMOTE_ADDR'];
$details = json_decode(file_get_contents("http://ipinfo.io/{$ip}/json"));


echo '<body style="background-color:#BBDEFB;">
<div class="page">
    <div class="middle">
        <div class="cityInput">
            <center>
                <table>
                    <tr>
                        <form method="post" action="display.php">
                            <td><input type="text" name="query" class="form-control inputBar"
                                       placeholder="Enter Zip or City"></td>
                            <td><select class="form-control" name="degrees">
                                    <option value="imperial">&deg;F</option>
                                    <option value="metric">&deg;C</option>
                                    <option value="kelvin">&deg;K</option>
                                    </td><td>
                                        <button type="submit" class="btn btn-primary">Go</button>
                                    </td>
                        </form>
                    </tr>
                </table>
            </center>
            <br>
            <p> Or Find Weather in: </p>
            <center>
                <table>
                    <tr>
                        <form method="post" action="display.php">
                            <td>
                                <button type="submit" name="loc" class="btn btn-primary" value="' . $details->loc .'">' . $details->city . '</button>
                            </td>
                            <td><select class="form-control" name="degrees">
                                    <option value="imperial">&deg;F</option>
                                    <option value="metric">&deg;C</option>
                                    <option value="kelvin">&deg;K</option>
                            </td>
                        </form>
                    </tr>
                </table>
            </center>
        </div>
    </div>
</div>
</body>
</html>';






?>

