<?php
require_once '../backend/trails.php';
global $user;

echo "En esta página, podrás indicar a cuales trails seguir e indicar un porciento de voto para darle a los posts que ellos voten.</br></br>";
Trail($user, "es");