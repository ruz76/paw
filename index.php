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

	<link rel="stylesheet" href="https://unpkg.com/leaflet@1.0.1/dist/leaflet.css" />
	<script src="https://unpkg.com/leaflet@1.0.1/dist/leaflet.js"></script>
	<script src="http://gisak.vsb.cz/ruzicka/lib/leaflet/showplace.js"></script>
	<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script>
	<script>
	$(document).ready(function(){
		/*
		$("#1").hide();
		$("#1").click(function(){
			$(this).hide();
		});
		*/
		setMap('mapid');
		$("#mapid").hide();
		
		$("strong").click(function(){
			
			$("#mapid").show();
			
			var lat = $(this).attr("lat");
			var lon = $(this).attr("lon");
			var zoom = $(this).attr("zoom");
			var text = $(this).attr("text");
			
			showPlace(lat, lon, zoom, text);
		});
	});
	</script>	
</head>
<body>
<form>
	<p>
	Počet:<input type="number" name="pocet" min="0" max="100" step="1" value="30">
	Info:<input name="info" value="FFF"/>
	Birthday (date and time): <input type="datetime-local" name="bdaytime">
	<input type="radio" name="style" value="li" checked> Odrážka<br>
	<input type="radio" name="style" value="p"> Odstavec<br>
	<textarea name="text1" rows="10" cols="50">
		Ostrava je pěkná díra. Vítejte v Ostravě. K Ostravě mám pěkný vztah.
	</textarea>
	<input type="submit"/>	
	</p>
