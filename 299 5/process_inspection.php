<?php
//connection to the database
include 'connection.php';

	//renew the session.
 	if(!isset($_SESSION)){
		session_start();
	} 
	
		$p_id = $_GET['ID'];
		$inspectiontime = $_POST["timeOption"];
		$tenantid = $_SESSION['t_id'];
		
	//Check to see if all the variables assigned have a value before inserting
	if (IsSet($tenantid) && IsSet($inspectiontime) && IsSet($p_id))
	{
			try {
					//Create a database connection
					$pdo = new PDO("mysql:host=$dbhost;dbname=$dbname",$dbuser,$dbpass);
					$pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
					
					//inserts into the inspections table
					$query = "INSERT INTO tenant_registration (time, tenantid, propertyid ) VALUES(:time, :tenantid, :propertyid)";
					$stmt = $pdo->prepare($query);
					$stmt->bindValue(':time' ,$inspectiontime);
					$stmt->bindValue(':tenantid', $tenantid);
					$stmt->bindValue(':propertyid', $p_id);
					$stmt->execute();

					//redirects back to the properties page
					header("location:  http://{$_SERVER['HTTP_HOST']}/properties_page.php?ID=$p_id");
				}

			//catch the error if the database fails
			catch(PDOException $e)
			{
				echo $e->getMessage();
			}
	}
	else
	{
			//otherwise just redirect them back to the properties page
			header("location:  http://{$_SERVER['HTTP_HOST']}/properties_page.php?ID=$p_id");
	}


?>
