<?php
require_once '../backend/mentionsAndVotes.php';
global $user;
echo "A continuación, se muestra una lista de los posts que usted ha votado usando este sistema: <br>";
userMentionsAndVotes($user, "es", "votes");
