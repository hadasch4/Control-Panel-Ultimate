<?php 
	
session_start();
include("framework/framework.class.php");

/* hier wird PW geändert*/
if(!empty($_POST) AND !empty($_SESSION['acc'])){
	
	$name = $_SESSION['acc'];
	$mon_static = mysql_real_escape_string($_POST['money']);

	$new = mysql_real_escape_string($_POST['new']);
	
	$query = mysql_query("SELECT Name FROM userdata WHERE Name = '$new'")or die ("MySQL-Error: " . mysql_error());
	$result = mysql_num_rows($query);
	
	if($result == 0){
		// Wenn Name nicht vergeben, dann Geld checken
		$query_m = mysql_query("SELECT Bankgeld FROM userdata WHERE Name = '$name'")or die ("MySQL-Error: " . mysql_error());
		while($row = mysql_fetch_assoc($query_m)){
			$money = $row['Bankgeld'];
		}
		
		if($money >= $mon_static){
			
			// bankgeld updaten
			$new_money = $money - $mon_static;
			$query_um = mysql_query("UPDATE userdata SET Bankgeld = '$new_money' WHERE Name = '$name'") or die ("MySQL-Error: " . mysql_error());
			
			// transaktion erstellen
			date_default_timezone_set('Europe/Berlin');
			$date = date('j F Y H:i:s');
			
			$betreff = "Nickchange ({$new})";
			
			$query_tr = "INSERT INTO cp_bank(absender,empfanger,betrag,betreff,date) VALUES('$name','Server','$mon_static','$betreff','$date')";
			$next = mysql_query ($query_tr) or die ("MySQL-Error: " . mysql_error());
			
			// name in tabellen ändern
			$query_players = mysql_query("UPDATE Players SET Name = '$new' WHERE Name = '$name'") or die ("MySQL-Error: " . mysql_error());
			$query_userdata = mysql_query("UPDATE userdata SET Name = '$new' WHERE Name = '$name'") or die ("MySQL-Error: " . mysql_error());
			$query_cp_ticket_ans = mysql_query("UPDATE cp_ticket_ans SET username = '$new' WHERE username = '$name'") or die ("MySQL-Error: " . mysql_error());
			$query_cp_ticket = mysql_query("UPDATE cp_ticket SET username = '$new' WHERE username = '$name'") or die ("MySQL-Error: " . mysql_error());
			$query_changelog = mysql_query("UPDATE cp_changelog SET user = '$new' WHERE user = '$name'") or die ("MySQL-Error: " . mysql_error());
			$query_cp_bank = mysql_query("UPDATE cp_bank SET absender = '$new' WHERE absender = '$name'") or die ("MySQL-Error: " . mysql_error());
			$query_cp_bank2 = mysql_query("UPDATE cp_bank SET empfanger = '$new' WHERE empfanger = '$name'") or die ("MySQL-Error: " . mysql_error());
			
			// weiterleitung login page
			session_destroy();
			$host = $_SERVER['HTTP_HOST'];
			$uri = rtrim(dirname($_SERVER['PHP_SELF']), '/\\');
			header("Location: http://$host$uri/index.php");
			exit;
			
		}else{
			$host = $_SERVER['HTTP_HOST'];
			$uri = rtrim(dirname($_SERVER['PHP_SELF']), '/\\');
			header("Location: http://$host$uri/main.php?site=acc");
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