<?php 
	
session_start();
include("framework/framework.class.php");

/* hier wird PW geändert*/
if(!empty($_POST) AND !empty($_SESSION['acc'])){
	
	$name = $_SESSION['acc'];

	// altes pw
	$old = mysql_real_escape_string($_POST['old']);
	
	$query = mysql_query("SELECT Salt FROM Players WHERE Name = '$name'");
	$result = mysql_num_rows($query);
	if($result >= 1){
		while($row = mysql_fetch_assoc($query)){
			$salt = $row['Salt'];
		}
	}else{
		$salt = "";
	}
	$first = hash( "sha512", hash( "sha512", $old));
	
	$query = mysql_query("SELECT * FROM players WHERE Name = '$name' AND Passwort='$first'") or die(mysql_error());
	$result = mysql_num_rows($query);
	if($result >= 1){
		
		// Wenn old stimmt
		
		// neues pw
		$new = mysql_real_escape_string($_POST['new']);
		$new2 = mysql_real_escape_string($_POST['new2']);
		
		if($new == $new2){
		
			$debug = false;
			
			$pwnew = $new;
			$pwnew2 = hash("sha512",hash( "sha512", $pwnew));
			
			if($debug == true){
			
				echo $old . "<br>" . $first . "<br>";
				echo $salt . "<br>" . $new . "<br>";
				echo $pwnew . "<br>" . $pwnew2;
				
			}else{
			
				$query = mysql_query("UPDATE players SET Passwort = '$pwnew2' WHERE Name = '$name'") or die ("MySQL-Error: " . mysql_error());
				session_destroy();
				$host = $_SERVER['HTTP_HOST'];
				$uri = rtrim(dirname($_SERVER['PHP_SELF']), '/\\');
				header("Location: http://$host$uri/index.php");
				exit;
				
			}
		}else{
			$host = $_SERVER['HTTP_HOST'];
			$uri = rtrim(dirname($_SERVER['PHP_SELF']), '/\\');
			header("Location: http://$host$uri/main.php");
			exit;
		}
		
		
	}else{
		$host = $_SERVER['HTTP_HOST'];
		$uri = rtrim(dirname($_SERVER['PHP_SELF']), '/\\');
		header("Location: http://$host$uri/main.php");
		exit;
	}
}else{
	// Weiterleitung								
	$host = $_SERVER['HTTP_HOST'];
	$uri = rtrim(dirname($_SERVER['PHP_SELF']), '/\\');
	header("Location: http://$host$uri/main.php");
	exit;
}	
	
?>