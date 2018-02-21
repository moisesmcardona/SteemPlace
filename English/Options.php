<?php
require_once '../backend/options.php';
echo "In this page, you can activate additional functions.</br></br>";
global $user;
options($user, "en");
