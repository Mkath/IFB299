<?php
include 'connection.php';
	if(!isset($_SESSION)){
		session_start();
	}
	
	$p_id = $_GET['ID'];
	$tenantid = $_SESSION['t_id'];
	$favourite = $_GET['method'];
	
	
	if (isset($p_id) AND isset($tenantid))
	{

		try {
				//adds a favourite to the page
				if ($favourite == "add")
				{
					$pdo = new PDO("mysql:host=$dbhost;dbname=$dbname",$dbuser,$dbpass);
					$pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
					$recordset = $pdo->prepare("INSERT INTO tenant_favourites values ('$tenantid','$p_id')");	
					
					$recordset->execute();
				}
				//removes a favourite to the page
				elseif ($favourite == "remove")
				{
					$pdo = new PDO("mysql:host=$dbhost;dbname=$dbname",$dbuser,$dbpass);
					$pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
					$recordset = $pdo->prepare("DELETE FROM tenant_favourites WHERE tenantid = '$tenantid' AND propertyid = '$p_id'");	
					
					$recordset->execute();					
				}
				//redirects back to the property.
				header("location:  http://{$_SERVER['HTTP_HOST']}/properties_page.php?ID=$p_id");
				

			}

		catch(PDOException $e)
			{
				echo $e->getMessage();
			}
			$pdo = null;
	}


?>