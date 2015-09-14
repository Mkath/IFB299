

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

				<h1>Search Result</h1>
				<p>
					<?php
					
					//Function generates a dynamic SQL string based on an array passed in.
					//$fields is an array of values
					//$dbfield is the database field that the value will be inserted
					//$SQL is the SQL string that will be created and returned
					
					function createSQL($fields, $dbfield, $SQL)
					{
						
						$counter = 0;
						//loop through all the check boxes
						foreach($fields as $record) 
						{
							$counter = $counter + 1;
							//The first will create an AND clause for the sql
							if ($counter == 1)
							{
								if (strstr($record, '|More'))
								{
									$SQL=$SQL . " AND ( UCASE(" . $dbfield . ") >= '" . strtoupper(strstr($record, '|More', true)) .  "'";
								}
								else
								{
									$SQL=$SQL . " AND ( UCASE(" . $dbfield . ") = '" . strtoupper($record) .  "'";
								}
							}
							
							else
							{
								
								if (strstr($record, '|More'))
								{
									$SQL=$SQL . " OR UCASE(" . $dbfield . ") >= '" . strtoupper(strstr($record, '|More', true)) .  "'";
								}
								else
								{									
									$SQL=$SQL . " OR UCASE(" . $dbfield . ") = '" . strtoupper($record) .  "'";
								}
							}
							
						}
						//only add the trailing bracket if there were values in the array
						if ($counter > 0)
						{
							$SQL=$SQL . ")";
						}
						return $SQL;
						
					}
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
					
					$suburb = validate($_GET["venuename"]);
					$room_number = $_GET["roomnumber"];
					$min_rent = $_GET["min"];
					$max_rent = $_GET["max"];
					$furnished = $_GET["furnishedtype"];
					$bathrooms = $_GET["bathrooms"];

					/*$dbhost 	= "localhost";
					$dbname		= "1008545";
					$dbuser		= "1008545";
					$dbpass		= "IFB299GROUP93";
					*/

					$dbhost 	= "localhost";
					$dbname		= "property_management";
					$dbuser		= "root";
					$dbpass		= "6Chain9123";

					//this connects to the mysql database
					$conn = new PDO("mysql:host=$dbhost;dbname=$dbname",$dbuser,$dbpass);

					//this retreives all the data from the table in mysql.
					//It then selects only the rows of information in which all the specified information
					//from the search form are found.


					//builds a dynamically generated sql statement based on the selected search criteria
					$SQL="SELECT * FROM `property_details` WHERE UCASE(suburb) ='" .  strtoupper($suburb) . "'";

					$SQL = createSQL($_GET["type"],"property_type", $SQL);
					
					$SQL = createSQL($_GET["roomnumber"],"number_rooms", $SQL);
					
					$SQL = createSQL($_GET["furnishedtype"],"furnished", $SQL);
					
					$SQL = createSQL($_GET["bathrooms"], "number_bathrooms", $SQL);
					
					$SQL=$SQL . " AND `rent_amt` > " . $min_rent;

					if ($max_rent != "Max")
					{
						$SQL=$SQL . " AND `rent_amt` <= " . $max_rent;
					}


					  $SQL=$SQL . " ORDER BY suburb, rent_amt";
					
					echo $SQL;

					  $stmt = $conn->prepare($SQL);

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
						//if($row != $last)
						//{
						$property_id = $row['propertyid'];

						$conn2 = new PDO("mysql:host=$dbhost;dbname=$dbname",$dbuser,$dbpass);
						$stmt2 = $conn2->prepare('SELECT * FROM `property_images` WHERE `propertyid` = :pid');
						$stmt2->bindParam(':pid', $property_id, PDO::PARAM_STR);
						$stmt2->execute();


							//$last = "placeholder";
							$nCounter = 0;
							$image_path = 'blank.jpg';
						  foreach($stmt2 as $result)
						  {
							if ($nCounter == 0)
							{
								$image_path =  $result['image_path'];
								/*echo '<a href="properties_page.php?ID=',$property_id, '">';
								echo '<img width="400" height="160" src="/images/', $result['image_path'], '" /><p>';

								echo "<p>",$row['street_address'],", ",$row['suburb'],  "</p>";
								echo '</a>';
								echo '<h3>Inspection Time</h3>';
								echo '<p>', $row['inspection_time1'], '</p>';
								echo '<p>', $row['inspection_time2'], '</p></p><br>'; */
								$nCounter = $nCounter+1;
							}
						  }
						  
						echo '<a href="properties_page.php?ID=',$property_id, '">';
						echo '<img width="400" height="160" src="/images/', $image_path, '" /><p>';
						
						echo "<p>",$row['street_address'],", ",$row['suburb'],  "</p>";
						echo '</a>';
						echo '<h3>Rent</h3>';
						echo '<p>$', $row['rent_amt'], ' p/w</p>';
						echo '<h3>Inspection Times</h3>';
						echo '<p>', $row['inspection_time1'], '</p>';
						echo '<p>', $row['inspection_time2'], '</p></p><br>';
						  
						//}
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
