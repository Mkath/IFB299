<html xmlns="http://www.w3.org/1999/xhtml">
<?php
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
    <link href="main_9.css" rel="stylesheet" type="text/css"/>
    <script type="text/javascript" src="main_javascript.js"></script>
</head>

<body>

<div id="outside">
	<div id="header">
		<br>
		<h1>Rental Service Company</h1>

			<div id="Menu">
				<ul>
          <li><a href="home.php" class="current"> Home </a> </li>
					<li><a href="properties_1.html" class="current"> Properties </a> </li>
					<li><a href="contactus.html" class="current"> Contact us </a> </li>
					<?php
  					if (isset($_SESSION['FirstName']) AND isset($_SESSION['t_id']))
  					{
  						echo  '<li><a href="tenant_profile.php" class="current"> Profile </a> </li>';
  						echo  '<li><a href="signout.php" class="current"> Sign Out </a> </li>';

  					}
          ?>
				</ul>
			</div> <!--Menu -->

	</div> <!--header -->


	<div id="secondBanner">

		<img src="images/house3.jpg" width="770" height="90" alt="welcome to Property Service"/>
	</div> <!---secondBanner -->
  <?php
  /*
    $dbhost 	= "localhost";
    $dbname		= "1008545";
    $dbuser		= "1008545";
    $dbpass		= "IFB299GROUP93";


    $dbhost 	= "localhost";
    $dbname		= "property_management";
    $dbuser		= "root";
    $dbpass		= "6Chain9123";
    */

    $dbhost 	= "localhost";
    $dbname		= "property_management";
    $dbuser		= "root";
    $dbpass		= "";


    $tenantid = $_SESSION['t_id'];
    $conn = new PDO("mysql:host=$dbhost;dbname=$dbname", $dbuser, $dbpass);
    $stmt = $conn->prepare('SELECT * FROM `tenant_details` WHERE `tenantid` = :tid');
    $stmt->bindParam(':tid', $tenantid, PDO::PARAM_STR);
    $stmt->execute();
    foreach($stmt as $row)
    {

      $_SESSION['FirstName'] = $row['tenant_firstname'];
      $_SESSION['LastName'] = $row['tenant_lastname'];
      $_SESSION['Email'] = $row['tenant_email'];
      $_SESSION['Dob'] = $row['tenant_dob'];
      $_SESSION['PCode'] = $row['tenant_postal'];
      $_SESSION['Phone'] = $row['tenant_phone'];
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
