<?php

$data = array('review' => $_POST['review'],
				'time' => $_POST['timeOption'],
				'tenantid' => $_POST['tenantid'],
				'propertyid' => $_POST['propertyid']
			  );
	try
	{
		include "pdo.inc";
		
		$query = "INSERT INTO tenant_registration (review, time, propertyid, tenantid ) VALUES(:review, :time, :tenantid, :propertyid)";
		$stmt = $pdo->prepare($query);
		$stmt->execute($data);
				
		header('Location: Review.php');	//form.php	 
	}
	catch (PDOException $e)
	{	  //dealing with errors	
		  echo $e->getMessage();
	}
$dbh = null;
?>