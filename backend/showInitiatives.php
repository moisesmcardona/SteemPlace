<?php
function showIniciatives($language)
{
    require_once 'Michelf/MarkdownExtra.inc.php';
    if ($language=="es") {
        $body = file_get_contents("https://raw.githubusercontent.com/moisesmcardona/SteemPlace/master/backend/spanishInitiatives.md");
    }
    echo \Michelf\MarkdownExtra::defaultTransform("$body");
}