<html xmlns="http://www.w3.org/1999/xhtml">
<?php
//$c_id = 1

//$p_id = 1;

//Gets the property id from the URL contractDetails?ID=1
$p_id = $_GET['ID'];

/*
	$dbhost 	= "localhost";
	$dbname		= "1008545";
	$dbuser		= "1008545";
	$dbpass		= "IFB299GROUP93";
*/

	$dbhost 	= "localhost";
	$dbname		= "property_management";
	$dbuser		= "root";
	//$dbpass		= "root";
	$dbpass		= "root";
			try {
					$pdo = new PDO("mysql:host=$dbhost;dbname=$dbname",$dbuser,$dbpass);
					$pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
					
					//Gets a list of all the contracts ordering it the latest contract
					$contracts = $pdo->query("SELECT * FROM contract_details WHERE propertyid = '$p_id' ORDER BY contractid DESC")->fetchAll(PDO::FETCH_ASSOC);
					
					//Gets the count of how many contracts were found.
					$recCount = $pdo->prepare("SELECT count(*) FROM contract_details WHERE propertyid = '$p_id'");
					$recCount->execute();
					$num_contracts = $recCount->fetchColumn();
					
					//Gets the property details for that property
					$property = $pdo->query("SELECT * FROM property_details WHERE propertyid = '$p_id'")->fetchAll(PDO::FETCH_ASSOC);
					
					$counter = 1;
					$t_id = "";
					//grabs the first contract found
					foreach ($contracts as $contract)
					{
						 if ($counter == 1)
						{
							$t_id = $contract['tenantid'];
							
							$counter = $counter + 1;
						}
						
					}
					// a Tenant exists for this property
					if ($counter > 1)
					{

						$tenant = $pdo->query("SELECT * FROM tenant_details WHERE tenantid = '$t_id'")->fetchAll(PDO::FETCH_ASSOC);
						
					}
					
					
					
				}
			catch(PDOException $e)
				{
					echo $e->getMessage();
				}
				$pdo = null;
?>



<head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
    <title> Contract details </title>
    <link href="main_11.css" rel="stylesheet" type="text/css"/>
</head>

<body>

<div id="outside">
	<div id="header">
		<br>
		<h1>Rental Service Company</h1>

			<div id="Menu">
				<ul>
					<li><a href="home.php" class="current"> Home </a> </li>
					<li><a href="properties.html" class="current"> Properties </a> </li>
					<li><a href="contactus.html" class="current"> Contact us </a> </li>
					<li><a href="signin.php" class="current"> Sign In </a> </li>
				</ul>
			</div> <!--Menu -->

	</div> <!--header -->


	<div id="secondBanner">

		<img src="images/house3.jpg" width="770" height="90" alt="welcome to Property Service"/>
	</div> <!---secondBanner -->

			<div id="bigContent">
				<div id="secondContent">
					
			
			<?php
			/*$recordset= $pdo->query("SELECT tenant_details.tenantid, tenant_details.tenant_firstname,tenant_details.tenant_lastname
			FROM tenant_details, contract_details
			WHERE tenant_details.tenantid = contract_details.tenantid;") 

			//$result = mysql_query($query) or die(mysql_error());


			while($row1 = mysql_fetch_array($result)){
  
			}
			$recordset = $pdo->query("SELECT property_details.propertyid, property_details.street_address, property_details.suburb, property_details.rent_amt
            FROM property_details, contract_details
            WHERE property_details.propertyid = contract_details.propertyid")

			$result = mysql_query($query) or die(mysql_error());


			while($row2 = mysql_fetch_array($result)){
  
			}*/
			
			?>
			

			
			

			<?php
			
	/*
			$sql = "SELECT * FROM contract_details WHERE contractid = '$c_id'";
			$sql = "SELECT tenant_details.tenantid, tenant_details.tenant_firstname,tenant_details.tenant_lastname
			FROM tenant_details, contract_details
			WHERE tenant_details.tenantid = contract_details.tenantid;";
			$sql .= "SELECT property_details.propertyid, property_details.street_address, property_details.suburb, property_details.rent_amt
            FROM property_details, contract_details
            WHERE property_details.propertyid = contract_details.propertyid";
*/		
			
			
			if ($num_contracts == 0)
			{
				echo "<h3>Property contract not found</h3>";
			}
			else
			{
				
				
				echo "<h1>Contract details</h1>";
				//loops through the properties
				foreach ($property as $row2)
				{
					echo "<p><b>Property ID:</b>",$row2['propertyid'], "</p>";
					echo "<p><b>Street address:</b>",$row2['street_address'], "</p>";
				    echo "<p><b>Suburb:</b>",$row2['suburb'], "</p>";
					echo "<hr></hr>";
				}
				
				$counter = 1;
				//loops through the contract
				foreach ($contracts as $row3)
				{
					if ($counter == 1)
					{
					echo "<h3><b>Contract details</b></h3>";
					
					echo '<p><b>Contract expiry date:</b>',$row3['contract_expiry'],  "</p>";
					echo "<p><b>Contract conditions:</b></p><p>", $row3['contract_conditions'], '</p>';
					echo "<p><b>Contract length:</b>", $row3['contract_length'], "</p>";
					echo "<hr></hr>";
					$counter = $counter + 1;
					}
				}
				//loops through the tenant
				foreach ($tenant as $row1)
				{
					echo "<h3><b>Tenant details:</b></h3>";
					echo "<p><b>Tenant ID:</b>",$row1['tenantid'],  "</p>";
					echo "<p><b>Tenant name:</b>",$row1['tenant_firstname'], " ", $row1['tenant_lastname'],  "</p>";
					echo "<hr></hr>";
					
				}
				echo "<p><b>Property owner: NA until later release</b></p>";
			} 
			?>


				<br>
				<br>
				<br>
				<br>
			

			</div>

				<div id="news">



					<p class="clear"></p>

				</div><!--news-->

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