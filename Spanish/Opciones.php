<?php
require_once '../backend/options.php';
echo "En esta página, usted podrá activar funciones adicionales.</br></br>";
global $user;
options($user, "es");
