<?php
require_once 'functions.php';
require_once 'config.php';
function followVotes($user, $language){
    global $mysqli;
    $_SESSION['UserOK']=0;
    if ($language == "en"){
        $cantAddSameUsername = "<b>You can't add your own account. Please add another account</b></br></br>";
        $editingAccount = "Editing account: %s</br>
					 <form method='post'>
					 Please enter the following information:</br>
					 Account: @<input name='account' type='text' value='%s' readonly/></br>
					 Voting Percent: <input name='weight' type='text' value='%s'> %% (DONT WRITE %% SYMBOL)</br>
					 (Use 0 to vote with the voter's original percent)</br></br>
					 Enable: <input type='checkbox' name='activar' value='activar' id='activar' %s></br>
					 <input name='saveedit' type='submit' value='save changes'/></br>
					 </form>";
        $addUserForm = "<form method='post'>
				 Please enter the following information:</br>
				 Account: @<input name='account' type='text'/></br>
				 Voting Percent: <input name='weight' type='text'/ value='20'> % (DONT WRITE % SYMBOL)</br>
				 (Use 0 to vote with the voter's original percent)</br></br>
				 Enable: <input type='checkbox' name='activar' value='activar' id='activar'></br>
				 <input name='save' type='submit' value='add' /></br>
				 </form>";
        $accountNotConfigured = "You must configure your account first before using this function</br></br>";
        $userNotLoggedIn = "You must register first and configure your account before using this account</br></br>";
        $tableColumns = "<th>Account</th> 
                    <th>Percent</th> 
                    <th>Enabled</th> 
                    <th>Edit</th> 
                    <th>Remove</th>";
        $accountEnabledYes = 'YES';
        $accountEnabledNo = 'NO';
        $accountEdit = "Edit";
        $accountRemove = "Remove";
    }
    else{
        $cantAddSameUsername = "<b>No puedes añadir tu propia cuenta</b></br></br>";
        $editingAccount = "Editando cuenta: %s</br>
					 <form method='post'>
					 Por favor, entre la siguiente información:</br>
					 Cuenta: @<input name='account' type='text' value='%s' readonly/></br>
					 Porciento de voto: <input name='weight' type='text'/ value='%s'> %% (NO ESCRIBA EL SÍMBOLO %%)</br>
					 (Escriba 0 para votar con el porciento original)</br></br>
					 Activar: <input type='checkbox' name='activar' value='activar' id='activar' %s></br>
					 <input name='saveedit' type='submit' value='guardar cambios'/></br>
					 </form>";
        $addUserForm = "<form method='post'>
					 Por favor, entre la siguiente información:</br>
					 Cuenta: @<input name='account' type='text'/></br>
					 Porciento de voto: <input name='weight' type='text'/ value='20'> % (NO ESCRIBA EL SÍMBOLO %)</br>
					 (Escriba 0 para votar con el porciento original)</br></br>
					 Activar: <input type='checkbox' name='activar' value='activar' id='activar'></br>
					 <input name='save' type='submit' value='añadir' /></br>
					 </form>";
        $accountNotConfigured = "Usted debe configurar su cuenta para usar esta función</br></br>";
        $userNotLoggedIn = "Usted debe acceder a su cuenta para usar esta función</br></br>";
        $tableColumns = "<th>Cuenta</th> 
				<th>Porciento</th> 
				<th>Activado</th> 
				<th>Editar</th> 
				<th>Remover</th>";
        $accountEnabledYes = 'SI';
        $accountEnabledNo = 'NO';
        $accountEdit = "Editar";
        $accountRemove = "Remover";
    }
    if(user_is_logged_in()){
        $result=$mysqli->query("SELECT * FROM users2 WHERE drupalkey = $user->uid");
        if(mysqli_num_rows($result) > 0){
            while($row = mysqli_fetch_assoc($result)) {
                $_SESSION['usertouse']=$row["username"];
                $_SESSION['UserOK']=1;
            }
        }
        $_SESSION['UserOK'] = checkUser($user, $_SESSION['UserOK'], $mysqli);
        if($_SESSION['UserOK']==1){
            if(isset($_POST['save'])){
                if($_SESSION['usertouse']==$_POST['account']){
                    echo $cantAddSameUsername;
                }
                else{
                    $account=$_POST['account'];
                    $percent=$_POST['weight'];
                    if (isset($_POST['activar']))
                        $enabled=1;
                    else
                        $enabled=0;
                    addUserToFollowTable($user, $_SESSION['usertouse'], strtolower($account), $percent, $enabled, $mysqli);
                    unset($_GET['action']);
                }
            }
            elseif(isset($_POST['saveedit'])){
                $account=$_POST['account'];
                $percent=$_POST['weight'];
                if (isset($_POST['activar']))
                    $enabled=1;
                else
                    $enabled=0;
                updateUserToFollowTable($user, $account, $percent, $enabled, $mysqli);
                unset($_GET['action']);
            }
            if(empty($_GET['action']) == false){
                $action=$_GET['action'];
                if ($action=="edit"){
                    if ($_GET['enabled'] == 1)
                        $checked = 'checked';
                    else
                        $checked = '';
                    echo sprintf($editingAccount, $_GET['account'], $_GET['account'], $_GET['percent'], $checked);
                }
                elseif ($action=="delete"){
                    deleteUserFromFollowTable($user, $_GET['account'], $mysqli);
                    unset($_GET['action']);
                    echo $addUserForm;
                }
            }
            else{
                echo $addUserForm;
            }
        }
        else
        {
            echo $accountNotConfigured;
        }
    }
    else{
        echo $userNotLoggedIn;
    }
    if ($_SESSION['UserOK']==1) {
        $result = $mysqli->query("SELECT * FROM followtrail WHERE drupalkey=" . $user->uid . " ORDER BY account ASC");
        if (mysqli_num_rows($result) > 0) {
            echo "<script src='../tablesorter/docs/js/jquery-latest.min.js'></script>
                  <link rel='stylesheet' href='../tablesorter/css/theme.blue.css'/>
                  <script src='../tablesorter/js/jquery.tablesorter.js'></script> 
                  <script type='text/javascript'>
                  $(document).ready(function() 
                    { 
                        $('table').tablesorter({ theme : 'blue' });; 
                    } 
                  ); 
                  </script>
                  <table id='myTable' class='tablesorter'>
                  <thead> 
                  <tr> 
                    $tableColumns
                  </tr> 
                  </thead> 
                  <tbody> ";
            while ($row = mysqli_fetch_assoc($result)) {
                if ($row['enabled'] == 1)
                    $enabled = $accountEnabledYes;
                else
                    $enabled = $accountEnabledNo;
                if ($row['percent'] == 0)
                    $percent = 'Original';
                else
                    $percent = $row['percent'];
                echo "<tr><td><a href=https://steemit.com/@" . $row['account'] . " target=_blank>@" . $row['account'] . "</a></td><td>" . $percent . "</td><td>" . $enabled . "</td><td><a href='?action=edit&account=" . $row['account'] . "&percent=" . $row['percent'] . "&enabled=" . $row['enabled'] . "'>$accountEdit</a></td><td><a href='?action=delete&account=" . $row['account'] . "'>$accountRemove</a></td></tr>";
            }
            echo "</tbody>
                 </table>";
        }
    }
}
