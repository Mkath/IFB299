
<?php
include 'connection.php';
	//renew the session
	if(!isset($_SESSION)){
    session_start();
	}

	
	//redirect user if they are not the administrator. 
  if(!isset($_SESSION['e_id']) and (!isset($_SESSION['o_id']))) {
    echo '<script type="text/javascript">
    alert("Forbidden");
    window.location.href = "home.php";
    </script>';
  }
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
			<div id="secondContent">

				<?php

				try {
				//The following lines assign variables from the search form to local php variables
					

					$conn = new PDO("mysql:host=$dbhost;dbname=$dbname",$dbuser,$dbpass);
					if (isset($_SESSION['o_id']))
					{
						$ownerid = $_SESSION['o_id'];
						$stmt1 = $conn->prepare('SELECT * FROM `propertyowner_property` WHERE `propertyownerid` = :oid');
						$stmt1->bindParam(':oid', $ownerid, PDO::PARAM_STR);
						$stmt1->execute();
					}
					elseif (isset($_SESSION['e_id']))
					{
						$eid = $_SESSION['e_id'];
						
						$stmt1 = $conn->prepare('SELECT * FROM `employee_property` WHERE `employeeid` = :e_id');
						$stmt1->bindParam(':e_id', $eid, PDO::PARAM_STR);
						$stmt1->execute();
						
					}
				}
				catch(PDOException $e)
				{
					echo $e->getMessage();
				}
				if (isset($_SESSION['e_id']))
				{
					echo '<a href="employee_profile.php?ID=',$_SESSION['e_id'],'">View profile</a><p>';
					echo '<hr></hr>';
					echo '<h3>Property Functions</h3><p>';
					echo '<a href="main_11.css">Create new property</a><p>';
					echo '<a href="main_11.css">Edit existing property</a><p>';
					echo '<a href="assign_property.php">Assign tenant/employee/owner to a property</a><p>';
					
					echo '<HR></HR>';
				}
				
				if ($_SESSION['UserType'] == "Admin")
				{
					echo '<h3>Employee Functions</h3><p>';
					echo '<a href="employees_registration.php">Add new employee</a><p>';
					echo '<a href="employee_profile.php">Edit existing employee</a><p>';
					
					echo '<HR></HR>';
				}
				if (isset($_SESSION['e_id']))
				{
					echo '<h3>Owner Functions</h3><p>';
					echo '<a href="owner_registeration.php">Add new owner</a><p>';
					echo '<a href="owner_profile.php">Edit existing owner</a><p>';
					
					echo '<HR></HR>';
					echo "<h3>Current properties assigned to me</h3>";
				}
				else
				{	

					echo '<a href="owner_profile.php?ID=',$_SESSION['o_id'],'">View profile</a><p>';
					echo '<hr></hr>';
					echo '<h3>Property Functions</h3><p>';
					echo '<a href="main_11.css">Create new property</a><p>';
					echo '<a href="main_11.css">Edit existing property</a><p>';
					echo '<hr></hr>';					
					echo "<h3>Current properties that I own</h3>";
				}
				foreach ($stmt1 as $assigned)
				{
					$propertyid = $assigned['propertyid'];

					$properties = $conn->query("SELECT * FROM property_details WHERE propertyid = $propertyid")->fetchAll(PDO::FETCH_ASSOC);
					foreach ($properties as $property)
					{
						echo '<p><a href="properties_page.php?ID=', $property['propertyid'], '">', $property['street_address'],", ", $property['suburb'] , '</a></p>';
					}		
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
