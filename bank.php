<?php 
	
session_start();
include("framework/framework.class.php");

/* hier wird neuer post erstellt*/
if(!empty($_POST)){
	
	if(mysql_real_escape_string($_POST["empfanger"]) == $_SESSION["acc"]){
	
		// Weiterleitung								
		$host = $_SERVER['HTTP_HOST'];
		$uri = rtrim(dirname($_SERVER['PHP_SELF']), '/\\');
		header("Location: http://$host$uri/main.php?site=banku");
		exit;
	
	}else{

		date_default_timezone_set('Europe/Berlin');
		$date = date('j F Y H:i:s');
		$msg = mysql_real_escape_string($_POST['betreff']);
		$name = $_SESSION["acc"];
		$empf = mysql_real_escape_string($_POST["empfanger"]);
		$betrag = mysql_real_escape_string($_POST["money"]);
		
		$mquery = mysql_query("SELECT Bankgeld FROM userdata WHERE Name = '$name'");
		while($row = mysql_fetch_assoc($mquery)){
			$user_money = $row["Bankgeld"];
		}
		
		if($user_money < $betrag){
		
			// Weiterleitung								
			$host = $_SERVER['HTTP_HOST'];
			$uri = rtrim(dirname($_SERVER['PHP_SELF']), '/\\');
			header("Location: http://$host$uri/main.php?site=banku");
			exit;
			
		}else{
		
			// Geld abziehen und überweisen
			$mquery2 = mysql_query("SELECT Bankgeld FROM userdata WHERE Name = '$empf'");
			while($row = mysql_fetch_assoc($mquery2)){
				$user_money2 = $row["Bankgeld"];
			}
			
			$user_money2 = $user_money2 + $betrag;
			$user_money = $user_money - $betrag;
			
			$query_u = mysql_query("UPDATE userdata SET Bankgeld = '$user_money2' WHERE Name = '$empf'");
			$query_u2 = mysql_query("UPDATE userdata SET Bankgeld = '$user_money' WHERE Name = '$name'");
		
			$query = "INSERT INTO cp_bank(absender,empfanger,betrag,betreff,date) VALUES('$name','$empf','$betrag','$msg','$date')";
			$next = mysql_query ($query) or die ("MySQL-Error: " . mysql_error());
			
			// Weiterleitung								
			$host = $_SERVER['HTTP_HOST'];
			$uri = rtrim(dirname($_SERVER['PHP_SELF']), '/\\');
			header("Location: http://$host$uri/main.php?site=bankt");
			exit;
		
		}
		
	}
}else{
	// Weiterleitung								
	$host = $_SERVER['HTTP_HOST'];
	$uri = rtrim(dirname($_SERVER['PHP_SELF']), '/\\');
	header("Location: http://$host$uri/main.php");
	exit;
}	
	
?>