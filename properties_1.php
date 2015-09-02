<?xml version="1.0" encoding="utf-8"?>

<html xmlns="http://www.w3.org/1999/xhtml">

<head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
    <title> Welcome to Rent property </title>
    <link href="main_9.css" rel="stylesheet" type="text/css"/>
</head>

<body>

<div id="outside">
	<div id="header">
		<br>
		<h1>Rental Service Company</h1>

			<div id="Menu">
				<ul>
					<li><a href="home.html" class="current"> Home </a> </li>
					<li><a href="properties.html" class="current"> Properties </a> </li>
					<li><a href="contactus.html" class="current"> Contact us </a> </li>				
				</ul>
			</div> <!--Menu -->
			
	</div> <!--header -->

	
	<div id="secondBanner">

		<img src="images/house3.jpg" width="770" height="90" alt="welcome to Property Service"/>
	</div> <!---secondBanner -->


	<div id="bigContent">
			<div id="secondContent"> 

				<h1>Search Result</h1>
				<p> 
					<?php
							//this function removes an unwanted characters from the suburb
						  function validate($field)
						  {
							$field = trim($field);
							$field = stripslashes($field);
							$field = htmlspecialchars($field);
							$field = strtoupper($field);
							return $field;
						  }
						  //The following lines assign variables from the search form to local php variables
						  $property_type = $_GET["type"];
						  $suburb = validate($_GET["venuename"]);
						  $room_number = $_GET["roomnumber"];
						  $min_rent = $_GET["min"];
						  $max_rent = $_GET["max"];
						  $furnished = $_GET["furnishedtype"];

						  //this connects to the mysql database
						  $conn = new PDO("mysql:host=localhost;dbname=property_management", 'root', '6Chain9123');

						  //this retreives all the data from the table in mysql.
						  //It then selects only the rows of information in which all the specified information
						  //from the search form are found.
						  $stmt = $conn->prepare('SELECT * FROM `property_details` WHERE `property_type` = :ptype AND `suburb` = :suburb AND `rent_amt` < :maxrent
						  AND `rent_amt` > :minrent AND `number_rooms` = :nrooms AND `furnished` = :furnishedtype ORDER BY `suburb`, `rent_amt`');

						  //the following lines combine local variables with the ones created in the above
						  //statement. It then executes all prepared statments.
						  $stmt->bindParam(':ptype', $property_type, PDO::PARAM_STR);
						  $stmt->bindParam(':suburb', $suburb, PDO::PARAM_STR);
						  $stmt->bindParam(':nrooms', $room_number, PDO::PARAM_STR);
						  $stmt->bindParam(':maxrent', $max_rent, PDO::PARAM_STR);
						  $stmt->bindParam(':minrent', $min_rent, PDO::PARAM_STR);
						  $stmt->bindParam(':furnishedtype', $furnished, PDO::PARAM_STR);
						  $stmt->execute();

						  //removes duplicates
						  $last = "placeholder";

						  //these lines display all the chosen information from the selected rows of
						  //the mysql database in a newly created table.
						  if ($stmt->rowCount() == 0){
							echo 'No Results Found...';
						  }
						  else{
							  
						  foreach($stmt as $row)
						  {
							if($row != $last)
							{
							  $property_id = $row['propertyid'];
							  $conn2 = new PDO("mysql:host=localhost;dbname=property_management", 'root', '6Chain9123');
							  $stmt2 = $conn2->prepare('SELECT * FROM `property_images` WHERE `propertyid` = :pid');
							  $stmt2->bindParam(':pid', $property_id, PDO::PARAM_STR);
							  $stmt2->execute();
							  

								$last = "placeholder";
								$nCounter = 0;
							  foreach($stmt2 as $result)
							  {
								if ($nCounter == 0)
								{
									echo '<a href="properties_page.php?ID=',$property_id, '">';
									echo '<img width="400" height="160" src="/images/', $result['image_path'], '" /><p>';
									
									echo "<p>",$row['street_address'],", ",$row['suburb'],  "</p>";
									echo '</a>';
									echo '<h3>Inspection Time</h3>';
									echo '<p>', $row['inspection_time1'], '</p>';
									echo '<p>', $row['inspection_time2'], '</p></p><br>';
									$nCounter = $nCounter+1;
								}
							  }
							}	
						  }
						}
          			?>
	
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

