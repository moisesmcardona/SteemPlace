<?php
require_once 'config.php';
function userMentionsAndVotes($user, $language, $action)
{
    global $mysqli;
    if ($language == "en"){
        if ($action == "mentions")
            $tableHeader = "<th>Author</th> 
                        <th>Post</th> 
                        <th>Date</th>";
        else
            $tableHeader = "<th>Author</th> 
                            <th>Post</th> 
                            <th>Percent</th>
                            <th>Original Voter</th>
                            <th>Date</th>";
        $accountNotConfigured = "</br></br>You must configure your account before page</br></br>";
        $notLoggedIn = "</br></br>You must be registered in order to use this page</br></br>";
    }
    else{
        if ($action == "mentions")
            $tableHeader = "<th>Autor</th> 
                            <th>Post</th> 
                            <th>Fecha</th>";
        else
            $tableHeader = "<th>Autor</th> 
                            <th>Post</th> 
                            <th>Porciento</th>
                            <th>Votador original</th>
                            <th>Hora</th>";
        $accountNotConfigured = "</br></br>Debes configurar tu cuenta antes de usar esta página</br></br>";
        $notLoggedIn = "</br></br>Tienes que registrarte para usar esta página</br></br>";
    }
    if (user_is_logged_in()) {
        $result = $mysqli->query("SELECT * FROM users2 WHERE drupalkey = $user->uid");
        if (mysqli_num_rows($result) > 0) {
            while ($row = mysqli_fetch_assoc($result)) {
                $username = $row['username'];
            }
            if ($action == "mentions")
                $result = $mysqli->query("SELECT * FROM mentions WHERE username='$username' ORDER BY id DESC LIMIT 100");
            else
                $result = $mysqli->query("SELECT * FROM voted WHERE voter='$username' AND processed=1 ORDER BY id DESC LIMIT 100");
            if (mysqli_num_rows($result) > 0) {
                echo "<script src=\"../tablesorter/docs/js/jquery-latest.min.js\"></script>
                      <link rel=\"stylesheet\" href=\"../tablesorter/css/theme.blue.css\"/>
                      <script src=\"../tablesorter/js/jquery.tablesorter.js\"></script> 
                      <script type=\"text/javascript\">
                                    $(document).ready(function()
                                        {
                                            $(\"table\").tablesorter({ theme : 'blue' });;
                                        }
                                    );
                                </script>
                      <table id=\"myTable\" class=\"tablesorter\">
                      <thead> 
                      <tr> 
                       $tableHeader
                      </tr> 
                      </thead> 
                      <tbody> ";
                while ($row = mysqli_fetch_assoc($result)) {
                    if ($action == "mentions")
                        echo "<tr><td><a href=https://steemit.com/@" . $row['author'] . "  target=_blank>@" . $row['author'] . "</a></td><td><a href=https://steemit.com/tag/@" . $row['author'] . "/" . $row['link'] . "  target=_blank>" . $row['link'] . "</a></td><td>" . $row['time'] . "</tr>";
                    else
                        echo "<tr><td><a href=https://steemit.com/@" . $row['author'] . "  target=_blank>@" . $row['author'] . "</a></td><td><a href=https://steemit.com/tag/@" . $row['author'] . "/" . $row['permlink'] . "  target=_blank>" . $row['permlink'] . "</a></td><td>" . $row['weight'] . "%</td><td><a href=https://steemit.com/@" . $row['originalvoter'] . "  target=_blank>@" . $row['originalvoter'] . "</a></td><td>" . $row['date'] . "</tr>";
                }
                echo "</tbody></table>";
            }
        } else {
            echo $accountNotConfigured;
        }
    } else {
        echo $notLoggedIn;
    }
}