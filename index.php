<!DOCTYPE html>
<html dir="ltr" lang="">
  <head>  
  
    <title>PAW</title>
	<meta name="description" content="">
	<meta name="keywords" content="">
	<meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
	<meta name="robots" content="index, follow">
	<meta name="revisit-after" content="7 days">
	<meta http-equiv="X-UA-Compatible" content="IE=edge" />
	        
</head>
<body>
<?php
	echo "Ahoj Karle éíščížáíáčžéášč";
	echo "<ol>";
	for ($i=0; $i<10; $i++) {
		$pomi = $i + 1;
		echo "<li>Odrážka č.".$pomi."</li>";
	}
	echo "</ol>";
	
	echo "<ol>";
	for ($i=1; $i<11; $i++) {
		echo "<li>Odrážka č.".$i."</li>";
	}
	echo "</ol>";
?>
</body>
</html>