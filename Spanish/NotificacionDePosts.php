<?php

require_once '../backend/postNotification.php';

global $user;
echo "En esta página, podrás configurar las cuentas para recibir correos electrónicos cuando hagan posts nuevos.<br><br>";
postNotification($user, "es");
