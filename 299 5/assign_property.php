<?php

//database details
include 'connection.php';

	//renew the session
	if(!isset($_SESSION)){
    session_start();
	}

	
	//redirect user if they are not the administrator. 
  if(!isset($_SESSION['e_id']) && ($_SESSION['UserType'] != "Admin")) {
    echo '<script type="text/javascript">
    alert("Forbidden");
    window.location.href = "signin.php";
    </script>';
  }
  
  if (isset($_GET['assigned']))
  {
	$assigned_properties = $_GET['assigned'];
  }
  else
  {
	$assigned_properties = 'unassigned';
  }


  	try {
		//connection to the database
			$pdo = new PDO("mysql:host=$dbhost;dbname=$dbname",$dbuser,$dbpass);
			$pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
			
			//Get all the properties that have not been assigned
			if ($assigned_properties != "assigned")
			{
				$recordset = $pdo->query("SELECT * FROM property_details WHERE tenantid IS NULL ORDER BY SUBURB")->fetchAll(PDO::FETCH_ASSOC);
			}
			else
			{
				$recordset = $pdo->query("SELECT * FROM property_details WHERE tenantid IS NOT NULL ORDER BY SUBURB")->fetchAll(PDO::FETCH_ASSOC);
			}
		}
		//show errors if database fails.
		catch(PDOException $e)
		{
			echo $e->getMessage();
		}
		$pdo = null;
  
?>
<html xmlns="http://www.w3.org/1999/xhtml">

<head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
    <title> Welcome to Rent property </title>
    <link href="main_11.css" rel="stylesheet" type="text/css"/>
</head>

<body>

<div id="outside">
	<div id="header">
		<br>

			<div id="Menu">
				<ul>
					<?php include 'menu.php'; ?>
				</ul>
			</div> <!--Menu -->

	</div> <!--header -->


	<div id="secondBanner">

		<img src="images/house3.jpg" width="770" height="90" alt="welcome to Property Service"/>
	</div> <!---secondBanner -->


	<div id="bigContent">
			<!-- <div id="secondContent"> -->

				<?php
				if ($assigned_properties == 'assigned')
				{
					echo '<a href="assign_property.php?assigned=unassigned"> Switch to Unassigned properties</a>';
					echo "<h3>List of assigned properties<h3>";
				}
				else
				{
					echo '<a href="assign_property.php?assigned=assigned">Switch to Assigned properties</a>';
					echo "<h3>List of unassigned properties<h3>";
				} 
				//Displayer Header information on the table
				
				
				echo '<table style="width:100%">';
				echo '<tr><td>Property Address</td>';				
				echo '<td style="text-align: center; vertical-align: middle">Assign Tenant</td>';
				echo '<td style="text-align: center; vertical-align: middle">Owner</td>';
				echo '<td style="text-align: center; vertical-align: middle">Employee</td>';
				echo '<td style="text-align: center; vertical-align: middle">Update</td></tr>';
				//Loop through each property and display on page with a link to each property.
				foreach ($recordset as $property)
				{
					echo '<form name="Unassigned" onsubmit="" action="process_assigned_property.php?' . 'assigned_properties=' . $assigned_properties . '" method="POST">';
					echo '<tr>';
					echo '<td><a href="properties_page.php?ID=', $property['propertyid'], '">', $property['street_address'],", ", $property['suburb'] , '</a></td>';
					$propertyid = $property['propertyid'];

					/*try {
					//connection to the database
						$pdo = new PDO("mysql:host=$dbhost;dbname=$dbname",$dbuser,$dbpass);
						$pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
						//Get contract for that property
						$contracts = $pdo->query("SELECT * FROM contract_details WHERE propertyid = $propertyid")->fetchAll(PDO::FETCH_ASSOC);
					}
					//if database fails, show error message
					catch(PDOException $e)
					{
						echo $e->getMessage();
					}
					$pdo = null;					
					$counter = 1;
					
					//Display the link to the contract page if the contract exists
					foreach ($contracts as $contract)
					{
						echo '<td><a href="contractDetails.php?ID=', $property['propertyid'], '">View Contract</a></td>';
						$counter = $counter + 1;
					}
					//if it doesnt exist. Display contract not found.
					if ($counter == 1)
					{
						echo '<td>No Contract found</td>';
					} */
					 
					// Create dynamic select box of all the tenants/owners/employee who havent had a property assigned to them.
					include 'tenant_select.php';
					include 'owner_select.php';
					include 'employee_select.php';
					
					echo '<td><input type="submit" value="Update"/></td>';
					echo '</form>';
					echo '</tr>';
				}

				
				echo '</table>';
			
				?>
				

				<br>
				<br>
				<br>
				<br>


		<!--	</div>

				<div id="news">





					<p class="clear"></p>

				</div>-->

	</div> <!---contentOne -->


</div> <!--outside -->

		<div id="footer">
			<p> &#169; Rental Service Company &nbsp; Group 93 IFB299 &nbsp;&nbsp;
				<a href="privacy.html"> Privacy Policy</a>
				<a href="term.html"> Terms and Conditions</a>
			</p>
		</div>

</body>
</html>
