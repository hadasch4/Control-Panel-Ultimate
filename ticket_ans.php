<?php 
	
session_start();
include("framework/framework.class.php");

/* hier wird neuer post erstellt*/
if(!empty($_POST)){
	date_default_timezone_set('Europe/Berlin');
	$date = date('j F Y H:i:s');
	$msg = mysql_real_escape_string($_POST['msg']);
	$name = $_SESSION["acc"];
	$id = mysql_real_escape_string($_POST["id"]);
	$query = "INSERT INTO cp_ticket_ans(username,msg,date,ticket_id) VALUES('$name','$msg','$date','$id')";
	$next = mysql_query ($query) or die ("MySQL-Error: " . mysql_error());
	
	$query2 = "UPDATE `cp_ticket` SET `isclosed`= '1' WHERE ID = '$id'";
	$next2 = mysql_query ($query2) or die ("MySQL-Error: " . mysql_error());
	
	// Weiterleitung								
	$host = $_SERVER['HTTP_HOST'];
	$uri = rtrim(dirname($_SERVER['PHP_SELF']), '/\\');
	header("Location: http://$host$uri/main.php?site=admint");
	exit;
}else{
	// Weiterleitung								
	$host = $_SERVER['HTTP_HOST'];
	$uri = rtrim(dirname($_SERVER['PHP_SELF']), '/\\');
	header("Location: http://$host$uri/main.php");
	exit;
}	
	
?>