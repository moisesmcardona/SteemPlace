<?php
/**
 * Created by PhpStorm.
 * User: cardo
 * Date: 2/20/2018
 * Time: 5:55 PM
 */
require_once 'config.php';
require_once 'functions.php';
function trailCount($language){
    global $mysqli;
    getTrailCount($language, "BABEL SIN FRONTERAS", "babelproyect", $mysqli);
    getTrailCount($language, "Bienvenida", "bienvenida", $mysqli);
    getTrailCount($language, "Cervantes", "cervantes", $mysqli);
    getTrailCount($language, "Cinauco ", "cinauco", $mysqli);
    getTrailCount($language, "CodeByte ", "codebyte", $mysqli);
    getTrailCount($language, "dropahead", "dropahead", $mysqli);
    getTrailCount($language, "Proyecto Engranate", "engranaje", $mysqli);
    getTrailCount($language, "MUSICLASS", "musiclass", $mysqli);
    getTrailCount($language, "ProVenezuela", "provenezuela", $mysqli);
    getTrailCount($language, "Reveur", "reveur", $mysqli);
    getTrailCount($language, "Ruta Blockchain", "rutablockchain", $mysqli);
    getTrailCount($language, "Sr. Cianuro", "srcianuro", $mysqli);
    getTrailCount($language, "LA UNION", "theunion", $mysqli);
    getTrailCount($language, "Trail Hispano", "trailhispano", $mysqli);
    getTrailCount($language, "Ubi Caritas", "ubicaritas", $mysqli);
    getTrailCount($language, "votovzla ", "votovzla", $mysqli);
    echo "<br>NOTE: These numbers only shows the amount of users who are following these trails by using this website.";
}