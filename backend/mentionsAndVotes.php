<?php
require_once 'config.php';
function userMentionsAndVotes($user, $language, $action)
{
    global $mysqli;
    if ($language == "en"){
        if ($action == "mentions") {
            $nodata = "You haven't been mentioned in a post";
            $tableHeader = "<th>Author</th> 
                        <th>Post</th> 
                        <th>Date</th>";
        }
        else if ($action == "pendingVotes") {
            $nodata = "The system is up to date";
            $tableHeader = " <th>Date</th>
                            <th>Author</th> 
                            <th>Post</th> 
                            <th>Percent</th>
                            <th>Original Voter</th>";
        }
        else {
            $nodata = "You haven't voted in any post using the Steem.Place system";
            $tableHeader = "<th>Author</th> 
                            <th>Post</th> 
                            <th>Percent</th>
                            <th>Original Voter</th>
                            <th>Date</th>";
        }
        $accountNotConfigured = "</br></br>You must configure your account before page</br></br>";
        $notLoggedIn = "</br></br>You must be registered in order to use this page</br></br>";
    }
    else{
        if ($action == "mentions") {
            $nodata = "No has sido mencionado en ningún post";
            $tableHeader = "<th>Autor</th> 
                            <th>Post</th> 
                            <th>Fecha</th>";
        }
        else if ($action == "pendingVotes") {
            $nodata = "El sistema está al día con los votos";
            $tableHeader = "<th>Fecha</th>
                            <th>Autor</th> 
                            <th>Post</th> 
                            <th>Porciento</th>
                            <th>Votador original</th>";
        }
        else {
            $nodata = "No has votado en ningún post";
            $tableHeader = "<th>Autor</th> 
                            <th>Post</th> 
                            <th>Porciento</th>
                            <th>Votador original</th>
                            <th>Fecha</th>";
        }
        $accountNotConfigured = "</br></br>Debes configurar tu cuenta antes de usar esta página</br></br>";
        $notLoggedIn = "</br></br>Tienes que registrarte para usar esta página</br></br>";
    }
    if (user_is_logged_in() || $action == "pendingVotes") {
        $result = $mysqli->query("SELECT * FROM users2 WHERE drupalkey = $user->uid");
        if (mysqli_num_rows($result) > 0 || $action == "pendingVotes") {
            while ($row = mysqli_fetch_assoc($result)) {
                $username = $row['username'];
            }
            if ($action == "mentions")
                $result = $mysqli->query("SELECT * FROM mentions WHERE username='$username' ORDER BY id DESC LIMIT 100");
            else if ($action == "pendingVotes")
                $result = $mysqli->query("SELECT * FROM votes WHERE processed = 0 ORDER BY id ASC LIMIT 5000");
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
                        echo "<tr><td><a href=https://steemit.com/@" . $row['author'] . "  target=_blank>@" . $row['author'] . "</a></td><td><a href=https://steemit.com/tag/@" . $row['author'] . "/" . $row['link'] . "  target=_blank>" . $row['link'] . "</a></td><td>" . $row['time'] . "</td></tr>";
                    else if ($action == "pendingVotes")
                        echo "<tr><td>" . $row['date'] . "</td><td><a href=https://steemit.com/@" . $row['author'] . "  target=_blank>@" . $row['author'] . "</a></td><td><a href=https://steemit.com/tag/@" . $row['author'] . "/" . $row['permlink'] . "  target=_blank>" . $row['permlink'] . "</a></td><td>" . $row['weight'] . "%</td><td><a href=https://steemit.com/@" . $row['voter'] . "  target=_blank>@" . $row['voter'] . "</a></td></tr>";
                    else
                        echo "<tr><td><a href=https://steemit.com/@" . $row['author'] . "  target=_blank>@" . $row['author'] . "</a></td><td><a href=https://steemit.com/tag/@" . $row['author'] . "/" . $row['permlink'] . "  target=_blank>" . $row['permlink'] . "</a></td><td>" . $row['weight'] . "%</td><td><a href=https://steemit.com/@" . $row['originalvoter'] . "  target=_blank>@" . $row['originalvoter'] . "</a></td><td>".$row['date']."</td></tr>";
                }
                echo "</tbody></table>";
            }
            else
               echo '<br>' . $nodata;
        } else {
            echo $accountNotConfigured;
        }
    } else {
        echo $notLoggedIn;
    }
}