</form>
<?php
	function connect($misto) {
		// Let's pass in a $_GET variable to our example, in this case
		// it's aid for actor_id in our Sakila database. Let's make it
		// default to 1, and cast it to an integer as to avoid SQL injection
		// and/or related security problems. Handling all of this goes beyond
		// the scope of this simple example. Example:
		//   http://example.org/script.php?aid=42
		if (isset($_REQUEST['aid']) && is_numeric($_REQUEST['aid'])) {
			$aid = (int) $_GET['aid'];
		} else {
			$aid = 1;
		}

		// Connecting to and selecting a MySQL database named sakila
		// Hostname: 127.0.0.1, username: your_user, password: your_pass, db: sakila
		$mysqli = new mysqli('127.0.0.1', 'root', 'root', 'ruz76');

		// Oh no! A connect_errno exists so the connection attempt failed!
		if ($mysqli->connect_errno) {
			// The connection failed. What do you want to do? 
			// You could contact yourself (email?), log the error, show a nice page, etc.
			// You do not want to reveal sensitive information

			// Let's try this:
			echo "Sorry, this website is experiencing problems.";

			// Something you should not do on a public site, but this example will show you
			// anyways, is print out MySQL error related information -- you might log this
			echo "Error: Failed to make a MySQL connection, here is why: \n";
			echo "Errno: " . $mysqli->connect_errno . "\n";
			echo "Error: " . $mysqli->connect_error . "\n";
			
			// You might want to show them something nice, but we will simply exit
			exit;
		}

		// Perform an SQL query
		$sql = "SELECT * FROM mista WHERE nazev LIKE '%".$misto."%'";
		if (!$result = $mysqli->query($sql)) {
			// Oh no! The query failed. 
			echo "Sorry, the website is experiencing problems.";

			// Again, do not do this on a public site, but we'll show you how
			// to get the error information
			echo "Error: Our query failed to execute and here is why: \n";
			echo "Query: " . $sql . "\n";
			echo "Errno: " . $mysqli->errno . "\n";
			echo "Error: " . $mysqli->error . "\n";
			exit;
		}

		// Phew, we made it. We know our MySQL connection and query 
		// succeeded, but do we have a result?
		if ($result->num_rows === 0) {
			// Oh, no rows! Sometimes that's expected and okay, sometimes
			// it is not. You decide. In this case, maybe actor_id was too
			// large? 
			echo "We could not find a match for ID $aid, sorry about that. Please try again.";
			exit;
		}

		// Now, we know only one result will exist in this example so let's 
		// fetch it into an associated array where the array's keys are the 
		// table's column names
		$actor = $result->fetch_assoc();
		echo "Sometimes I see " . $actor['nazev'] . " " . $actor['lat'] . " on TV.";

		// Now, let's fetch five random actors and output their names to a list.
		// We'll add less error handling here as you can do that on your own now
		$sql = "SELECT * FROM mista ORDER BY rand() LIMIT 5";
		if (!$result = $mysqli->query($sql)) {
			echo "Sorry, the website is experiencing problems.";
			exit;
		}

		// Print our 5 random actors in a list, and link to each actor
		echo "<ul>\n";
		while ($actor = $result->fetch_assoc()) {
			echo "<li><a href='" . $_SERVER['SCRIPT_FILENAME'] . "?aid=" . $actor['nazev'] . "'>\n";
			echo $actor['nazev'] . ' ' . $actor['lat'];
			echo "</a></li>\n";
		}
		echo "</ul>\n";

		// The script will automatically free the result and close the MySQL
		// connection when it exits, but let's just do it anyways
		$result->free();
		$mysqli->close();
	}

	echo "<h1>Ahoj Karle</h1>";
	//echo "<p>".$_REQUEST["text1"]."</p>";
	
	$pocet_znaku = strlen($_REQUEST["text1"]);
	//echo "<p>".$pocet_znaku."</p>";
	
	$pieces = explode(" ", $_REQUEST["text1"]);
	/*
	echo "<p>".$pieces[0]."</p>"; // piece1
	echo "<p>".$pieces[1]."</p>"; // piece2
	*/
	
	/*foreach ($pieces as $value) {
		echo "<p>".$value."</p>";
	}*/
	
	$ostrava = array("Ostrava", "Ostravě", "Ostravou"); 
	$sel=0;
	for ($i=0; $i<count($pieces); $i++) {
		//echo "<p>".str_replace(".", "", $pieces[$i])."</p>";
		//echo "<p>".str_replace(".", "", trim($pieces[$i], " \t\n"))."</p>";
		//echo "<p>".strtr(trim($pieces[$i], ". \t\n"), ".", "")."</p>";
		$word = trim($pieces[$i], ". \t\n");
		$word = str_replace(".", "", $word);
		//echo "<p>".trim($pieces[$i], ". \t\n")."</p>";
		//echo "<p>".$word."</p>";
		/*if (in_array(str_replace(".", "", trim($pieces[$i], " \t\n")), $ostrava)) {
			$pieces[$i] = "<strong>".$pieces[$i]."</strong>";
		}*/
		if (in_array($word, $ostrava)) {
			$sel++;
			//$pieces[$i] = '<strong id="'.$sel.'">'.$pieces[$i].'</strong>';
			//$pieces[$i] = "<strong id=\"".$sel."\">".$pieces[$i]."</strong>";	
			//$pieces[$i] = "<strong id='".$sel."'>".$pieces[$i]."</strong>";	
			//$pieces[$i] = "<strong id=\"".$sel."\" lat=\"49.89\" lon=\"18.02\" zoom=\"12\" text=\"Tady je Ostrava ".$sel."\">".$pieces[$i]."</strong>";	
			$pieces[$i] = "<strong id=\"".$sel."\" lat=\"49.82\" lon=\"18.22\" zoom=\"12\" text=\"<p>Tady je Ostrava</p><p><img src=http://www.integritylife.org/sites/default/files/ostrava_1.jpg width=100></p><p>Pořadí v textu: ".$sel."</p>\">".$pieces[$i]."</strong>";	
			
		}
	}
	$text1_strong_ostrava = implode(" ", $pieces);
	echo "<p>".$text1_strong_ostrava."</p>";
	/*
	echo "<ol>";
	for ($i=1; $i<=$_REQUEST["pocet"]; $i++) {
		if ($_REQUEST["style"] == "li") {
			echo "<li>Odrážka č.".$i." ".$_REQUEST["info"]."</li>";
		} else {
			echo "<p>Odstavec č.".$i." ".$_REQUEST["info"]."</p>";
		}
	}
	echo "</ol>";	
	*/
	
	connect("Brno");
?>

<div id="mapid" style="width: 600px; height: 400px;"></div>

</body>
</html>