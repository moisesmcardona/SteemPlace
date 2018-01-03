<style>
#elements {
  width:90%;
-webkit-box-sizing: border-box; /* Safari/Chrome, other WebKit */
-moz-box-sizing: border-box;    /* Firefox, other Gecko */
box-sizing: border-box;         /* Opera/IE 8+ */
}
#buttons {
width:45%;
}
</style>

<?php
header('X-XSS-Protection:0');
global $user;
$title="Title";
$body="Your post, using Markdown and HTML";
$tags="tag1,tag2,tag3,tag4,tag5";
$url="your-post-url";
	$pk="Private Posting Key";
	$username="your steem username without @";
	echo "You haven't configured your account. You may use this page but you'll be required to enter your account username and Private Posting Key each time you write a post.</br></br>";
	if(isset($_POST['preview'])){
	$username=$_POST['username'];
	$title=$_POST['title'];
	$body=$_POST['body'];
	$tags=$_POST['tags'];
	$url=$_POST['url'];
	$pk=$_POST['pk'];
}
if(isset($_POST['posttosteem'])){
	$username=$_POST['username'];
	$title=$_POST['title'];
	$body=$_POST['body'];
	$tags=$_POST['tags'];
	$url=$_POST['url'];
	$pk=$_POST['pk'];
}
echo "<form method='post'>
<input  id='elements' name='username' type='text' value='".$username."'/></br>
<input id='elements' name='title' type='text' value='".$title."' /></br>
<textarea  name='body' id='elements' name='body' rows='20'>".$body."</textarea></br>
<input  id='elements' name='tags' type='text' value='".$tags."'/></br>
<input  id='elements' name='url' type='text' value='".$url."'/></br>
<input  id='elements' name='pk' type='text' value='".$pk."'/></br>
<input id='buttons' name='preview' type='submit' value='Preview' />   <input id='buttons' name='posttosteem' type='submit' value='Post' /></br>
</form>";
if(isset($_POST['preview'])){
	require_once 'Michelf/MarkdownExtra.inc.php';
	setlocale(LC_ALL, 'en_US.utf8');
	putenv('LC_ALL=en_US.utf8');
	$body=$_POST['body'];
	//appends footer to post body
	$body .= "<br> <hr>This post has been posted using the [Post Publishing Tool of https://steem.place](https://steem.place/en/Publish)";
	echo "</br><h1><b>Preview</b></h1>";
	echo  \Michelf\MarkdownExtra::defaultTransform("$body");
}
if(isset($_POST['posttosteem'])){
	setlocale(LC_ALL, 'en_US.utf8');
	putenv('LC_ALL=en_US.utf8');
	//appends footer to post body
	$body .= "<br> <hr>This post has been posted using the [Post Publishing Tool of https://steem.place](https://steem.place/en/Publish)";
	$body = str_replace("\"", "\\\"", $body);
	$body = str_replace("`", "\`", $body);
	$posted = exec("python3 /var/www/steemapi-python/postToSteem.py \"".$title."\" \"".$body."\" \"".$username."\" \"".$url."\" \"".$tags."\" \"".$pk."\"");
	echo "</br></br></br>";
	if ($posted=="ok")
	{
		echo "<b>Your post has been posted successfully. <a href=https://steemit.com/tag/@".$username."/".$url.">Click here to see your newly published post</a></b>";
	}	
	else
	{
		echo "<b>An error occurred when posting your post</b>";
	}
}
?>
<hr>
©2018 Moises Cardona.