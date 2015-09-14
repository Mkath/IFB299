
<html xmlns="http://www.w3.org/1999/xhtml">
<?php

$p_id = $_GET['ID'];

	// $dbhost 	= "localhost";
	// $dbname		= "1008545";
	// $dbuser		= "1008545";
	// $dbpass		= "IFB299GROUP93";

	$dbhost 	= "localhost";
	$dbname		= "property_management";
	$dbuser		= "root";
	$dbpass		= "";

			try {
					$pdo = new PDO("mysql:host=$dbhost;dbname=$dbname",$dbuser,$dbpass);
					$pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
					$recordset = $pdo->query("SELECT * FROM property_details WHERE propertyid = '$p_id'")->fetchAll(PDO::FETCH_ASSOC);
					$recordimages = $pdo->query("SELECT * FROM property_images WHERE propertyid = '$p_id'")->fetchAll(PDO::FETCH_ASSOC);
					$recCount = $pdo->prepare("SELECT count(*) FROM property_details WHERE propertyid = '$p_id'");
					$recCount->execute();
					$num_properties = $recCount->fetchColumn();
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
					echo '<p><input class="submit_button" type="submit" value="Book Inspection"> <input class="submit_button" type="submit" value="Favourite this page"> </p>';
					echo '<p><a href="',$record['gumtree_url'],'" target="_blank">View property on gumtree</a></p>';
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
