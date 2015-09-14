<?php

$data = array('review' => $_POST['review'],
				'time' => $_POST['timeOption']
			  );
	try
	{
		include "pdo.inc";
		
		$query = "INSERT INTO reviewcomment (review, time) VALUES(:review, :time)";
		$stmt = $pdo->prepare($query);
		$stmt->execute($data);
		//echo "New record created successfully";		
		header('Location: Review.php');	//form.php	 
	}
	catch (PDOException $e)
	{	  //dealing with errors	
		  echo $e->getMessage();
	}
$dbh = null;
?>