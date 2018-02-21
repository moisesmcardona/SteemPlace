<?php
/**
 * Created by PhpStorm.
 * User: cardo
 * Date: 2/19/2018
 * Time: 2:12 PM
 */
require_once '../backend/configuration.php';

global $user;
echo "En esta página, usted puede asociar su cuenta de Steemit con Steem.Place usando SteemConnect. Esto le permitirá usar la mayoría de las funciones de esta página.</a></br></br>";
AccountConfiguration($user, "en", $mysqli);
