<?php
/**
 * Created by PhpStorm.
 * User: cardo
 * Date: 2/19/2018
 * Time: 7:41 PM
 */
require_once '../backend/mentionsAndVotes.php';
global $user;
echo "En esta página, puedes ver los últimos 100 posts y comentarios en los que has sido mencionado.<br>";
userMentionsAndVotes($user, "es", "mentions");