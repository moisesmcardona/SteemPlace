<?php
/**
 * Created by PhpStorm.
 * User: cardo
 * Date: 1/28/2018
 * Time: 12:30 PM
 */

global $mysqli, $sp_ppk;
$mysqli = new mysqli('host', 'username', 'password', 'database');
if ($mysqli->connect_error) {
    exit('Error connecting to database');
}
$mysqli->set_charset("utf8");
$sp_ppk = "Here goes the Private Posting Key";