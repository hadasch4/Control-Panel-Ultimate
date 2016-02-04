<html>
<head>
	<link href="../bootstrap/css/bootstrap.css" rel="stylesheet">
</head>
<body>
<?php

// GTA ist 6000x6000

// Faktor 4,2857
// Test 0,0

$x = $_GET["x"]/4.2857;
$y = $_GET["y"]/4.2857;

$mitte_x = 700;
$mitte_y = 700;


if($x+$mitte_x < 0 OR $x+$mitte_x > 1400 OR $y+$mitte_y < -1400 OR $y+$mitte_y > 1400){
	echo "<div class='container' style='margin-top:100px;'><div class='alert alert-warning' role='alert'>Ein Fehler ist aufgetreten.</div></div>";
}else{

	$minus = "-";

	$posy = strpos($y,$minus);

	if($posy === true){
		$ry = ($mitte_y + $y)-10;
	}else{
		$ry = ($mitte_y - $y)-10;
	}

	$rx = ($mitte_x + $x)-10;

	// Bild ist 1400x1400
	echo "<div class='map'></div>";

	echo "<div class='test' style='left:{$rx}px;top:{$ry}px;'></div>";
	
}

?>
</body>
</html>