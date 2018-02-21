<?php
/**
 * Created by PhpStorm.
 * User: cardo
 * Date: 2/20/2018
 * Time: 5:46 PM
 */
require_once 'config.php';
function userInfo($user, $language){
    global $mysqli;
    if ($language == "en"){
        $informationHeader = "Information from: ";
        $votingPower = "Voting Power: ";
        $witnessNotice = "You have not voted <a href=https://steemit.com/@moisesmcardona>@moisesmcardona</a> as a Witness yet. <a href=https://v2.steemconnect.com/sign/account-witness-vote?witness=moisesmcardona&approve=1>Click here to vote him as Witness</a>";
    }
    else {
        $informationHeader = "Información de: ";
        $votingPower = "Poder de voto: ";
        $witnessNotice = "Todavía no has votado a <a href=https://steemit.com/@moisesmcardona>@moisesmcardona</a> como Witness. <A href=https://v2.steemconnect.com/sign/account-witness-vote?witness=moisesmcardona&approve=1>Vótalo como Witness presionando aquí.</a>";
    }
    if(user_is_logged_in()){
        $result=$mysqli->query("SELECT * FROM users2 WHERE drupalkey = $user->uid");
        if(mysqli_num_rows($result) > 0){
            while($row = mysqli_fetch_assoc($result)) {
                $usertouse=$row["username"];
                $userOK = 1;
            }
        }
        if ($userOK == 1){
            echo "<b>";
            echo  $informationHeader . $usertouse . "</br></br>";
            echo $votingPower;
            echo file_get_contents("https://api.steem.place/getVP/?a=$usertouse");
            echo "%</br>";
            echo "</b></br></br>";

            $witnessvotes = file_get_contents("https://api.steem.place/getWitnessVotes/?a=$usertouse");
            if (strpos($witnessvotes, 'moisesmcardona') === FALSE)
            {
                echo $witnessNotice;
            }
        }
    }
}
