
<html xmlns="http://www.w3.org/1999/xhtml">
<?php

	if(!isset($_SESSION)){
    session_start();
	}

	//$p_id = $_GET['ID'];
	
	if (isset($_SESSION['t_id']))
	{
		$tenantid = $_SESSION['t_id'];
	}
	else
	{
		$tenantid = 0;
	}
/*
	$dbhost 	= "localhost";
	$dbname		= "1008545";
	$dbuser		= "1008545";
	$dbpass		= "IFB299GROUP93";
*/
if (isset($_POST['timeOption']) && isset($_POST['tenantid']) && isset($_POST['propertyid'])) {
	

	$dbhost 	= "localhost";
	$dbname		= "property_management";
	$dbuser		= "carman";
	$dbpass		= "password";
	//$dbuser		= "root";
	//$dbpass		= "6Chain9123";


			try {
					$pdo = new PDO("mysql:host=$dbhost;dbname=$dbname",$dbuser,$dbpass);
					$pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

			/*		
					$recordset = $pdo->query("SELECT * FROM property_details WHERE propertyid = '$p_id'")->fetchAll(PDO::FETCH_ASSOC);
					$recordimages = $pdo->query("SELECT * FROM property_images WHERE propertyid = '$p_id'")->fetchAll(PDO::FETCH_ASSOC);
					$favs = $pdo->prepare("SELECT count(*) FROM tenant_favourites WHERE propertyid = '$p_id' AND tenantid = $tenantid");
					$favs->execute();
					$favourite_count = $favs->fetchColumn();
					
					$recCount = $pdo->prepare("SELECT count(*) FROM property_details WHERE propertyid = '$p_id'");
					$recCount->execute();
					$num_properties = $recCount->fetchColumn();
			*/
					$query = "INSERT INTO tenant_registration ( time, propertyid, tenantid ) VALUES( :time, :tenantid, :propertyid)";
					$stmt = $pdo->prepare($query);
					$stmt->bindValue(':time', $_POST['timeOption']);
					$stmt->bindValue(':tenantid', $_POST['tenantid']);
					$stmt->bindValue(':propertyid', $_POST['propertyid']);
					$stmt->execute();


				}

			catch(PDOException $e)
				{
					echo $e->getMessage();
				}
				$pdo = null;
			}

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


			<div id="Menu">
				<ul>
					<li><a href="home.php" class="current"> Home </a> </li>
					<li><a href="properties.html" class="current"> Properties </a> </li>
					<!--<li><a href="contactus.html" class="current"> Contact us </a> </li> -->
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
		/*		
			if ($num_properties == 0)
			{
				echo "<h3>Property not found</h3>";
			}
			else
			{*/
		
			// loops through all the property information and adds them to the page with their tags
				//foreach ($recordset as $record)
			
			//	foreach ($recordtenant as $record)  -------------------------------------------------------------------------------
				// {

				/*	echo "<h1>$",$record['rent_amt'], " Weekly</h1>";
					echo "<h3>",$record['street_address'],", ",$record['suburb'],  "</h3>";
					
					if ($tenantid == 0)
					{
						echo "<p>Must login to favourite page</p>";
						echo '<p><a href="signin.php" target="_blank">Click here to sign in.</a></p>';
					}
					else if ($favourite_count > 0)
					{
						echo '<form name="registration" method="POST"  action="favourite_page.php?ID=',$p_id, '&method=remove"', 'onsubmit="">';
						echo '<p><input class="favourite_page" type="submit" value="Unfavourite this page"> </p>';
						echo '</form>';	
					}
					else
					{
						echo '<form name="registration" method="POST"  action="favourite_page.php?ID=',$p_id, '&method=add"', 'onsubmit="">';
						echo '<p><input class="favourite_page" type="submit" value="Favourite this page"> </p>';
						echo '</form>';
					}
				
				*/	
				/*
					if (isset($record['gumtree_url']))
					{
						echo '<p><a href="',$record['gumtree_url'],'" target="_blank">View property on gumtree</a></p>';
					}
					echo "<hr></hr>";
					echo '<p><b>Inspection times:</b>', "</p>";
					echo "<p>", $record['inspection_time1'], '</p>';
					echo "<p>", $record['inspection_time2'], "</p>";
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
			*/
						echo "<form method='post' action='properties_page_v2.php'>";
					  //tenant id and property id here----------------------------------------------------------------
						echo '<br><br>';
					    echo '&nbsp; Tenant ID :';
						echo '&nbsp; &nbsp; <select name="tenantid" >';
					    echo '<option value="1">1</option>';
					    echo '<br><br>';
					    echo '</select>';

					    echo '<br><br>';
					    echo '&nbsp; Property ID :';
						echo '&nbsp; &nbsp;<select name="propertyid" >';
					    echo '<option value="1">1</option>';
					    echo '<br><br>';


					    echo '</select>';


						echo '<br><br>';
			   			echo '&nbsp; &nbsp;Open for Inspection Times & Please select the time';
						echo '<br><br>';
						echo '&nbsp; &nbsp;<select name="timeOption">';
			   			echo '<option value="Sat 28 Sep 8:30pm - 9:00am">Sat 28 Sep 8:30pm - 9:00am</option>';
			   			echo '<option value="Cancel = Sat 28 Sep 8:30pm - 9:00am">Cancel</option>';
			   			echo '<option value=""> </option>';

			   			echo '<option value="Sat 10 Oct 6:30pm - 7:00am">Sat 10 Oct 6:30pm - 7:00am</option>';
					    echo '<option value="Cancel = Sat 10 Oct 6:30pm - 7:00am">Cancel</option>';
					    echo '<option value=""> </option>';

					    echo '<option value="Sat 17 Oct 2:30pm - 3:00am">Sat 17 Oct 2:30pm - 3:00am</option>';
					    echo '<option value="Cancel = Sat 17 Oct 2:30pm - 3:00am">Cancel</option>';
					    echo '<option value=""> </option>';
			   			echo '</select>';


					    echo '<br><br>';
					    echo '<br><br>';
					    echo '<br><br>';
					    echo '<br><br>';
					    echo '<br><br>';
					    echo '<br><br>';

						echo '&nbsp; &nbsp;<input type="submit" value="Submit">';
						echo '<form>';
			// 	}
			// }
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
