<?php
/**
 * Created by PhpStorm.
 * User: cardo
 * Date: 2/19/2018
 * Time: 8:21 PM
 */
header('X-XSS-Protection:0');
global $user;
publish($user, "en");