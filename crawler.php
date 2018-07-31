<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <title>Crawler</title>
    <link rel="stylesheet" href="style.css">
	<style>
	
a{
	background-color: #DDDDDD;
	border: 1px solid #DDDDDD;
	border-radius: 2px;
	display: inline-block;
	color: #757575;
	font-size: 13px;
	padding: 2px 8px;
	margin-right: 10px;
	margin-bottom: 5px;
	text-decoration:none;
}
input[type="submit"]{
	height: 36px;
	background-color: #DDDDDD;
	border: 1px solid #DDDDDD;
	border-radius: 2px;
	color: #757575;
	font-size: 13px;
	font-weight: bold;
	margin-top:10px;
}

input[type="text"]{	
	outline:none;
	border-radius: 1px;
	padding:3px;
	box-shadow: 0 1px 1px 0 rgba(0,0,0,0.16), 0 0 0 1px rgba(0,0,0,0.08);
	transition: box-shadow 200ms cubic-bezier(0.4, 0.0, 0.2, 1);
}
	</style>
  </head>
  <body>
    <!-- page content -->

		<main id="crawler" style="text-align: center;">
		Crawler<br><br><br>
		<form action="crawler.php" method="post">
			<input type="search" name="link"><br><br>
			<button type="submit">Crawl</button><br><br>
		</form>
		
		<hr>
		</main>

	
<?php

		$html = $_POST['link'];
		echo filter_var($html, FILTER_VALIDATE_URL);
		echo "<hr>";
		if (filter_var($html, FILTER_VALIDATE_URL) == false && isset($html)){	
			echo "wpisałeś błędny adres URL";
			}		
	
		$dom = new DomDocument;
		$dom->preserveWhiteSpace = FALSE;
		@$dom->loadHTMLFile($html);
		$params = $dom->getElementsByTagName('a');
		$tab = array();		
			
		foreach ($params as $param) { 
				$tab[] = $param -> getAttribute('href');		
		}
		
		$tab = array_unique($tab);
		
		foreach ($tab as $i) { 
			if  ( $parse = parse_url($i) ) 
				{
					if ( !isset($parse['scheme']) ) 
					{
						$i = "http://{$i}";
					}
				}
				
			$i = strtok($i, '#');
			echo '<a href="'.$i.'">'.$i.'</a>';
			
		}
		
		
		   
		
		
		
		
	
	
?>	

	
	
	
	
  </body>
</html>