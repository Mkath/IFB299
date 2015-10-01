<html xmlns="http://www.w3.org/1999/xhtml">
<?php

  include 'connection.php';
  
  if(!isset($_SESSION)){
    session_start();
  }

  if(!isset($_SESSION['e_id'])) {
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
		//allows admin to make changes to any employees profile including their own.
  		if($_SESSION['UserType'] == "Admin")
		{
			if (isset($_GET['ID']))
			{
				$employeeid = $_GET['ID'];
			}
			else
			{
				$employeeid = $_SESSION['e_id'];
			}
		}
		else
		{
			$employeeid = $_SESSION['e_id'];
		}
		
	try {
		//gets all employee profile information from database
		
		$conn = new PDO("mysql:host=$dbhost;dbname=$dbname", $dbuser, $dbpass);
		$conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
		$stmt = $conn->prepare('SELECT * FROM `employee_details` WHERE `employeeid` = :eid');
		$stmt->bindParam(':eid', $employeeid, PDO::PARAM_STR);
		$stmt->execute();
		
		//assigns the information to local variables.
		foreach($stmt as $row)
		{
		
		  $_SESSION['FirstName'] = $row['employee_firstname'];
		  $_SESSION['LastName'] = $row['employee_lastname'];
		  $_SESSION['Email'] = $row['employee_email'];
		  $_SESSION['Dob'] = $row['employee_dob'];
		  $_SESSION['PCode'] = $row['employee_postal'];
		  $_SESSION['Phone'] = $row['employee_phone'];
		}
	}
	//errors if it cannot make a connection to the database
	catch(PDOException $e)
	{
		echo $e->getMessage();
	}
	$conn = null;

	
	try {
		//gets all the information about admin assign to employee  
		$pdo = new PDO("mysql:host=$dbhost;dbname=$dbname", $dbuser, $dbpass);
		$pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
		$assignemployees = $pdo->prepare('SELECT * FROM `employee_property` WHERE `employeeid` = :eid');
		$assignemployees->bindParam(':eid', $employeeid, PDO::PARAM_STR);
		$assignemployees->execute();
		
		//counts how many tasks found (if any)
		$recCount = $pdo->prepare('SELECT count(*) FROM `employee_property` WHERE `employeeid` = :eid');		
		$recCount->bindParam(':eid', $employeeid, PDO::PARAM_STR);
		$recCount->execute();
		$num_favs = $recCount->fetchColumn();
		
				
	}
	//errors if it cannot make a connection to the database
	catch(PDOException $e)
		{
			echo $e->getMessage();
		}
		//$pdo = null;


	
  ?>

	<div id="bigContent">
			<div id="secondContent">
			<?php
			try
			{
				
				//If the user is the admin account gives them the choice choose an employee
				 if($_SESSION['UserType'] == "Admin") 
				 {
					$employeelist = $pdo->query("SELECT * FROM employee_details")->fetchAll(PDO::FETCH_ASSOC);

					echo '<select name="employees"  onchange="window.location.href=\'employee_profile.php?ID=\'+this.value">';
					echo '<option value="',$employeeid,'">Select Employee</option>';
					foreach ($employeelist as $employee)
					{
						echo '<option value="',$employee['employeeid'],'">',$employee['employee_firstname'],' ', $employee['employee_lastname'], '</option>';
						$e_name = $employee['employee_firstname'];
					}
					echo '</select>';
				 }
			}
			catch(PDOException $e)
			{
				echo $e->getMessage();
			}
			$pdo = null;
			
			if ($employeeid != $_SESSION['e_id'])
			{
				echo '<h3>Employee Details</h3><br>';
			}
			else
			{
				echo '<h3>Your Details</h3><br>';
			}
		?>
        <form name="profile_changes" method="POST"  action="process_employee_changes.php?ID=<?php echo $employeeid?>" onsubmit="return validate_profilechanges(profile_changes)">
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
	  
		   
		   //only create table if any task list assign to staff
			if ($num_favs > 0)
			{
				//create header of the table
				echo '<HR></HR>';
				echo '<H3>The Current Inspection Times</H3>';
				echo '<Br>';
				echo '<table style="width:100%">';
				echo '<tr><td>Property Address</td>';
				echo '<td>Inspection Times</td>';
				//I keep the remove button here as admin might use it, for example a staff is sick on 5 sep 2015, need to re-assign to other staff
				//echo '<td style="text-align: center; vertical-align: middle">Remove</td></tr>';
				echo '</tr>';
				//loop through all the admin assigned list here.
				foreach ($assignemployees  as $assignemployee)
				{
					$p_id = $assignemployee['propertyid'];
					$e_id = $assignemployee['employeeid'];
					//echo $p_id;
					try
					{
						$pdo2 = new PDO("mysql:host=$dbhost;dbname=$dbname",$dbuser,$dbpass);
						$pdo2->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
						$properties = $pdo2->query("SELECT * FROM property_details WHERE propertyid = '$p_id' ORDER BY SUBURB")->fetchAll(PDO::FETCH_ASSOC);
						$employees = $pdo2->query("SELECT * FROM employee_details WHERE employeeid = '$e_id' ")->fetchAll(PDO::FETCH_ASSOC);
						//get the property information based on assignemployees.
						foreach ($properties as $property)
						{
							echo '<td><a href="properties_page.php?ID=', $property['propertyid'], '">', $property['street_address'],", ", $property['suburb'] , '</a></td>';
							echo '<td>', $property['inspection_time1'], ' & ',  $property['inspection_time2'] ,'</td>';
							echo  '<td style="text-align: center; vertical-align: middle">';
							//echo '<input type="checkbox" name="assignemployee[]" value="', $property['propertyid'], '"></td>';
						
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
