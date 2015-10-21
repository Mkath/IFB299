<?php
echo  '<td style="text-align: center; vertical-align: middle">';
echo '<select name="assigned_employee">';

try {
//connection to the database
	$pdo = new PDO("mysql:host=$dbhost;dbname=$dbname",$dbuser,$dbpass);
	$pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
	
	//Query database to populate select box. Selecting the current employee first, along with the rest of the employees
	$owners = $pdo->query("SELECT * FROM employee_property WHERE propertyid = $propertyid")->fetchAll(PDO::FETCH_ASSOC);
	$employeeid = 0;
	foreach ($owners as $owner)
	{
		$employeeid = $owner['employeeid'];
	}
	//If there are no employees assigned to this property. Then display Unassigned and fill out the select box with all the employees
	if ($employeeid == 0)
	{
		$ownersdetails = $pdo->query("SELECT * FROM employee_details")->fetchAll(PDO::FETCH_ASSOC);
		echo '<option value="',$property['propertyid'],'|Vacant">Unassigned</option>';
	}
	else
	{
		//else display the assigned employee first and the rest of the employees
		$ownersdetails = $pdo->query("SELECT * FROM employee_details WHERE employeeid = $employeeid UNION SELECT * FROM employee_details WHERE employeeid != $employeeid")->fetchAll(PDO::FETCH_ASSOC);
	}
	//loop through and display the query results
	foreach ($ownersdetails as $ownersdetail)
	{
		echo '<option value="', $property['propertyid'],'|',$ownersdetail['employeeid'], '">', $ownersdetail['employee_firstname'], " ", $ownersdetail['employee_lastname'], '</option>';
	}
	//place the unassign if a property already has employee assigned.
	if ($employeeid != 0)
	{
		echo '<option value="',$property['propertyid'],'|Vacant">Unassign</option>';
	}
	
}
catch(PDOException $e)
{
	echo $e->getMessage();
}

$pdo = null;

echo '</select>';
?>