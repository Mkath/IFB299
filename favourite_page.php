<?php
	if(!isset($_SESSION)){
    session_start();
	}
	
	$p_id = $_GET['ID'];
	$tenantid = $_SESSION['t_id'];
	$favourite = $_GET['method'];
	
	$dbhost 	= "localhost";
	$dbname		= "property_management";
	$dbuser		= "root";
	$dbpass		= "6Chain9123";

	
	if (isset($p_id) AND isset($tenantid))
	{

		try {
				if ($favourite == "add")
				{
					$pdo = new PDO("mysql:host=$dbhost;dbname=$dbname",$dbuser,$dbpass);
					$pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
					$recordset = $pdo->prepare("INSERT INTO tenant_favourites values ('$tenantid','$p_id')");	
					
					$recordset->execute();
				}
				elseif ($favourite == "remove")
				{
					$pdo = new PDO("mysql:host=$dbhost;dbname=$dbname",$dbuser,$dbpass);
					$pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
					$recordset = $pdo->prepare("DELETE FROM tenant_favourites WHERE tenantid = '$tenantid' AND propertyid = '$p_id'");	
					
					$recordset->execute();					
				}
				header("location:  http://{$_SERVER['HTTP_HOST']}/properties_page.php?ID=$p_id");
				
				
				//header("location:  http://{$_SERVER['HTTP_HOST']}/$prev_page");
			}

		catch(PDOException $e)
			{
				echo $e->getMessage();
			}
			$pdo = null;
	}


?>