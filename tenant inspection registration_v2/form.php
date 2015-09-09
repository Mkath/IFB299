<!DOCTYPE html>
<html lang="en" class="ie10"> 
<head>
<meta charset="UTF-8">
<script type = "text/javascript" src="form.js"></script>
<title>Form</title>
</head>

	<?php

	include "pdo.inc";
		try
		{
			$rows = $pdo->query('SELECT review FROM reviewcomment ');
		}
		catch (PDOException $e)
		{
			  echo $e->getMessage();
		}

			echo '<form action="newreview.php" method="POST" name="myForm">';
			
			echo '<p><b> Review : </b></p>';
			echo '<textarea rows="10" cols="60" name="review" id="description" placeholder="Comment"></textarea>';
			


		
	?>

	<?php
	include "pdo.inc";
	try
	{
		
		$result = $pdo->query('SELECT review,time
					FROM reviewcomment');

	}
			catch (PDOException $e) {
 				  echo $e->getMessage();
			}
	
		foreach ($result as $review) {
				echo '<br><br>';
				//echo date("Y/m/d").'&nbsp&nbsp&nbsp';
				echo date("Y/m/d H:i:s").'&nbsp&nbsp&nbsp';
				echo $review['review'].'<br><br>';
				echo '<br><br>';
				echo $review['time'].'<br><br>';
				echo "<br>";
				echo '______________________________________________________________________'.'<br><br>';

				
				
				}
					
?>
</html>