<?php
require_once '../backend/mentionsAndVotes.php';
global $user;
echo "In this page, you can see votes currently pending to be processed by the Account Vote and Trail Following system (Shown a maximum of 5,000 votes)<br>";
userMentionsAndVotes($user, "en", "pendingVotes");
