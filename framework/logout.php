<?php
session_start();
error_reporting(0);
session_destroy();
// Weiterleitung
$host = $_SERVER['HTTP_HOST'];
$uri = rtrim(dirname($_SERVER['PHP_SELF']), '/\\');
header("Location: ../index.php");
exit;
?>
