<html xmlns="http://www.w3.org/1999/xhtml">
<?php
include 'connection.php';

	if(!isset($_SESSION)){
    session_start();
	}
  if(!isset($_SESSION['t_id'])) {
    echo '<script type="text/javascript">
    alert("Forbidden");
    window.location.href = "signin.php";
    </script>';
  }
?>
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
    <title> Welcome to Rent property </title>
    <link href="main_11.css" rel="stylesheet" type="text/css"/>
    <script type="text/javascript" src="main_javascript.js"></script>
</head>

<body>

<div id="outside">
	<div id="header">
		<br>
		

			<div id="Menu">
				<?php include 'menu.php'; ?>
			</div> <!--Menu -->

	</div> <!--header -->


	<div id="secondBanner">

		<img src="images/house3.jpg" width="770" height="90" alt="welcome to Property Service"/>
	</div> <!---secondBanner -->
  <?php

	try {
		//gets all their profile information from database
		$tenantid = $_SESSION['t_id'];
		$conn = new PDO("mysql:host=$dbhost;dbname=$dbname", $dbuser, $dbpass);
		$conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
		$stmt = $conn->prepare('SELECT * FROM `tenant_details` WHERE `tenantid` = :tid');
		$stmt->bindParam(':tid', $tenantid, PDO::PARAM_STR);
		$stmt->execute();
		
		//assigns the information to local variables.
		foreach($stmt as $row)
		{

		  $_SESSION['FirstName'] = $row['tenant_firstname'];
		  $_SESSION['LastName'] = $row['tenant_lastname'];
		  $_SESSION['Email'] = $row['tenant_email'];
		  $_SESSION['Dob'] = $row['tenant_dob'];
		  $_SESSION['PCode'] = $row['tenant_postal'];
		  $_SESSION['Phone'] = $row['tenant_phone'];
		}
	}
	//errors if it cannot make a connection to the database
	catch(PDOException $e)
	{
		echo $e->getMessage();
	}
	$conn = null;
	
	try {
		//gets all the information about their chosen favourites
		$pdo = new PDO("mysql:host=$dbhost;dbname=$dbname", $dbuser, $dbpass);
		$pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
		$favourites = $pdo->prepare('SELECT * FROM `tenant_favourites` WHERE `tenantid` = :tid');
		$favourites->bindParam(':tid', $tenantid, PDO::PARAM_STR);
		$favourites->execute();
		
		//counts how many favourites found (if any)
		$pdo1 = new PDO("mysql:host=$dbhost;dbname=$dbname", $dbuser, $dbpass);
		$pdo1->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
		$recCount = $pdo1->prepare('SELECT count(*) FROM `tenant_favourites` WHERE `tenantid` = :tid');
		$recCount->bindParam(':tid', $tenantid, PDO::PARAM_STR);
		$recCount->execute();
		$num_favs = $recCount->fetchColumn();
				
	}
	//errors if it cannot make a connection to the database
	catch(PDOException $e)
		{
			echo $e->getMessage();
		}
		$pdo = null;	

	try {
		//gets all the information about amin assign to employee  
		$pdo = new PDO("mysql:host=$dbhost;dbname=$dbname", $dbuser, $dbpass);
		$pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
		$houses = $pdo->prepare('SELECT * FROM `property_details` WHERE `tenantid` = :tid');
		$houses->bindParam(':tid', $tenantid, PDO::PARAM_STR);
		$houses->execute();
		
		
		//counts how many tasks found (if any)
		$recCount = $pdo->prepare('SELECT count(*) FROM `property_details` WHERE `tenantid` = :tid');		
		$recCount->bindParam(':tid', $tenantid, PDO::PARAM_STR);
		$recCount->execute();
		$count_houses = $recCount->fetchColumn();
		
				
	}
	//errors if it cannot make a connection to the database
	catch(PDOException $e)
		{
			echo $e->getMessage();
		}
		
	try {
		//gets all the information about amin assign to employee  
		$pdo = new PDO("mysql:host=$dbhost;dbname=$dbname", $dbuser, $dbpass);
		$pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
		$inspection_regs = $pdo->prepare('SELECT * FROM `tenant_registration` WHERE `tenantid` = :tid');
		$inspection_regs->bindParam(':tid', $tenantid, PDO::PARAM_STR);
		$inspection_regs->execute();
		
		
		//counts how many tasks found (if any)
		$recCount = $pdo->prepare('SELECT count(*) FROM `tenant_registration` WHERE `tenantid` = :tid');		
		$recCount->bindParam(':tid', $tenantid, PDO::PARAM_STR);
		$recCount->execute();
		$count_register = $recCount->fetchColumn();
		
				
	}
	//errors if it cannot make a connection to the database
	catch(PDOException $e)
		{
			echo $e->getMessage();
		}			
  ?>

	<div id="bigContent">
			<div id="secondContent">
        <h3>Your Details</h3><br>
        <form name="profile_changes" method="POST"  action="process_profilechanges.php" onsubmit="return validate_profilechanges(profile_changes)">
          First Name
          <input type="text" name="firstname" style="width: 500px" onkeypress="invisible('firstnameMissing')" value="<?php
          if(isset($_SESSION['FirstName']))
            echo ($_SESSION['FirstName'])?>"/><br>
          <span id="firstnameMissing" style="color:red; visibility:hidden">*First Name is a required field</span>
          <?php if (isset($errors['firstname'])) echo $errors['firstname'] ?>
          </br>
          Last Name
          <input type="text" name="lastname" style="width: 500px" onkeypress="invisible('lastnameMissing')" value="<?php
          if(isset($_SESSION['LastName']))
            echo ($_SESSION['LastName'])?>"/><br>
          <span id="lastnameMissing" style="color:red; visibility:hidden">*Last Name is a required field</span>
          <?php if (isset($errors['lastname'])) echo $errors['lastname'] ?>
          </br>
          Email
          <input type="text" name="email" style="width: 500px" onkeypress="invisible('emailMissing')"value="<?php
          if(isset($_SESSION['Email']))
            echo ($_SESSION['Email'])?>"/><br>
          <span id="emailMissing" style="color:red; visibility:hidden">*Email Address is a required field</span>
          <?php if (isset($errors['email'])) echo $errors['email'] ?>
          <br>
          Date of Birth<br>
          <input type="date" name="dob" max="1997-12-31" style="width: 250px" onkeypress="invisible('dobError')" value="<?php
          if(isset($_SESSION['Dob']))
            echo ($_SESSION['Dob'])?>"/><br>
          <span id="dobError" style="color:red; visibility:hidden">*Date of Birth is invalid</span>
          <?php if (isset($errors['dob'])) echo $errors['dob'] ?>
          </br>
          Phone Number:<br>
          <input type = "text" name = "phone" placeholder = "Enter Phone Number" style="width: 250px" onkeypress="invisible('phoneError')" value="<?php
          if(isset($_SESSION['Phone']))
            echo ($_SESSION['Phone'])?>"/><br>
          <span id="phoneError" style="color:red; visibility:hidden">*Phone Number is a required field</span>
          <?php if (isset($errors['phone'])) echo $errors['phone'] ?>
          </br>
          Post Code:<br>
          <input type = "text" name = "postcode" placeholder = "Enter Post Code" style="width: 250px" onkeypress="invisible('postalError')" value="<?php
          if(isset($_SESSION['PCode']))
            echo ($_SESSION['PCode'])?>"/><br>
          <span id="postalError" style="color:red; visibility:hidden">*Post Code is a required field</span>
          <?php if (isset($errors['postcode'])) echo $errors['postcode'] ?>
          </br>
		  <?php
		  
		   //only create table if any favourites exist for that tenant
			if ($num_favs > 0)
			{
				//create header of the table
				echo '<HR></HR>';
				echo '<H3>Your favourite pages</H3>';
				echo '<Br>';
				echo '<table style="width:100%">';
				echo '<tr><td>Property Address</td>';
				//echo '<td>Inspection Times</td>';
				echo '<td style="text-align: center; vertical-align: middle">Remove</td></tr>';
				
				//loop through all the favourites found.
				foreach($favourites  as $favourite)
				{
					$p_id = $favourite['propertyid'];
					//echo $p_id;
					try
					{
						$pdo2 = new PDO("mysql:host=$dbhost;dbname=$dbname",$dbuser,$dbpass);
						$pdo2->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
						$properties = $pdo2->query("SELECT * FROM property_details WHERE propertyid = '$p_id' ORDER BY SUBURB")->fetchAll(PDO::FETCH_ASSOC);
						
						//get the property information based on the favourite.
						foreach ($properties as $property)
						{
							echo '<td><a href="properties_page.php?ID=', $property['propertyid'], '">', $property['street_address'],", ", $property['suburb'] , '</a></td>';
		
							echo  '<td style="text-align: center; vertical-align: middle">';
							echo '<input type="checkbox" name="favourite[]" value="', $property['propertyid'], '"></td>';
						
						}
						
					}
					catch(PDOException $e)
					{
						echo $e->getMessage();
					}
					//end tags and close off pdo
					echo '</tr>';
					$pdo2 = null;					
				}	
				echo '</table>';
			}
			
		   //only display all the upcoming inspections for a tenants property
			if ($count_houses > 0)
			{
				//create header of the table
				echo '<HR></HR>';
				echo '<H3>Upcoming inspections for the property you live</H3>';
				echo '<Br>';
				echo '<table style="width:100%">';

				
				
				//I keep the remove button here as admin might use it, for example a staff is sick on 5 sep 2015, need to re-assign to other staff
				//echo '<td style="text-align: center; vertical-align: middle">Remove</td></tr>';
				
				//loop through all the admin assigned list here.
				foreach ($houses as $property)
				{
					echo '<tr>';
					echo '<td colspan = "2"><a href="properties_page.php?ID=', $property['propertyid'], '">', $property['street_address'],", ", $property['suburb'] , '</a></td>';
					echo '</tr>';
					echo '<tr>';
					echo '<td>', $property['inspection_time1'], '</td>';
					echo '</tr>';
					echo '<tr>';
					echo '<td>', $property['inspection_time2'], '</td>';
					echo '</tr>';
				}
						
				//end tags
			
				echo '</table>';
			}			
			if ($count_register > 0)
			{
				echo '<HR></HR>';
				echo '<H3>Registered inspections times</H3>';
				echo '<Br>';
				echo '<table style="width:100%">';
				
				foreach ($inspection_regs as $register)
				{
					$p_id = $register['propertyid'];
					try
					{
						$pdo2 = new PDO("mysql:host=$dbhost;dbname=$dbname",$dbuser,$dbpass);
						$pdo2->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
						$properties = $pdo2->query("SELECT * FROM property_details WHERE propertyid = '$p_id' ORDER BY SUBURB")->fetchAll(PDO::FETCH_ASSOC);
					
						foreach ($properties as $property)
						{
							echo '<tr>';
							echo '<td colspan = "2"><a href="properties_page.php?ID=', $property['propertyid'], '">', $property['street_address'],", ", $property['suburb'] , '</a></td>';
							
						}
						echo '<td>', $register['time'], '</td>';
					}
					catch(PDOException $e)
					{
						echo $e->getMessage();
					}
					
				}
				echo '</tr>';
			}
				echo '</table>';
		  ?>
		  
		  </br>
          <input type="submit" value="Save Changes" style="width: 500px">
        </form>



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
