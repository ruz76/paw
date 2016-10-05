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
	
	$file = fopen("studenti.csv","r");
	?><ul><?php
	while(! feof($file))
	{
		$items = fgetcsv($file,0,";");
		?><li><?php
		?><a href="<?php echo $items[1];?>.php"><?php echo $items[2];?></li>
		<?php
		echo $items[2]."<br/>";
		?></li>
		<?php
		file_put_contents($items[1].".php", fopen("https://raw.githubusercontent.com/".$items[1]."/".$items[5]."/master/index.php", 'r'));
	}
	?></ul><?php
	fclose($file);
	
	
?>
</body>
</html>