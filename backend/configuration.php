<?php
require_once 'functions.php';
require_once 'config.php';

function AccountConfiguration($user, $language)
{
    global $mysqli;
    if ($language == "en") {
        $form_recordNotFound = "<form method='post'>
				Step 1: Please enter your Steem account name:</br>
				Account: @<input name='account' type='text'/></br></br>
				Step 2: Press the Save button:</br>
				<input name='save' type='submit' value='Save' /></br>
				</form>";
        $form_userSaved = "<form method='post'>
				Step 1: Please enter your Steem account name:</br>
				Account: @<input name='account' type='text' value='%s'/></br></br>
				Step 2: Press the Save button if you changed your Steem account name:</br>
				<input name='save' type='submit' value='Save' /></br>
				</form></br>";
        $step3_notApproved = "Step 3: Please associate your Steem account with Steem.Place by <a href=https://v2.steemconnect.com/authorize/@steem.place?redirect_uri=https://steem.place/en/Configure>clicking here</a>";
        $step3_approved = "Step 3: You have approved Steem.Place with your Steem Account!</br></br>";
        $remove_link = "To remove the association from your account, <a href=https://v2.steemconnect.com/revoke/@steem.place target=_blank> please click here. Then, refresh this page to complete the association removal.</a></br></br>";
        $not_logged_in = "You must be logged in in order to configure your account. If you don't have an account, please register.</br></br>";
    }
    else{
        $form_recordNotFound = "<form method='post'>
				Paso 1: Por favor escriba su nombre de usuario de Steem:</br>
				Cuenta: @<input name='account' type='text'/></br></br>
				Paso 2: Presione el botón de guardar:</br>
				<input name='save' type='submit' value='Guardar' /></br>
				</form>";
        $form_userSaved = "<form method='post'>
				Paso 1: Por favor escriba su nombre de usuario de Steem:</br>
				Cuenta: @<input name='account' type='text' value='%s'/></br></br>
				Paso 2: Presione el botón de guardar si usted cambió su nombre arriba:</br>
				<input name='save' type='submit' value='Save' /></br>
				</form></br>";
        $step3_notApproved = "Paso 3: Por favor asocie su cuenta de Steem con Steem.Place <a href=https://v2.steemconnect.com/authorize/@steem.place?redirect_uri=https://steem.place/es/Configuracion>presionando aquí</a>";
        $step3_approved = "Paso 3: Usted ha asociado su cuenta con Steem.Place.</br></br>";
        $remove_link = "Para remover su asociación de esta página, <a href=https://v2.steemconnect.com/revoke/@steem.place target=_blank> por favor, oprima aquí. Luego, refresque esta página para eliminar su asociación.</a></br></br>";
        $not_logged_in = "Usted debe estár logueado con su cuenta de steem.place para configurar su cuenta. Por favor acceda a su cuenta o regístrese.</br></br>";
    }
    if (user_is_logged_in()) {
        if (isset($_POST['save'])) {
            $account = $_POST['account'];
            $account = str_replace(";", "_", $account);
            $account = str_replace("\'", "_", $account);
            $account = str_replace("\"", "_", $account);
            $account = str_replace("&", "_", $account);
            $account = str_replace(" ", "_", $account);
            $checkUser = file_get_contents("https://api.steem.place/checkApprovedAccounts/?user=$account&account=steem.place");
            if ($checkUser == "True")
                $approved = 1;
            else
                $approved = 0;
            $recordfound = $_SESSION['recordfound'];
            if ($recordfound == 0) {
                insertUserTable($user, $account, $approved, $mysqli);
                $recordfound = 1;
            } else {
                updateUserTable($user, $account, $approved, $mysqli);
                $recordfound = 1;
            }
        } else {
            $result = $mysqli->query("SELECT * FROM users2 WHERE drupalkey = $user->uid");
            if (mysqli_num_rows($result) > 0) {
                while ($row = mysqli_fetch_assoc($result)) {
                    $recordfound = 1;
                    $account = $row["username"];
                }
            } else {
                $recordfound = 0;
            }
            $_SESSION['recordfound'] = $recordfound;
        }
        if ($recordfound == 0) {
            echo $form_recordNotFound;
        } else {
            $checkUser = file_get_contents("https://api.steem.place/checkApprovedAccounts/?user=$account&account=steem.place");
            if ($checkUser == "True")
                $approved = 1;
            else
                $approved = 0;
            echo sprintf($form_userSaved, $account);
            if ($approved == 0) {
                echo $step3_notApproved;
                updateUserTable($user, $account, $approved, $mysqli);
            } else {
                echo $step3_approved;
                updateUserTable($user, $account, $approved, $mysqli);
                echo $remove_link;
            }
        }
    } else {
        echo $not_logged_in;
    }
}