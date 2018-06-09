<?php

require_once '../backend/postNotification.php';

global $user;
echo "In this page, you can configure the accounts you want to receive email notifications when they publish a new post.<br><br>";
postNotification($user, "en");
