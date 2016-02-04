<?php 
	
session_start();
include("framework/framework.class.php");

/* hier wird neuer post erstellt*/
if(!empty($_POST)){
	date_default_timezone_set('Europe/Berlin');
	$date = date('j F Y H:i:s');
	$msg = mysql_real_escape_string($_POST['msg']);
	$betreff = mysql_real_escape_string($_POST['head']);
	$name = $_SESSION["acc"];
	$query = "INSERT INTO cp_changelog(Date,betreff,msg,user) VALUES('$date','$betreff','$msg','$name')";
	$next = mysql_query ($query) or die ("MySQL-Error: " . mysql_error());
	// Weiterleitung								
	$host = $_SERVER['HTTP_HOST'];
	$uri = rtrim(dirname($_SERVER['PHP_SELF']), '/\\');
	header("Location: http://$host$uri/main.php?site=changelog");
	exit;
}else{
	// Weiterleitung								
	$host = $_SERVER['HTTP_HOST'];
	$uri = rtrim(dirname($_SERVER['PHP_SELF']), '/\\');
	header("Location: http://$host$uri/main.php");
	exit;
}	
	
?>
