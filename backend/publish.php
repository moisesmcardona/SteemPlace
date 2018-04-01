<script>
    function populateUrlField()
    {
        var url = document.getElementsByName("title")[0].value;
        var regex1 = new RegExp('([ \/\\\\`;&."\'!¡@#$%^*()×÷áéíóúñµö®©¿?²³¤€¼½¾‘’¥])', 'g');
        var regex2 = new RegExp('([\\[\\]])', 'g');
        url = url.replace(regex1, "-");
        url = url.replace(regex2, "");
        document.getElementsByName("url")[0].value = url.toLowerCase();
    }
</script>
<?php
require_once 'config.php';
require_once 'functions.php';
//This is the code for the Post Publish section of Steem.Place
function publish($user, $language){
    global $mysqli, $sp_ppk;
    echo "<style>
         #elements {
            width:90%;
            -webkit-box-sizing: border-box; /* Safari/Chrome, other WebKit */
            -moz-box-sizing: border-box;    /* Firefox, other Gecko */
            box-sizing: border-box;         /* Opera/IE 8+ */
         }
         #buttons {
            width:45%;
         }
         </style>";
    if ($language == "en"){
        $title="Title";
        $body="Your post, using Markdown and HTML";
        $tags="tag1,tag2,tag3,tag4,tag5";
        $url="your-post-url";
        $_SESSION['usertouse']="your steem username without @";
        $_SESSION['pk']="Private Posting Key";
        $accountNotConfigured = "You haven't configured your account. You may use this page but you'll be required to enter your account username and Private Posting Key each time you write a post.</br></br>";
        $previewText = "Preview";
        $postButton = "Post";
        $postFooter = "<br><hr>This post has been posted using [Steem.Place](https://steem.place/en/Publish)";
        $postPublished = "<b>Your post has been posted successfully. <a href=https://steemit.com/tag/@%s/%s>Click here to see your newly published post</a></b>";
        $errorOccurred = "<b>An error occurred when posting your post</b>";
    }
    else {
        $title="Título";
        $body="El post. Puedes usar Markdown y HTML";
        $tags="tag1,tag2,tag3,tag4,tag5";
        $url="direccion-url";
        $_SESSION['usertouse']="Tu nombre de usuario sin el @";
        $_SESSION['pk']="Posting Key privada";
        $accountNotConfigured = "No has configurado tu cuenta. Puedes usar esta página pero tendrás que escribir tu nombre de usuario y posting key privada.</br></br>";
        $previewText = "Vistazo";
        $postButton = "Publicar";
        $postFooter = "<br><hr>Este post ha sido escrito utilizando [Steem.Place](https://steem.place/es/Publicar)";
        $postPublished = "<b>Tu post ha sido publicado exitósamente. <a href=https://steemit.com/tag/@%s/%s>Haz click aquí para verlo.</a></b>";
        $errorOccurred = "<b>An error occurred when posting your post</b>";
    }
    $_SESSION['IsLoggedIn']=0;
    $_SESSION['UserOK']=0;
    if(user_is_logged_in()){
        $_SESSION['IsLoggedIn']=1;
        $result=$mysqli->query("SELECT * FROM users2 WHERE drupalkey = $user->uid");
        if(mysqli_num_rows($result) > 0){
            while($row = mysqli_fetch_assoc($result)) {
                $_SESSION['usertouse']=$row["username"];
                $_SESSION['UserOK']=1;
            }
        }
        if($_SESSION['UserOK']==1)
            $_SESSION['UserOK'] = checkUser($user, $_SESSION['IsLoggedIn'], $mysqli);
    }
    if(isset($_POST['preview'])){
        if($_SESSION['IsLoggedIn']==0 || $_SESSION['UserOK']==0){
            $_SESSION['usertouse']=$_POST['username'];
            $_SESSION['pk']=$_POST['pk'];
        }
        $title= htmlspecialchars($_POST['title'], ENT_QUOTES);
        $body=$_POST['body'];
        $tags=$_POST['tags'];
        $url=$_POST['url'];
        $url = str_replace("\"", "-", $url);
        $url = str_replace("`", "-", $url);
        $url = str_replace(";", "-", $url);
        $url = str_replace("&", "-", $url);
        $url = str_replace(" ", "-", $url);
        $url = str_replace(".", "-", $url);
        $url = str_replace("[", "", $url);
        $url = str_replace("]", "", $url);
        $url = strtolower($url);
        $tags = str_replace("\"", ",", $tags);
        $tags = str_replace("`", ",", $tags);
        $tags = str_replace(";", ",", $tags);
        $tags = str_replace("&", ",", $tags);
        $tags = str_replace(" ", ",", $tags);
        $tags = strtolower($tags);
    }
    if(isset($_POST['posttosteem'])){
        if($_SESSION['IsLoggedIn']==0 || $_SESSION['UserOK']==0){
            $_SESSION['usertouse']=$_POST['username'];
            $_SESSION['pk']=$_POST['pk'];
        }
        $title= htmlspecialchars($_POST['title'], ENT_QUOTES);
        $body=$_POST['body'];
        $tags=$_POST['tags'];
        $url=$_POST['url'];
        $url = str_replace("\"", "-", $url);
        $url = str_replace("`", "-", $url);
        $url = str_replace(";", "-", $url);
        $url = str_replace("&", "-", $url);
        $url = str_replace(" ", "-", $url);
        $url = str_replace(".", "-", $url);
        $url = str_replace("[", "", $url);
        $url = str_replace("]", "", $url);
        $url = strtolower($url);
        $tags = str_replace("\"", ",", $tags);
        $tags = str_replace("`", ",", $tags);
        $tags = str_replace(";", ",", $tags);
        $tags = str_replace("&", ",", $tags);
        $tags = str_replace(" ", ",", $tags);
        $tags = strtolower($tags);
    }
    if ($_SESSION['IsLoggedIn']==1 && $_SESSION['UserOK'] == 0)
        echo $accountNotConfigured;
    echo    "<form name='publishform' method='post'>";
    if ($_SESSION['IsLoggedIn']==0 || $_SESSION['UserOK'] == 0)
        echo "<input  id='elements' name='username' type='text' value='".$_SESSION['usertouse']."'/></br>";
    echo     "<input id='elements' name='title' type='text' value='".$title."' onkeyup='populateUrlField()'/></br>
              <textarea id='elements' name='body' rows='20'>".$body."</textarea></br>
              <input  id='elements' name='tags' type='text' value='".$tags."'/></br>
              <input  id='elements' name='url' type='text' value='".$url."'/></br>";
    if ($_SESSION['IsLoggedIn']==0 || $_SESSION['UserOK'] == 0)
        echo "<input  id='elements' name='pk' type='text' value='".$_SESSION['pk']."'/></br>";
    echo "<input id='buttons' name='preview' type='submit' value='$previewText' />   <input id='buttons' name='posttosteem' type='submit' value='$postButton' /></br>
          </form>";
    if(isset($_POST['preview'])){
        require_once 'Michelf/MarkdownExtra.inc.php';
        setlocale(LC_ALL, 'en_US.utf8');
        putenv('LC_ALL=en_US.utf8');
        $body=$_POST['body'];
        $body .= $postFooter;
        echo "</br><h1><b>$previewText</b></h1>";
        echo  \Michelf\MarkdownExtra::defaultTransform("$body");
    }
    if(isset($_POST['posttosteem'])){
        setlocale(LC_ALL, 'en_US.utf8');
        putenv('LC_ALL=en_US.utf8');
        $body .= $postFooter;
        $title = $_POST['title'];
        $title = str_replace("\"", "\\\"", $title);
        $title = str_replace("`", "\`", $title);
        $userToUse = $_SESSION['usertouse'];
        $userToUse = str_replace("\"", "_", $userToUse);
        $userToUse = str_replace("`", "_", $userToUse);
        $userToUse = str_replace(";", "_", $userToUse);
        $userToUse = str_replace("&", "_", $userToUse);
        $userToUse = str_replace(" ", "_", $userToUse);
        if ($_SESSION['UserOK'] == 1) {
            $sp_ppk = str_replace("\"", "\\\"", $sp_ppk);
            $sp_ppk = str_replace("`", "\`", $sp_ppk);
            $sp_ppk = str_replace(" ", "-", $sp_ppk);
            $data = array('title' => $title, 'body' => $body, 'author' => $userToUse, 'permlink' => $url, 'tags' => $tags, 'pk' => $sp_ppk);
            $options = array(
                'http' => array(
                    'header'  => "Content-type: application/x-www-form-urlencoded\r\n",
                    'method'  => 'POST',
                    'content' => http_build_query($data)
                )
            );
            $context  = stream_context_create($options);
            $posted = file_get_contents('https://api.steem.place/postToSteem/', false, $context);
        }
        else {
            $ppk =  $_SESSION['pk'];
            $ppk = str_replace("\"", "\\\"", $ppk);
            $ppk = str_replace("`", "\`", $ppk);
            $ppk = str_replace(" ", "-", $ppk);
            $data = array('title' => $title, 'body' => $body, 'author' => $userToUse, 'permlink' => $url, 'tags' => $tags, 'pk' => $ppk);
            $options = array(
                'http' => array(
                    'header'  => "Content-type: application/x-www-form-urlencoded\r\n",
                    'method'  => 'POST',
                    'content' => http_build_query($data)
                )
            );
            $context  = stream_context_create($options);
            $posted = file_get_contents('https://api.steem.place/postToSteem/', false, $context);
        }
        echo "</br></br></br>";
        if ($posted=="ok")
        {
            insertPublishedPost($_SESSION['usertouse'], $url, $mysqli);
            echo sprintf($postPublished, $_SESSION['usertouse'], $url);
        }
        else
        {
            echo $errorOccurred;
        }
    }
}




