<?php
require_once '../backend/mentionsAndVotes.php';
global $user;
echo "En esta página, puede ver los votos pendientes de ser procesados por el Sistema de Seguir Votos de Cuentas y Seguir a los Trails. (Mostrados hasta máximo 5,000 votos pendientes)<br>";
userMentionsAndVotes($user, "es", "pendingVotes");
