<?php
/**
 * Created by PhpStorm.
 * User: cardo
 * Date: 2/19/2018
 * Time: 2:52 PM
 */

require_once '../backend/configuration.php';

global $user;
echo "In this page, you can associate your Steemit account with Steem.Place by using SteemConnect. This will allow you to use most of this site functions.</a></br></br>";
AccountConfiguration($user, "en");
