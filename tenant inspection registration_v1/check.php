<?php
	include "pdo.inc";
	try
	{
	$result = $pdo->query('SELECT review, timeOption'.
					 'FROM reviewcomment ');
					 
	}
	catch (PDOException $e)
	{
		  echo $e->getMessage();
	}
	
	echo "<table border='1' cellpadding = '10;'>";
	echo "<tr><th> reviewcomment </th></tr>";
	foreach ($result as $review, $taskOption) {
		
			echo $review['review'];
			echo $taskOption['timeOption'];'];
			echo "</td><td>"; 
			
	}
echo "</table>";
?>


