<?php
/**
 * Created by PhpStorm.
 * User: cardo
 * Date: 2/19/2018
 * Time: 11:51 AM
 */

function updateUserTable($user, $acc, $appr, $mysqli){
    $stmt = $mysqli->prepare("UPDATE users2 SET username=?, approved='$appr' WHERE drupalkey = $user->uid");
    $stmt->bind_param("s", $acc);
    $stmt->execute();
    $stmt->close();
}
function insertUserTable($user, $acc, $appr, $mysqli){
    $stmt = $mysqli->prepare("INSERT INTO users2 (drupalkey, username, approved) VALUES ($user->uid, ?, '$appr')");
    $stmt->bind_param("s", $acc);
    $stmt->execute();
    $stmt->close();
}
function addUserToFollowTable($user, $usertouse, $account, $percent, $enabled, $mysqli){
    $stmt = $mysqli->prepare("INSERT INTO followtrail (drupalkey, user, account, percent, enabled) VALUES (".$user->uid.", ?, ?, ?, ?)");
    $stmt->bind_param("sssi", $usertouse, $account, $percent, $enabled);
    $stmt->execute();
    $stmt->close();
}
function updateUserToFollowTable($user, $account, $percent, $enabled, $mysqli){
    $stmt = $mysqli->prepare("UPDATE followtrail SET percent=?, enabled=? WHERE account=? AND drupalkey=".$user->uid);;
    $stmt->bind_param("sis", $percent, $enabled, $account);
    $stmt->execute();
    $stmt->close();
}
function deleteUserFromFollowTable($user, $account, $mysqli){
    $stmt = $mysqli->prepare("DELETE FROM followtrail WHERE account=? AND drupalkey=".$user->uid);
    $stmt->bind_param("s", $account);
    $stmt->execute();
    $stmt->close();
}
function getUserVoteReport($user, $date, $sort, $mysqli){
    $stmt = $mysqli->prepare("SELECT DISTINCT * FROM votesprocessed WHERE voter=? AND date LIKE ? ORDER BY $sort");
    $date = "{$date}%";
    $stmt->bind_param("ss", $user, $date);
    $stmt->execute();
    $results = $stmt->get_result();
    $stmt->close();
    return $results;
}
function insertSettingsTable($user, $username, $notifyenabled, $mysqli){
    $stmt = $mysqli->prepare("INSERT INTO settings (drupalkey, username, notifyenabled) VALUES ($user->uid, ?, $notifyenabled)");
    $stmt->bind_param("s", $username);
    $stmt->execute();
    $stmt->close();
}
function insertPublishedPost($username, $url, $mysqli){
    $stmt = $mysqli->prepare("INSERT INTO steemplaceposts (user, link) VALUES (?, ?)");
    $stmt->bind_param("ss", $username, $url);
    $stmt->execute();
    $stmt->close();
}
function updateSettingsTable($user, $username, $notifyenabled, $mysqli){
    $stmt = $mysqli->prepare("UPDATE settings SET username=?, notifyenabled=$notifyenabled WHERE drupalkey = $user->uid");
    $stmt->bind_param("s", $username);
    $stmt->execute();
    $stmt->close();
}
function getTrailCount($language, $trail, $account, $mysqli){
    if ($language == "en"){
        $text = "Members currently participating in ";
    }
    else{
        $text = "Miembros actualmente participando en ";
    }
    $stmt = $mysqli->prepare("SELECT DISTINCT * FROM followtrail WHERE account = ? AND enabled=1");
    $stmt->bind_param("s", $account);
    $stmt->execute();
    $result = $stmt->get_result();
    $counter = 0;
    while($row = mysqli_fetch_assoc($result)) {
        $counter = $counter + 1;
    }
    $stmt->close();
    echo "<b>$text $trail (<a href=https://steemit.com/@$account>@$account</a>): $counter </b></br>";
}
function checkUser($user, $userstatus, $mysqli){
    if($userstatus==1){
        $check = file_get_contents("https://api.steem.place/checkApprovedAccounts/?user=".$_SESSION['usertouse']."&account=steem.place");
        if ($check == "True"){
            $mysqli->query("UPDATE users2 SET approved=1 WHERE drupalkey = $user->uid");
        }
        else {
            $mysqli->query("UPDATE users2 SET approved=0 WHERE drupalkey = $user->uid");
            $userstatus = 0;
        }
    }
    return $userstatus;
}