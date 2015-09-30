<?php

include 'connection.php';

	if(!isset($_SESSION)){
    session_start();
	}
	
  if(!isset($_SESSION['e_id']) && ($_SESSION['UserType'] != "Admin")) {
    echo '<script type="text/javascript">
    alert("Forbidden");
    window.location.href = "signin.php";
    </script>';
  }	

$assigned = $_GET['assigned_properties'];
  
try {
	//connection to the database
	$pdo = new PDO("mysql:host=$dbhost;dbname=$dbname",$dbuser,$dbpass);
	$pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

		
		$values = $_POST['assigned_values'];
		$employee_values = $_POST['assigned_employee'];
		$owner_values = $_POST['assigned_owner'];
		
			if ($values != "none")
			{
				//gets the value passed from the select box and splits it into tenantid and propertyid
				$propertyTenant = explode("|", $values);
				$tenantid = $propertyTenant[1];
				$propertyid = $propertyTenant[0];
				
				$propertyTenant = explode("|", $owner_values);
				$ownerid = $propertyTenant[1];

				$propertyTenant = explode("|", $employee_values);
				$employeeid = $propertyTenant[1];				
				
				
				
				//builds are connection to the database and updates all the fields with the new information.
				$conn = new PDO("mysql:host=$dbhost;dbname=$dbname", $dbuser, $dbpass);

				//remove existing employee assigned to property
				$stmt = $conn->prepare("DELETE FROM `employee_property` WHERE `propertyid` = :property");
				$stmt->bindParam(':property', $propertyid, PDO::PARAM_STR);
				$stmt->execute();							
				
				//insert the new employee for that property
				$stmt = $conn->prepare("INSERT INTO `employee_property` VALUES(:e_id,:property)");
				$stmt->bindParam(':e_id', $employeeid, PDO::PARAM_STR);
				$stmt->bindParam(':property', $propertyid, PDO::PARAM_STR);
				$stmt->execute();	

				//remove existing owner assigned to property
				$stmt = $conn->prepare("DELETE FROM `propertyowner_property` WHERE `propertyid` = :property");
				$stmt->bindParam(':property', $propertyid, PDO::PARAM_STR);
				$stmt->execute();							
				
				//insert the new owner for that property
				$stmt = $conn->prepare("INSERT INTO `propertyowner_property` VALUES(:o_id,:property)");
				$stmt->bindParam(':o_id', $ownerid, PDO::PARAM_STR);
				$stmt->bindParam(':property', $propertyid, PDO::PARAM_STR);
				$stmt->execute();	

				
						
				//removes the property from the tenants table
				$stmt = $conn->prepare("UPDATE `tenant_details` SET `propertyid` = NULL WHERE `propertyid` = :property");
				$stmt->bindParam(':property', $propertyid, PDO::PARAM_STR);
				$stmt->execute();
				
				//removes tenantid from property
				$stmt = $conn->prepare("UPDATE `property_details` SET `tenantid` = NULL WHERE `propertyid` = :property");
				$stmt->bindParam(':property', $propertyid, PDO::PARAM_STR);
				$stmt->execute();
				
				//assigns  it to the new tenant table
				if ($tenantid != "Vacant" )
				{
					$stmt = $conn->prepare("UPDATE `tenant_details` SET `propertyid` = :property WHERE `tenantid` = :tid");
					$stmt->bindParam(':tid', $tenantid, PDO::PARAM_STR);
					$stmt->bindParam(':property', $propertyid, PDO::PARAM_STR);
					$stmt->execute();
					
					//assigns property to the tenant
					$stmt = $conn->prepare("UPDATE `property_details` SET `tenantid` = :tid WHERE `propertyid` = :property");
					$stmt->bindParam(':tid', $tenantid, PDO::PARAM_STR);
					$stmt->bindParam(':property', $propertyid, PDO::PARAM_STR);
					$stmt->execute();				
				}

					$stmt = $conn->prepare("UPDATE `property_details` SET `tenant` = NULL WHERE `tenantid` = :tid");
					$stmt->bindParam(':tid', $tenantid, PDO::PARAM_STR);
					//$stmt->bindParam(':property', $propertyid, PDO::PARAM_STR);
					$stmt->execute();
				
				//displays success message
				echo '<script type="text/javascript">
				alert("Property has been assigned");
				window.location.href = "assign_property.php?assigned=',$assigned,'";
				</script>';
				header( "refresh:0" ); 
				
			}
		else
		{
				echo '<script type="text/javascript">
				alert("Please select a tenant for this property");
				window.location.href = "assign_property.php?assigned=',$assigned,'";
				</script>';
				header( "refresh:0" );
			
		}
		//}
	
}
catch(PDOException $e)
{
	echo $e->getMessage();
}


?>