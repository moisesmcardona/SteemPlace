<?php
/**
 * Created by PhpStorm.
 * User: cardo
 * Date: 2/19/2018
 * Time: 12:44 PM
 */

require_once '../backend/followVotes.php';

global $user;
echo "In this page, you can configure the accounts you want to follow so when they vote on a post, you can also vote on them. You can also setup the percent you want to give to the posts an account vote.<br><br>";
followVotes($user, "en");
