<?php
/**
 * Created by PhpStorm.
 * User: cardo
 * Date: 2/19/2018
 * Time: 12:44 PM
 */

require_once '../backend/followVotes.php.php';

global $user;
echo "En esta página, usted puede configurar las cuentas que quiere seguir para votar en los posts que estas cuentas voten. También, puedes configurar el porciento que deseas darle a los posts.<br><br>";
followVotes($user, "es");
