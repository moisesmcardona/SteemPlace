<?php
/**
 * Created by PhpStorm.
 * User: cardo
 * Date: 2/19/2018
 * Time: 5:22 PM
 */
require_once '../backend/trails.php';
global $user;

echo "In this page, you can follow the Trails listed to vote on posts they vote. You can also set the voting weight of your choice</br></br>";
Trail($user, "en");