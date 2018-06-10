<?php
/**
 * Created by PhpStorm.
 * User: cardo
 * Date: 6/10/2018
 * Time: 4:25 PM
 */
require_once "../backend/checkUserWitnessVote.php";
if(user_is_logged_in() == False)
    if(isset($_GET['usuario']))
        welcomeAndCheckIfWitnessVoted($_GET['usuario'], "es");