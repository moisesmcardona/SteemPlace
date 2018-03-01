<?php
require_once 'config.php';
require_once 'functions.php';

function Trail($user, $language)
{
    global $mysqli;
    if ($language == "en") {
        $accountNotConfigured = "You must first configure your account in order to use this function";
        $settingsSavedString = "<b>Settings saved successful!</b></br></br>";
        $percentNote = "<b>NOTE: 0 means vote with original weight</b>";
        $tableHeader = "<th>Trail</th><th>Activate</th><th>Percent</th>";
        $saveString = "Save";
        $notLoggedIn = "You must be logged in in order to configure your account. If you don't have an account, please register.</br></br>";
    }
    else{
        $accountNotConfigured = "Debes configurar tu cuenta primero en la sección de Configuración";
        $settingsSavedString = "<b>¡Configuración de Trails guardados exitósamente!</b></br></br>";
        $percentNote = "<b>NOTA: 0 significa votar con el porciento original.</b>";
        $tableHeader = "<th>Trail</th><th>Activar</th><th>Porciento</th>";
        $saveString = "Guardar";
        $notLoggedIn = "Usted debe registrarse para poder utilizar esta sección</br></br>";
    }
    if (user_is_logged_in()) {
        $result = $mysqli->query("SELECT * FROM users2 WHERE drupalkey = $user->uid");
        if (mysqli_num_rows($result) > 0) {
            while ($row = mysqli_fetch_assoc($result)) {
                $recordfound = 1;
                $_SESSION['usertouse'] = $row['username'];
            }
        } else {
            $recordfound = 0;
        }
        $_SESSION['recordfound'] = $recordfound;
        $approved = checkUser($user, $recordfound, $mysqli);
        if ($recordfound == 0 || $approved == 0) {
            echo $accountNotConfigured;
        } else {
            $settingsSaved = False;
            $amigoosChecked = "";
            $amigoosPercent = 0.0;
            $amigoosFound = False;
            $babelproyectChecked = "";
            $babelproyectPercent = 0.0;
            $babelproyectFound = False;
            $bienvenidaChecked = "";
            $bienvenidaPercent = 0.0;
            $bienvenidaFound = False;
            $codebyteChecked = "";
            $codebytePercent = 0.0;
            $codebyteFound = False;
            $cervantesChecked = "";
            $cervantesPercent = 0.0;
            $cervantesFound = False;
            $cinaucoChecked = "";
            $cinaucoPercent = 0.0;
            $cinaucoFound = False;
            $dropaheadChecked = "";
            $dropaheadPercent = 0.0;
            $dropaheadFound = False;
            $engranajeChecked = "";
            $engranajePercent = 0.0;
            $engranajeFound = False;
            $mexicotrailChecked = "";
            $mexicotrailPercent = 0.0;
            $mexicotrailFound = False;
            $mspvenezuelaChecked = "";
            $mspvenezuelaPercent = 0.0;
            $mspvenezuelaFound = False;
            $musiclassChecked = "";
            $musiclassPercent = 0.0;
            $musiclassFound = False;
            $proapoyoChecked = "";
            $proapoyoPercent = 0.0;
            $proapoyoFound = False;
            $provenezuelaChecked = "";
            $provenezuelaPercent = 0.0;
            $provenezuelaFound = False;
            $reveurChecked = "";
            $reveurPercent = 0.0;
            $reveurFound = False;
            $rutablockchainChecked = "";
            $rutablockchainPercent = 0.0;
            $rutablockchainFound = False;
            $srcianuroChecked = "";
            $srcianuroPercent = 0.0;
            $srcianuroFound = False;
            $theunionChecked = "";
            $theunionPercent = 0.0;
            $theunionFound = False;
            $trailhispanoChecked = "";
            $trailhispanoPercent = 0.0;
            $trailhispanoFound = False;
            $ubicaritasChecked = "";
            $ubicaritasPercent = 0.0;
            $ubicaritasFound = False;
            $votovzlaChecked = "";
            $votovzlaPercent = 0.0;
            $votovzlaFound = False;
            $wearecodexChecked = "";
            $wearecodexPercent = 0.0;
            $wearecodexFound = False;
            if (isset($_POST['save'])) {
                $amigoosFound = $_SESSION['amigoosFound'];
                $babelproyectFound = $_SESSION['babelproyectFound'];
                $bienvenidaFound = $_SESSION['bienvenidaFound'];
                $codebyteFound = $_SESSION['codebyteFound'];
                $cervantesFound = $_SESSION['cervantesFound'];
                $cinaucoFound = $_SESSION['cinaucoFound'];
                $dropaheadFound = $_SESSION['dropaheadFound'];
                $engranajeFound = $_SESSION['engranajeFound'];
                $mexicotrailFound = $_SESSION['mexicotrailFound'];
                $mspvenezuelaFound = $_SESSION['mspvenezuelaFound'];
                $musiclassFound = $_SESSION['musiclassFound'];
                $proapoyoFound = $_SESSION['proapoyoFound'];
                $provenezuelaFound = $_SESSION['provenezuelaFound'];
                $reveurFound = $_SESSION['reveurFound'];
                $rutablockchainFound = $_SESSION['rutablockchainFound'];
                $srcianuroFound = $_SESSION['srcianuroFound'];
                $theunionFound = $_SESSION['theunionFound'];
                $trailhispanoFound = $_SESSION['trailhispanoFound'];
                $ubicaritasFound = $_SESSION['ubicaritasFound'];
                $votovzlaFound = $_SESSION['votovzlaFound'];
                $wearecodexFound = $_SESSION['wearecodexFound'];
                //amigoos
                if (isset($_POST['activaramigoos']))
                    $amigoosEnabled = 1;
                else
                    $amigoosEnabled = 0;
                if ($amigoosFound == True)
                    updateUserToFollowTable($user, 'amigoos', $_POST['weightamigoos'],  $amigoosEnabled, $mysqli);
                else
                    addUserToFollowTable($user, $_SESSION['usertouse'], 'amigoos', $_POST['weightamigoos'], $amigoosEnabled, $mysqli);
                //babelproyect
                if (isset($_POST['activarbabelproyect']))
                    $babelproyectEnabled = 1;
                else
                    $babelproyectEnabled = 0;
                if ($babelproyectFound == True)
                    updateUserToFollowTable($user, 'babelproyect', $_POST['weightbabelproyect'],  $babelproyectEnabled, $mysqli);
                else
                    addUserToFollowTable($user, $_SESSION['usertouse'], 'babelproyect', $_POST['weightbabelproyect'], $babelproyectEnabled, $mysqli);
                //codebyte
                if (isset($_POST['activarcodebyte']))
                    $codebyteEnabled = 1;
                else
                    $codebyteEnabled = 0;
                if ($codebyteFound == True)
                    updateUserToFollowTable($user, 'codebyte', $_POST['weightcodebyte'],  $codebyteEnabled, $mysqli);
                else
                    addUserToFollowTable($user, $_SESSION['usertouse'], 'codebyte', $_POST['weightcodebyte'], $codebyteEnabled, $mysqli);
                //bienvenida
                if (isset($_POST['activarbienvenida']))
                    $bienvenidaEnabled = 1;
                else
                    $bienvenidaEnabled = 0;
                if ($bienvenidaFound == True)
                    updateUserToFollowTable($user, 'bienvenida', $_POST['weightbienvenida'],  $bienvenidaEnabled, $mysqli);
                else
                    addUserToFollowTable($user, $_SESSION['usertouse'], 'bienvenida', $_POST['weightbienvenida'], $bienvenidaEnabled, $mysqli);
                //cervantes
                if (isset($_POST['activarcervantes']))
                    $cervantesEnabled = 1;
                else
                    $cervantesEnabled = 0;
                if ($cervantesFound == True)
                    updateUserToFollowTable($user, 'cervantes', $_POST['weightcervantes'],  $cervantesEnabled, $mysqli);
                else
                    addUserToFollowTable($user, $_SESSION['usertouse'], 'cervantes', $_POST['weightcervantes'], $cervantesEnabled, $mysqli);
                //cinauco
                if (isset($_POST['activarcinauco']))
                    $cinaucoEnabled = 1;
                else
                    $cinaucoEnabled = 0;
                if ($cinaucoFound == True)
                    updateUserToFollowTable($user, 'cinauco', $_POST['weightcinauco'],  $cinaucoEnabled, $mysqli);
                else
                    addUserToFollowTable($user, $_SESSION['usertouse'], 'cinauco', $_POST['weightcinauco'], $cinaucoEnabled, $mysqli);
                //dropahead
                if (isset($_POST['activardropahead']))
                    $dropaheadEnabled = 1;
                else
                    $dropaheadEnabled = 0;
                if ($dropaheadFound == True)
                    updateUserToFollowTable($user, 'dropahead', $_POST['weightdropahead'],  $dropaheadEnabled, $mysqli);
                else
                    addUserToFollowTable($user, $_SESSION['usertouse'], 'dropahead', $_POST['weightdropahead'], $dropaheadEnabled, $mysqli);
                //engranaje
                if (isset($_POST['activarengranaje']))
                    $engranajeEnabled = 1;
                else
                    $engranajeEnabled = 0;
                if ($engranajeFound == True)
                    updateUserToFollowTable($user, 'engranaje', $_POST['weightengranaje'],  $engranajeEnabled, $mysqli);
                else
                    addUserToFollowTable($user, $_SESSION['usertouse'], 'engranaje', $_POST['weightengranaje'], $engranajeEnabled, $mysqli);
                //mexico-trail
                if (isset($_POST['activarmexicotrail']))
                    $mexicotrailEnabled = 1;
                else
                    $mexicotrailEnabled = 0;
                if ($mexicotrailFound == True)
                    updateUserToFollowTable($user, 'mexico-trail', $_POST['weightmexicotrail'],  $mexicotrailEnabled, $mysqli);
                else
                    addUserToFollowTable($user, $_SESSION['usertouse'], 'mexico-trail', $_POST['weightmexicotrail'], $mexicotrailEnabled, $mysqli);
                //mspvenezuela
                if (isset($_POST['activarmspvenezuela']))
                    $mspvenezuelaEnabled = 1;
                else
                    $mspvenezuelaEnabled = 0;
                if ($mspvenezuelaFound == True)
                    updateUserToFollowTable($user, 'msp-venezuela', $_POST['weightmspvenezuela'],  $mspvenezuelaEnabled, $mysqli);
                else
                    addUserToFollowTable($user, $_SESSION['usertouse'], 'msp-venezuela', $_POST['weightmspvenezuela'], $mspvenezuelaEnabled, $mysqli);
                //musiclass
                if (isset($_POST['activarmusiclass']))
                    $musiclassEnabled = 1;
                else
                    $musiclassEnabled = 0;
                if ($musiclassFound == True)
                    updateUserToFollowTable($user, 'musiclass', $_POST['weightmusiclass'],  $musiclassEnabled, $mysqli);
                else
                    addUserToFollowTable($user, $_SESSION['usertouse'], 'musiclass', $_POST['weightmusiclass'], $musiclassEnabled, $mysqli);
                //proapoyo
                if (isset($_POST['activarproapoyo']))
                    $proapoyoEnabled = 1;
                else
                    $proapoyoEnabled = 0;
                if ($proapoyoFound == True)
                    updateUserToFollowTable($user, 'proapoyo', $_POST['weightproapoyo'],  $proapoyoEnabled, $mysqli);
                else
                    addUserToFollowTable($user, $_SESSION['usertouse'], 'proapoyo', $_POST['weightproapoyo'], $proapoyoEnabled, $mysqli);
                //provenezuela
                if (isset($_POST['activarprovenezuela']))
                    $provenezuelaEnabled = 1;
                else
                    $provenezuelaEnabled = 0;
                if ($provenezuelaFound == True)
                    updateUserToFollowTable($user, 'provenezuela', $_POST['weightprovenezuela'],  $provenezuelaEnabled, $mysqli);
                else
                    addUserToFollowTable($user, $_SESSION['usertouse'], 'provenezuela', $_POST['weightprovenezuela'], $provenezuelaEnabled, $mysqli);
                //reveur
                if (isset($_POST['activarreveur']))
                    $reveurEnabled = 1;
                else
                    $reveurEnabled = 0;
                if ($reveurFound == True)
                    updateUserToFollowTable($user, 'reveur', $_POST['weightreveur'],  $reveurEnabled, $mysqli);
                else
                    addUserToFollowTable($user, $_SESSION['usertouse'], 'reveur', $_POST['weightreveur'], $reveurEnabled, $mysqli);
                //rutablockchain
                if (isset($_POST['activarrutablockchain']))
                    $rutablockchainEnabled = 1;
                else
                    $rutablockchainEnabled = 0;
                if ($rutablockchainFound == True)
                    updateUserToFollowTable($user, 'rutablockchain', $_POST['weightrutablockchain'],  $rutablockchainEnabled, $mysqli);
                else
                    addUserToFollowTable($user, $_SESSION['usertouse'], 'rutablockchain', $_POST['weightrutablockchain'], $reveurEnabled, $mysqli);
                //srcianuro
                if (isset($_POST['activarsrcianuro']))
                    $srcianuroEnabled = 1;
                else
                    $srcianuroEnabled = 0;
                if ($srcianuroFound == True)
                    updateUserToFollowTable($user, 'srcianuro', $_POST['weightsrcianuro'],  $srcianuroEnabled, $mysqli);
                else
                    addUserToFollowTable($user, $_SESSION['usertouse'], 'srcianuro', $_POST['weightsrcianuro'], $srcianuroEnabled, $mysqli);
                //theunion
                if (isset($_POST['activartheunion']))
                    $theunionEnabled = 1;
                else
                    $theunionEnabled = 0;
                if ($theunionFound == True)
                    updateUserToFollowTable($user, 'theunion', $_POST['weighttheunion'],  $theunionEnabled, $mysqli);
                else
                    addUserToFollowTable($user, $_SESSION['usertouse'], 'theunion', $_POST['weighttheunion'], $theunionEnabled, $mysqli);
                //trailhispano
                if (isset($_POST['activartrailhispano']))
                    $trailhispanoEnabled = 1;
                else
                    $trailhispanoEnabled = 0;
                if ($trailhispanoFound == True)
                    updateUserToFollowTable($user, 'trailhispano', $_POST['weighttrailhispano'],  $trailhispanoEnabled, $mysqli);
                else
                    addUserToFollowTable($user, $_SESSION['usertouse'], 'trailhispano', $_POST['weighttrailhispano'], $trailhispanoEnabled, $mysqli);
                //ubicaritas
                if (isset($_POST['activarubicaritas']))
                    $ubicaritasEnabled = 1;
                else
                    $ubicaritasEnabled = 0;
                if ($ubicaritasFound == True)
                    updateUserToFollowTable($user, 'ubicaritas', $_POST['weightubicaritas'],  $ubicaritasEnabled, $mysqli);
                else
                    addUserToFollowTable($user, $_SESSION['usertouse'], 'ubicaritas', $_POST['weightubicaritas'], $ubicaritasEnabled, $mysqli);
                //votovzla
                if (isset($_POST['activarvotovzla']))
                    $votovzlaEnabled = 1;
                else
                    $votovzlaEnabled = 0;
                if ($votovzlaFound == True)
                    updateUserToFollowTable($user, 'votovzla', $_POST['weightvotovzla'],  $votovzlaEnabled, $mysqli);
                else
                    addUserToFollowTable($user, $_SESSION['usertouse'], 'votovzla', $_POST['weightvotovzla'], $votovzlaEnabled, $mysqli);
                //wearecodex
                if (isset($_POST['activarwearecodex']))
                    $wearecodexEnabled = 1;
                else
                    $wearecodexEnabled = 0;
                if ($wearecodexFound == True)
                    updateUserToFollowTable($user, 'wearecodex', $_POST['weightwearecodex'],  $wearecodexEnabled, $mysqli);
                else
                    addUserToFollowTable($user, $_SESSION['usertouse'], 'wearecodex', $_POST['weightwearecodex'], $wearecodexEnabled, $mysqli);
                $settingsSaved = True;
            }
            if ($approved == 1) {
                $result = $mysqli->query("SELECT * FROM followtrail WHERE drupalkey = $user->uid");
                if (mysqli_num_rows($result) > 0) {
                    while ($row = mysqli_fetch_assoc($result)) {
                        if ($row["account"] == "amigoos") {
                            $amigoosFound = True;
                            $amigoosEnabled = $row["enabled"];
                            $amigoosPercent = $row["percent"];
                            if ($amigoosEnabled == 1)
                                $amigoosChecked = "checked";
                            else
                                $amigoosChecked = "";
                        } else if ($row["account"] == "babelproyect") {
                            $babelproyectFound = True;
                            $babelproyectEnabled = $row["enabled"];
                            $babelproyectPercent = $row["percent"];
                            if ($babelproyectEnabled == 1)
                                $babelproyectChecked = "checked";
                            else
                                $babelproyectChecked = "";
                        } else if ($row["account"] == "bienvenida") {
                            $bienvenidaFound = True;
                            $bienvenidaEnabled = $row["enabled"];
                            $bienvenidaPercent = $row["percent"];
                            if ($bienvenidaEnabled == 1)
                                $bienvenidaChecked = "checked";
                            else
                                $bienvenidaChecked = "";
                        } else if ($row["account"] == "codebyte") {
                            $codebyteFound = True;
                            $codebyteEnabled = $row["enabled"];
                            $codebytePercent = $row["percent"];
                            if ($codebyteEnabled == 1)
                                $codebyteChecked = "checked";
                            else
                                $codebyteChecked = "";
                        } else if ($row["account"] == "cervantes") {
                            $cervantesFound = True;
                            $cervantesEnabled = $row["enabled"];
                            $cervantesPercent = $row["percent"];
                            if ($cervantesEnabled == 1)
                                $cervantesChecked = "checked";
                            else
                                $cervantesChecked = "";
                        } else if ($row["account"] == "cinauco") {
                            $cinaucoFound = True;
                            $cinaucoEnabled = $row["enabled"];
                            $cinaucoPercent = $row["percent"];
                            if ($cinaucoEnabled == 1)
                                $cinaucoChecked = "checked";
                            else
                                $cinaucoChecked = "";
                        } else if ($row["account"] == "dropahead") {
                            $dropaheadFound = True;
                            $dropaheadEnabled = $row["enabled"];
                            $dropaheadPercent = $row["percent"];
                            if ($dropaheadEnabled == 1)
                                $dropaheadChecked = "checked";
                            else
                                $dropaheadChecked = "";
                        } else if ($row["account"] == "engranaje") {
                            $engranajeFound = True;
                            $engranajeEnabled = $row["enabled"];
                            $engranajePercent = $row["percent"];
                            if ($engranajeEnabled == 1)
                                $engranajeChecked = "checked";
                            else
                                $engranajeChecked = "";
                        } else if ($row["account"] == "mexico-trail") {
                            $mexicotrailFound = True;
                            $mexicotrailEnabled = $row["enabled"];
                            $mexicotrailPercent = $row["percent"];
                            if ($mexicotrailEnabled == 1)
                                $mexicotrailChecked = "checked";
                            else
                                $mexicotrailChecked = "";
                        } else if ($row["account"] == "msp-venezuela") {
                            $mspvenezuelaFound = True;
                            $mspvenezuelaEnabled = $row["enabled"];
                            $mspvenezuelaPercent = $row["percent"];
                            if ($mspvenezuelaEnabled == 1)
                                $mspvenezuelaChecked = "checked";
                            else
                                $mspvenezuelaChecked = "";
                        } else if ($row["account"] == "musiclass") {
                            $musiclassFound = True;
                            $musiclassEnabled = $row["enabled"];
                            $musiclassPercent = $row["percent"];
                            if ($musiclassEnabled == 1)
                                $musiclassChecked = "checked";
                            else
                                $musiclassChecked = "";
                        } else if ($row["account"] == "proapoyo") {
                            $proapoyoFound = True;
                            $proapoyoEnabled = $row["enabled"];
                            $proapoyoPercent = $row["percent"];
                            if ($proapoyoEnabled == 1)
                                $proapoyoChecked = "checked";
                            else
                                $proapoyoChecked = "";
                        } else if ($row["account"] == "provenezuela") {
                            $provenezuelaFound = True;
                            $provenezuelaEnabled = $row["enabled"];
                            $provenezuelaPercent = $row["percent"];
                            if ($provenezuelaEnabled == 1)
                                $provenezuelaChecked = "checked";
                            else
                                $provenezuelaChecked = "";
                        } else if ($row["account"] == "reveur") {
                            $reveurFound = True;
                            $reveurEnabled = $row["enabled"];
                            $reveurPercent = $row["percent"];
                            if ($reveurEnabled == 1)
                                $reveurChecked = "checked";
                            else
                                $reveurChecked = "";
                        } else if ($row["account"] == "rutablockchain") {
                            $rutablockchainFound = True;
                            $rutablockchainEnabled = $row["enabled"];
                            $rutablockchainPercent = $row["percent"];
                            if ($rutablockchainEnabled == 1)
                                $rutablockchainChecked = "checked";
                            else
                                $rutablockchainChecked = "";
                        } else if ($row["account"] == "srcianuro") {
                            $srcianuroFound = True;
                            $srcianuroEnabled = $row["enabled"];
                            $srcianuroPercent = $row["percent"];
                            if ($srcianuroEnabled == 1)
                                $srcianuroChecked = "checked";
                            else
                                $srcianuroChecked = "";
                        } else if ($row["account"] == "theunion") {
                            $theunionFound = True;
                            $theunionEnabled = $row["enabled"];
                            $theunionPercent = $row["percent"];
                            if ($theunionEnabled == 1)
                                $theunionChecked = "checked";
                            else
                                $theunionChecked = "";
                        } else if ($row["account"] == "trailhispano") {
                            $trailhispanoFound = True;
                            $trailhispanoEnabled = $row["enabled"];
                            $trailhispanoPercent = $row["percent"];
                            if ($trailhispanoEnabled == 1)
                                $trailhispanoChecked = "checked";
                            else
                                $trailhispanoChecked = "";
                        } else if ($row["account"] == "ubicaritas") {
                            $ubicaritasFound = True;
                            $ubicaritasEnabled = $row["enabled"];
                            $ubicaritasPercent = $row["percent"];
                            if ($ubicaritasEnabled == 1)
                                $ubicaritasChecked = "checked";
                            else
                                $ubicaritasChecked = "";
                        } else if ($row["account"] == "votovzla") {
                            $votovzlaFound = True;
                            $votovzlaEnabled = $row["enabled"];
                            $votovzlaPercent = $row["percent"];
                            if ($votovzlaEnabled == 1)
                                $votovzlaChecked = "checked";
                            else
                                $votovzlaChecked = "";
                        } else if ($row["account"] == "wearecodex") {
                            $wearecodexFound = True;
                            $wearecodexEnabled = $row["enabled"];
                            $wearecodexPercent = $row["percent"];
                            if ($wearecodexEnabled == 1)
                                $wearecodexChecked = "checked";
                            else
                                $wearecodexChecked = "";
                        }
                    }
                }
                $_SESSION['amigoosFound'] = $amigoosFound;
                $_SESSION['babelproyectFound'] = $babelproyectFound;
                $_SESSION['bienvenidaFound'] = $bienvenidaFound;
                $_SESSION['codebyteFound'] = $codebyteFound;
                $_SESSION['cervantesFound'] = $cervantesFound;
                $_SESSION['cinaucoFound'] = $cinaucoFound;
                $_SESSION['dropaheadFound'] = $dropaheadFound;
                $_SESSION['engranajeFound'] = $engranajeFound;
                $_SESSION['mexicotrailFound'] = $mexicotrailFound;
                $_SESSION['mspvenezuelaFound'] = $mspvenezuelaFound;
                $_SESSION['musiclassFound'] = $musiclassFound;
                $_SESSION['proapoyoFound'] = $proapoyoFound;
                $_SESSION['provenezuelaFound'] = $provenezuelaFound;
                $_SESSION['reveurFound'] = $reveurFound;
                $_SESSION['rutablockchainFound'] = $rutablockchainFound;
                $_SESSION['srcianuroFound'] = $srcianuroFound;
                $_SESSION['theunionFound'] = $theunionFound;
                $_SESSION['trailhispanoFound'] = $trailhispanoFound;
                $_SESSION['ubicaritasFound'] = $ubicaritasFound;
                $_SESSION['votovzlaFound'] = $votovzlaFound;
                $_SESSION['wearecodexFound'] = $wearecodexFound;
                if ($settingsSaved == True)
                    echo $settingsSavedString;
                echo "$percentNote
					<form method='post'>
					<table>
					<thead> 
						<tr> 
						   $tableHeader
						</tr> 
					</thead> 
					<tbody>
						<tr><td><a href=https://steemit.com/@amigoos>@amigoos</a></td><td><input type='checkbox' name='activaramigoos' value='activaramigoos' id='activaramigoos' $amigoosChecked></td><td><input name='weightamigoos' type='text'/ value=$amigoosPercent>%</td></tr>
						<tr><td><a href=https://steemit.com/@babelproyect>@babelproyect</a></td><td><input type='checkbox' name='activarbabelproyect' value='activarbabelproyect' id='activarbabelproyect' $babelproyectChecked></td><td><input name='weightbabelproyect' type='text'/ value=$babelproyectPercent>%</td></tr>
						<tr><td><a href=https://steemit.com/@bienvenida>@bienvenida</a></td><td><input type='checkbox' name='activarbienvenida' value='activarbienvenida' id='activarbienvenida' $bienvenidaChecked></td><td><input name='weightbienvenida' type='text'/ value=$bienvenidaPercent>%</td></tr>
						<tr><td><a href=https://steemit.com/@codebyte>@codebyte</a></td><td><input type='checkbox' name='activarcodebyte' value='activarcodebyte' id='activarcodebyte' $codebyteChecked></td><td><input name='weightcodebyte' type='text'/ value=$codebytePercent>%</td></tr>
						<tr><td><a href=https://steemit.com/@cervantes>@cervantes</a></td><td><input type='checkbox' name='activarcervantes' value='activarcervantes' id='activarcervantes' $cervantesChecked></td><td><input name='weightcervantes' type='text'/ value=$cervantesPercent>%</td></tr>
						<tr><td><a href=https://steemit.com/@cinauco>@cinauco</a></td><td><input type='checkbox' name='activarcinauco' value='activarcinauco' id='activarcinauco' $cinaucoChecked></td><td><input name='weightcinauco' type='text'/ value=$cinaucoPercent>%</td></tr>
						<tr><td><a href=https://steemit.com/@dropahead>@dropahead</a></td><td><input type='checkbox' name='activardropahead' value='activardropahead' id='activardropahead' $dropaheadChecked></td><td><input name='weightdropahead' type='text'/ value=$dropaheadPercent>%</td></tr>
						<tr><td><a href=https://steemit.com/@engranaje>@engranaje</a></td><td><input type='checkbox' name='activarengranaje' value='activarengranaje' id='activarengranaje' $engranajeChecked></td><td><input name='weightengranaje' type='text'/ value=$engranajePercent>%</td></tr>
						<tr><td><a href=https://steemit.com/@mexico-trail>@mexico-trail</a></td><td><input type='checkbox' name='activarmexicotrail' value='activarmexicotrail' id='activarmexicotrail' $mexicotrailChecked></td><td><input name='weightmexicotrail' type='text'/ value=$mexicotrailPercent>%</td></tr>
						<tr><td><a href=https://steemit.com/@msp-venezuela>@msp-venezuela</a></td><td><input type='checkbox' name='activarmspvenezuela' value='activarmspvenezuela' id='activarmspvenezuela' $mspvenezuelaChecked></td><td><input name='weightmspvenezuela' type='text'/ value=$mspvenezuelaPercent>%</td></tr>
						<tr><td><a href=https://steemit.com/@musiclass>@musiclass</a></td><td><input type='checkbox' name='activarmusiclass' value='activarmusiclass' id='activarmusiclass' $musiclassChecked></td><td><input name='weightmusiclass' type='text'/ value=$musiclassPercent>%</td></tr>
						<tr><td><a href=https://steemit.com/@proapoyo>@proapoyo</a></td><td><input type='checkbox' name='activarproapoyo' value='activarproapoyo' id='activarproapoyo' $proapoyoChecked></td><td><input name='weightproapoyo' type='text'/ value=$proapoyoPercent>%</td></tr>
						<tr><td><a href=https://steemit.com/@provenezuela>@provenezuela</a></td><td><input type='checkbox' name='activarprovenezuela' value='activarprovenezuela' id='activarprovenezuela' $provenezuelaChecked></td><td><input name='weightprovenezuela' type='text'/ value=$provenezuelaPercent>%</td></tr>
						<tr><td><a href=https://steemit.com/@reveur>@reveur</a></td><td><input type='checkbox' name='activarreveur' value='activarreveur' id='activarreveur' $reveurChecked></td><td><input name='weightreveur' type='text'/ value=$reveurPercent>%</td></tr>
						<tr><td><a href=https://steemit.com/@rutablockchain>@rutablockchain</a></td><td><input type='checkbox' name='activarrutablockchain' value='activarrutablockchain' id='activarrutablockchain' $rutablockchainChecked></td><td><input name='weightrutablockchain' type='text'/ value=$rutablockchainPercent>%</td></tr>
						<tr><td><a href=https://steemit.com/@srcianuro>@srcianuro</a></td><td><input type='checkbox' name='activarsrcianuro' value='activarsrcianuro' id='activarsrcianuro' $srcianuroChecked></td><td><input name='weightsrcianuro' type='text'/ value=$srcianuroPercent>%</td></tr>
						<tr><td><a href=https://steemit.com/@theunion>@theunion</a></td><td><input type='checkbox' name='activartheunion' value='activartheunion' id='activartheunion' $theunionChecked></td><td><input name='weighttheunion' type='text'/ value=$theunionPercent>%</td></tr>
						<tr><td><a href=https://steemit.com/@trailhispano>@trailhispano</a></td><td><input type='checkbox' name='activartrailhispano' value='activartrailhispano' id='activartrailhispano' $trailhispanoChecked></td><td><input name='weighttrailhispano' type='text'/ value=$trailhispanoPercent>%</td></tr>
						<tr><td><a href=https://steemit.com/@ubicaritas>@ubicaritas</a></td><td><input type='checkbox' name='activarubicaritas' value='activarubicaritas' id='activarubicaritas' $ubicaritasChecked></td><td><input name='weightubicaritas' type='text'/ value=$ubicaritasPercent>%</td></tr>
						<tr><td><a href=https://steemit.com/@votovzla>@votovzla</a></td><td><input type='checkbox' name='activarvotovzla' value='activarvotovzla' id='activarvotovzla' $votovzlaChecked></td><td><input name='weightvotovzla' type='text'/ value=$votovzlaPercent>%</td></tr>
						<tr><td><a href=https://steemit.com/@wearecodex>@wearecodex</a></td><td><input type='checkbox' name='activarwearecodex' value='activarwearecodex' id='activarwearecodex' $wearecodexChecked></td><td><input name='weightwearecodex' type='text'/ value=$wearecodexPercent>%</td></tr>
					</tbody>
					</table>
					<input name='save' type='submit' value='$saveString' />
					</form>";
            }
        }
    } else {
        echo $notLoggedIn;
    }
}