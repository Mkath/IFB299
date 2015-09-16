
<html xmlns="http://www.w3.org/1999/xhtml">
<?php
include 'connection.php';

	if(!isset($_SESSION)){
    session_start();
	}

	$p_id = $_GET['ID'];
	
	if (isset($_SESSION['t_id']))
	{
		$tenantid = $_SESSION['t_id'];
	}
	else
	{
		$tenantid = 0;
	}

			try {
					//connection to the database
					$pdo = new PDO("mysql:host=$dbhost;dbname=$dbname",$dbuser,$dbpass);
					$pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
					
					//get all the property details, images and favourites that relate to that property
					$recordset = $pdo->query("SELECT * FROM property_details WHERE propertyid = '$p_id'")->fetchAll(PDO::FETCH_ASSOC);
					$recordimages = $pdo->query("SELECT * FROM property_images WHERE propertyid = '$p_id'")->fetchAll(PDO::FETCH_ASSOC);
					
					//Get the count of the favourites for validation
					$favs = $pdo->prepare("SELECT count(*) FROM tenant_favourites WHERE propertyid = '$p_id' AND tenantid = $tenantid");
					$favs->execute();
					$favourite_count = $favs->fetchColumn();
					
					//Get the count of all the property details for validation
					$recCount = $pdo->prepare("SELECT count(*) FROM property_details WHERE propertyid = '$p_id'");
					$recCount->execute();
					$num_properties = $recCount->fetchColumn();
					
					//Get the count of all the inspections for that customer for validation
					$inspectionCount = $pdo->prepare("SELECT count(*) FROM tenant_registration WHERE propertyid = '$p_id' AND tenantid = '$tenantid'");
					$inspectionCount->execute();
					$num_inspections = $inspectionCount->fetchColumn();
				}

			catch(PDOException $e)
				{
					echo $e->getMessage();
				}
				$pdo = null;

?>

<head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
    <title> Welcome to Rent property </title>
    <link href="main_11.css" rel="stylesheet" type="text/css"/>
</head>

<body>

<div id="outside">
	<div id="header">
		<br>
		<h1>Rental Service Company</h1>

			<div id="Menu">
				<?php include 'menu.php'; ?>
			</div> <!--Menu -->

	</div> <!--header -->


	<div id="secondBanner">

		<img src="images/house3.jpg" width="770" height="90" alt="welcome to Property Service"/>
	</div> <!---secondBanner -->


	<div id="bigContent">
			<div>


			<?php
				// loops through each of the images found and displays them on the top
					foreach ($recordimages as $image)
					{
						echo '<a href="/images/', $image['image_path'],'" target="_blank" >';
						echo '<img style="float: left; margin: 15px 15px 15px 15px; width: 150px;height: 100px;border:0" src="/images/',$image['image_path'], '" alt="', $image['image_decription'], '">';
						echo '</a>';
					}

			?>
			</div>

			<div id="secondContent">

			<?php

			if ($num_properties == 0)
			{
				echo "<h3>Property not found</h3>";
			}
			else
			{

			// loops through all the property information and adds them to the page with their tags
				foreach ($recordset as $record)
				{

					echo "<h1>$",$record['rent_amt'], " Weekly</h1>";
					echo "<h3>",$record['street_address'],", ",$record['suburb'],  "</h3>";
					
					// Check to see if the user has logged in first
					if ($tenantid == 0)
					{
						echo "<p>Must login to favourite page or book inspection times</p>";
						echo '<p><a href="signin.php" target="_blank">Click here to sign in.</a></p>';
					}
					// if so and they have already favourited this page. Make the button say "unfavourite"
					else if ($favourite_count > 0)
					{
						echo '<form name="registration" method="POST"  action="favourite_page.php?ID=',$p_id, '&method=remove"', 'onsubmit="">';
						echo '<p><input class="favourite_page" type="submit" value="Unfavourite this page"> </p>';
						echo '</form>';	
					}
					else
					{
						// else they have logged in and add the favourite button
						echo '<form name="registration" method="POST"  action="favourite_page.php?ID=',$p_id, '&method=add"', 'onsubmit="">';
						echo '<p><input class="favourite_page" type="submit" value="Favourite this page"> </p>';
						echo '</form>';
					}
					

	
					if (isset($record['gumtree_url']))
					{
						echo '<p><a href="',$record['gumtree_url'],'" target="_blank">View property on gumtree</a></p>';
					}
					
					
					echo "<hr></hr>";
					
					
					echo '<p><b>Available inspection times:</b>', "</p>";
					// just display inspection times if the user isnt logged in
					if ($tenantid == 0)
					{
						echo "<p>", $record['inspection_time1'], '</p>';
						echo "<p>", $record['inspection_time2'], "</p>";
					
					}
					
					else
					{
						//otherwise build a select box
						echo '<form method="POST" action="process_inspection.php?ID=', $p_id, '">';
						foreach ($recordset as $inspection)
						{
							echo '<p>';
							echo '<select name="timeOption">';
							echo '<option value="', $inspection['inspection_time1'], '">', $inspection['inspection_time1'], '</option>';
							echo '<option value="', $inspection['inspection_time2'], '">', $inspection['inspection_time2'], '</option>';
							echo '</select>';
							
							//only display the book inspections button if the user has not already chosen an inspection
							if ($num_inspections == 0)
							{
								echo '<input type="submit" value="Book Inspection">';
							}
							else
							{
								echo '<p> You have already booked an inspection</p>';
							}
							echo '</p>';
						}
						echo '</form>';
					}
					echo "<HR></HR>";					
					
					echo "<p><b>Property Type: </b>",$record['property_type'],  "</p>";
					echo "<p><b>Number of Rooms: </b>",$record['number_rooms'],  "</p>";
					echo "<p><b>Number of bathrooms: </b>",$record['number_bathrooms'],  "</p>";

					//converts furnished to a YES/NO
					if ($record['furnished'] == TRUE)
					{
						$furnished = 'Yes';
					}
					else
					{
						$furnished = 'No';
					}

					echo "<hr> </hr>";

					echo "<b><Br>About</BR></b><p>", $record['description'], "</p>";
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
