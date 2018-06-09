<?php
/**
 * Created by PhpStorm.
 * User: cardo
 * Date: 2/19/2018
 * Time: 6:14 PM
 */
require_once 'config.php';
require_once 'functions.php';

function options($user, $language){
    $notifyenabled = 0;
    $replyenabled = 0;
    if ($language == "en") {
        $form = "<form method='post'>
                Settings:</br>
                Account: @<input name='account' type='text' value='%s'/></br>
                Receive mention notification emails?  <input type='checkbox' name='notify' value='notify' id='notify' %s></br>
                Receive reply notification emails?  <input type='checkbox' name='reply' value='reply' id='reply' %s></br>
                <input name='save' type='submit' value='Save'/></br>
                </form>";
        $settingsSaved = "</br><b>Settings Saved Successfully.</b>";
        $configureAccount = "You must first configure your account in order to use this page.</br></br>";
        $userNotLoggedIn = "You must login in order to use this page.</br></br>";
    } else {
        $form = "<form method='post'>
                Por favor, llene la siguiente información:</br>
                Cuenta: @<input name='account' type='text' value='%s'/></br>
                ¿Recibir Email cuando soy mencionado en un post?  <input type='checkbox' name='notify' value='notify' id='notify' %s></br>
                ¿Recibir Email cuando responden a mis comentarios o posts?  <input type='checkbox' name='reply' value='reply' id='reply' %s></br>
                <input name='save' type='submit' value='Guardar'/></br>";
        $settingsSaved = "</br><b>Los datos han sido guardados.</b>";
        $configureAccount = "Usted debe configurar su cuenta para poder acceder a esta página.</br></br>";
        $userNotLoggedIn = "Usted debe acceder a su cuenta para poder acceder a esta página.</br></br>";
    }
    if(user_is_logged_in()) {
        global $mysqli;
        $_SESSION['UserOK'] = 0;
        $result = $mysqli->query("SELECT * FROM users2 WHERE drupalkey = $user->uid");
        if (mysqli_num_rows($result) > 0) {
            while ($row = mysqli_fetch_assoc($result)) {
                $_SESSION['usertouse'] = $row["username"];
                $_SESSION['UserOK'] = 1;
            }
        }
        if (isset($_POST['save'])) {
            $_SESSION['usertouse'] = $_POST['account'];
            if (isset($_POST['notify']))
                $notifyenabled = 1;
            else
                $notifyenabled = 0;
            if (isset($_POST['reply']))
                $replyenabled = 1;
            else
                $replyenabled = 0;
            if ($_SESSION['recordfound'] == 0) {
                insertSettingsTable($user, $_SESSION['usertouse'], $notifyenabled, $replyenabled, $mysqli);
                $_SESSION['recordfound'] = 1;
            } else {
                updateSettingsTable($user, $_SESSION['usertouse'], $notifyenabled, $replyenabled, $mysqli);
                $_SESSION['recordfound'] = 1;
            }
            $ok = true;
        } else {
            if ($_SESSION['UserOK'] == 1) {
                $result = $mysqli->query("SELECT * FROM settings WHERE drupalkey = $user->uid");
                if (mysqli_num_rows($result) > 0) {
                    while ($row = mysqli_fetch_assoc($result)) {
                        $notifyenabled = $row["notifyenabled"];
                        $replyenabled = $row["replyenabled"];
                    }
                    $_SESSION['recordfound'] = 1;
                }
            } else {
                $_SESSION['recordfound'] = 0;
            }
        }
        if ($_SESSION['recordfound'] == 0)
            echo $configureAccount;
        else {
            if ($notifyenabled == 0)
                $notifychecked = '';
            else
                $notifychecked = 'checked';
            if ($replyenabled == 0)
                $replyenabled = '';
            else
                $replyenabled = 'checked';
            echo sprintf($form, $_SESSION['usertouse'], $notifychecked, $replyenabled);
        }
        if (isset($_POST['save'])) {
            if ($ok == true)
                echo $settingsSaved;
        }
    }
    else
        echo $userNotLoggedIn;
}