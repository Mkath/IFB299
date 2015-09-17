
<!---?php

$p_id = $_GET['ID'];

	$dbhost 	= "localhost";
	$dbname		= "1008545";
	$dbuser		= "1008545";
	$dbpass		= "IFB299GROUP93";

			try {
					$pdo = new PDO("mysql:host=$dbhost;dbname=$dbname",$dbuser,$dbpass);
					$pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
					$recordset = $pdo->query("SELECT * FROM property_details WHERE propertyid = '$p_id'")->fetchAll(PDO::FETCH_ASSOC);
					$recordimages = $pdo->query("SELECT * FROM property_images WHERE propertyid = '$p_id'")->fetchAll(PDO::FETCH_ASSOC);
					$recCount = $pdo->prepare("SELECT count(*) FROM property_details WHERE propertyid = '$p_id'");
					$recCount->execute();
					$num_properties = $recCount->fetchColumn();
					
					//$recordset = $pdo->query("SELECT * FROM tenant_registration WHERE tenantidid = '$p_id'")->fetchAll(PDO::FETCH_ASSOC);

				}

			catch(PDOException $e)
				{
					echo $e->getMessage();
				}
				$pdo = null;
?-->


<!--------------------------------------------------------------------------------------------------------------------------------->

<?xml version="1.0" encoding="utf-8"?>
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
	<!--	<h1>Rental Service Company</h1> -->

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

<!--------------update the code here------------------------------------------>
				
	
	<?php

	include "pdo.inc";
		try
		{
			$rows = $pdo->query('SELECT review FROM tenant_registration ');
		}
		catch (PDOException $e)
		{
			  echo $e->getMessage();
		}

			echo '<form action="newreview.php" method="POST" name="myForm">';
			
			

		    //tenant id and property id here-----------------------------------------------------------------------------
			echo '<br><br>';
		    echo '&nbsp; Tenant ID :';
			echo '&nbsp; &nbsp;<select name="tenantid" >';
		    echo '<option value="1">1</option>';
		    echo '<br><br>';
		    echo '</select>';

		    echo '<br><br>';
		    echo '&nbsp; Property ID :';
			echo '&nbsp; &nbsp;<select name="propertyid" >';
		    echo '<option value="1">1</option>';
		    echo '<br><br>';
		    echo '</select>';




		    //time option here
		    echo '<br><br>';
		    echo '&nbsp; &nbsp;Open for Inspection Times & Please select the time';
		    echo '<br><br>';
			echo '&nbsp; &nbsp;<select name="timeOption" >';
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


		    echo '<p><b>&nbsp; Please give the reason when cancel the inspection time: </b></p>';
			echo '&nbsp; &nbsp; <textarea rows="10" cols="60" name="review" id="description" placeholder="Comment"></textarea>';
			echo '<br><br>';
			
		
			echo '&nbsp; &nbsp;<input type="submit" value="Submit">';
			echo "</form>";
	?>

	<?php
	include "pdo.inc";
	try
	{
		
		$result = $pdo->query('SELECT review, time
					FROM tenant_registration');

	}
			catch (PDOException $e) {
 				  echo $e->getMessage();
			}
	
		foreach ($result as $review) {
				echo '<br><br>';
				//echo '&nbsp&nbsp'.date("Y/m/d").'&nbsp&nbsp&nbsp';
				echo '&nbsp&nbsp'.date("Y/m/d H:i:s").'&nbsp&nbsp&nbsp';
				echo '<br>';
				echo '&nbsp&nbsp'.'Inspection Time : ';
				echo '<br>';
				echo '&nbsp&nbsp'.$review['time'];
				echo '<br>';
				echo '&nbsp&nbsp'.$review['review'];

				echo '<br>';
				echo '______________________________________________________________________'.'<br><br>';
				
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

