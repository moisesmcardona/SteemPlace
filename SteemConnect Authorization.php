In this page, you can associate your Steemit account with Steem.Place by using SteemConnect. This will allow you to use most of this site functions.</a></br></br>
<?php
global $user;
$mysqlserver = "localhost";
$mysqlusername = "username";
$mysqlpassword = "password";
$mysqldatabase = "table";
if(user_is_logged_in()){
	if(isset($_POST['save'])){
		$mysql=mysqli_connect($mysqlserver, $mysqlusername, $mysqlpassword, $mysqldatabase);
		$account=$_POST['account'];
		$recordfound = $_SESSION['recordfound'];
		$ok = false;
		$checkUser = exec("python3-old /var/www/steemapi-python/checkSteemPlace.py $account");
		if ($checkUser == "True")
			$approved=1;
		else
			$approved=0;
		$recordfound = $_SESSION['recordfound'];
		if ($recordfound==0){  
			$sql="INSERT INTO users2 (drupalkey, username, approved) VALUES ($user->uid, '$account', '$approved')";
			mysqli_query($mysql, $sql);
			$recordfound=1;
		}
		else{
			$sql="UPDATE users2 SET username='$account', approved='$approved' WHERE drupalkey = $user->uid";
			mysqli_query($mysql, $sql);
			$recordfound=1;
		}
	}
	else{
		$mysql=mysqli_connect($mysqlserver, $mysqlusername, $mysqlpassword, $mysqldatabase);
		$sql="SELECT * FROM users2 WHERE drupalkey = $user->uid";
		$result=mysqli_query($mysql, $sql);
		if(mysqli_num_rows($result) > 0){
			while($row = mysqli_fetch_assoc($result)) {
				$recordfound=1;
				$account=$row["username"];
				$approved=$row["approved"];
			}
		}
		else{
          $recordfound=0;	 
		}
		$_SESSION['recordfound'] = $recordfound;
	}	
	if ($recordfound==0){
		echo 	"<form method='post'>
				Step 1: Please enter your Steem account name:</br>
				Account: @<input name='account' type='text'/></br></br>
				Step 2: Press the Save button:</br>
				<input name='save' type='submit' value='Save' /></br>
				</form>";
	}
	else{
		$checkUser = exec("python3-old /var/www/steemapi-python/checkSteemPlace.py $account");
		if ($checkUser == "True")
			$approved=1;
		else
			$approved=0;
		echo 	"<form method='post'>
				Step 1: Please enter your Steem account name:</br>
				Account: @<input name='account' type='text' value='$account'/></br></br>
				Step 2: Press the Save button if you changed your Steem account name:</br>
				<input name='save' type='submit' value='Save' /></br>
				</form></br>";
		if ($approved==0){
			echo "Step 3: Please associate your Steem account with Steem.Place by <a href=https://v2.steemconnect.com/authorize/@steem.place?redirect_uri=https://steem.place/en/Configure2>clicking here</a>";
			$sql="UPDATE users2 SET username='$account', approved='$approved' WHERE drupalkey = $user->uid";
			mysqli_query($mysql, $sql);
		}
		else{
			echo "Step 3: You have approved Steem.Place with your Steem Account!</br></br>";
			$sql="UPDATE users2 SET username='$account', approved='$approved' WHERE drupalkey = $user->uid";
			mysqli_query($mysql, $sql);
			echo "To remove the association from your account, <a href=https://v2.steemconnect.com/revoke/@steem.place target=_blank> please click here. Then, refresh this page to complete the association removal.</a></br></br>";
		}
	}
}
else{
echo "You must be logged in in order to configure your account. If you don't have an account, please register.</br></br>";
}
?>