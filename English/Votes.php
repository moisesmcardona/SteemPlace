<?php
require_once '../backend/mentionsAndVotes.php';
global $user;
echo "In this page, you can see a list of votes you've done using this system.<br>";
userMentionsAndVotes($user, "en", "votes");
