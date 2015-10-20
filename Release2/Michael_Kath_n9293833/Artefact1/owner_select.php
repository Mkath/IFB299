<?php
echo  '<td style="text-align: center; vertical-align: middle">';
echo '<select name="assigned_owner">';

	try {
	//connection to the database
		$pdo = new PDO("mysql:host=$dbhost;dbname=$dbname",$dbuser,$dbpass);
		$pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
		
		//Query database to populate select box
		$owners = $pdo->query("SELECT * FROM propertyowner_property WHERE propertyid = $propertyid")->fetchAll(PDO::FETCH_ASSOC);
		$ownerid = 0;
		
		foreach ($owners as $owner)
		{
			$ownerid = $owner['propertyownerid'];

		}
		//if there isnt any owners for that property then display all the owners. Make Unassigned the first option
		if ($ownerid == 0)
		{
			$ownersdetails = $pdo->query("SELECT * FROM propertyowner_details")->fetchAll(PDO::FETCH_ASSOC);
			echo '<option value="',$property['propertyid'],'|Vacant">Unassigned</option>';								
		}
		else
		{
			// else display the already assigned owner first, along with the rest of the owners.
			$ownersdetails = $pdo->query("SELECT * FROM propertyowner_details WHERE propertyownerid = $ownerid UNION SELECT * FROM propertyowner_details WHERE propertyownerid <> $ownerid")->fetchAll(PDO::FETCH_ASSOC);
		}
		//loop through the query results for the property owners
		foreach ($ownersdetails as $ownersdetail)
		{
			echo '<option value="', $property['propertyid'],'|',$ownersdetail['propertyownerid'], '">', $ownersdetail['propertyowner_firstname'], " ", $ownersdetail['propertyowner_lastname'], '</option>';
		}
		// if the property is already assigned to an owner, then display the unassign at the end.
		if ($ownerid != 0)
		{
			echo '<option value="',$property['propertyid'],'|Vacant">Unassign</option>';
		}
		
		
	}
	//handles database errors
	catch(PDOException $e)
	{
		echo $e->getMessage();
	}

echo '</select>';
?>