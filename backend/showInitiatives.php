<?php
function showIniciatives($language)
{
    require_once 'Michelf/MarkdownExtra.inc.php';
    if ($language=="es") {
        $spanishInitiativesFile = $_SERVER['DOCUMENT_ROOT'] . "/../files/steem.place/spanishInitiatives.md";
        $body = fread(fopen($spanishInitiativesFile, "r"), filesize($spanishInitiativesFile));
    }
    echo \Michelf\MarkdownExtra::defaultTransform("$body");
}