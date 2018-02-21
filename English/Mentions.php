<?php
require_once '../backend/mentionsAndVotes.php';
global $user;
echo "In this page, you can see the last 100 posts and comments where you've been mentioned<br>";
userMentionsAndVotes($user, "en", "mentions");
