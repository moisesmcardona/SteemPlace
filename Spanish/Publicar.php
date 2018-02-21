<?php
header('X-XSS-Protection:0');
require_once '../backend/publish.php';
global $user;
publish($user, "es");