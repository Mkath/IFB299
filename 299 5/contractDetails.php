<html xmlns="http://www.w3.org/1999/xhtml">
<?php
include 'connection.php';
	//renew the session.
 	if(!isset($_SESSION)){
		session_start();
	}
	
		$p_id = $_GET['ID'];
		$tenantid = $_SESSION['t_id'];	
	
			try {
					$pdo = new PDO("mysql:host=$dbhost;dbname=$dbname",$dbuser,$dbpass);
					$pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
					
					//Retrieves a list of all the contracts ordering it the latest contract
					$contracts = $pdo->query("SELECT * FROM contract_details WHERE propertyid = '$p_id' ORDER BY contractid DESC")->fetchAll(PDO::FETCH_ASSOC);
					
					//Retrieves the count of how many contracts were found.
					$recCount = $pdo->prepare("SELECT count(*) FROM contract_details WHERE propertyid = '$p_id'");
					$recCount->execute();
					$num_contracts = $recCount->fetchColumn();
					
					//Retrieves relevant property details for that property
					$property = $pdo->query("SELECT property_details.propertyid, property_details.street_address, property_details.suburb, property_details.rent_amt FROM property_details WHERE propertyid = '$p_id'")->fetchAll(PDO::FETCH_ASSOC);
					
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
						//Retrieves relevant tenant details
						$tenant = $pdo->query("SELECT tenant_details.tenantid, tenant_details.tenant_firstname,tenant_details.tenant_lastname = '$t_id'")->fetchAll(PDO::FETCH_ASSOC);
						
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
				<div id="secondContent">
							

			<?php
				
			
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