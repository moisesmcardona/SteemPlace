<?php
/**
 * Created by PhpStorm.
 * User: cardo
 * Date: 6/10/2018
 * Time: 4:21 PM
 */
function welcomeAndCheckIfWitnessVoted($user, $language){
    if ($language == "en") {
        $HelloHeader = "Welcome, <a href=https://steemit.com/@$user>@$user</a>";
        $witnessNotice = "You have not voted <a href=https://steemit.com/@moisesmcardona>@moisesmcardona</a> as a Witness yet. <a href=https://v2.steemconnect.com/sign/account-witness-vote?witness=moisesmcardona&approve=1>Click here to vote him as Witness</a>";
    }
    else{
        $HelloHeader = "Hola, <a href=https://steemit.com/@$user>@$user</a>";
        $witnessNotice = "Todavía no has votado a <a href=https://steemit.com/@moisesmcardona>@moisesmcardona</a> como Witness/Testigo. <A href=https://v2.steemconnect.com/sign/account-witness-vote?witness=moisesmcardona&approve=1>¡Vótalo presionando aquí!</a>";
    }
    $witnessvotes = file_get_contents("https://api.steem.place/getWitnessVotes/?a=$user");
    echo "<b>" . $HelloHeader. "<br><br>";
    if (strpos($witnessvotes, 'moisesmcardona') === FALSE)
    {
        echo $witnessNotice . "</b>";
    }
}