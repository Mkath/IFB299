<html xmlns="http://www.w3.org/1999/xhtml">

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
        <h3>Create an Account</h3><br>
        <form name="registration" method="POST"  action="process_registration.php" onsubmit="return validate_registration(registration)">
          First Name:
          <input type="text" name="firstname" placeholder = "Enter First Name" style="width: 500px" onkeypress="invisible('firstnameMissing')" value="<?php
          if(isset($_POST['firstname']))
            echo htmlspecialchars($_POST['firstname'])?>"/><br>
          <span id="firstnameMissing" style="color:red; visibility:hidden">*First Name is a required field</span>
          <?php if (isset($errors['firstname'])) echo $errors['firstname'] ?>
          </br>
          Last Name:
          <input type="text" name="lastname" placeholder = "Enter Last Name" style="width: 500px" onkeypress="invisible('lastnameMissing')" value="<?php
          if(isset($_POST['lastname']))
            echo htmlspecialchars($_POST['lastname'])?>"/><br>
          <span id="lastnameMissing" style="color:red; visibility:hidden">*Last Name is a required field</span>
          <?php if (isset($errors['lastname'])) echo $errors['lastname'] ?>
          </br>
          Email:
          <input type="text" name="email" placeholder = "Enter Email Address" style="width: 500px" onkeypress="invisible('emailMissing')"value="<?php
          if(isset($_POST['email']))
            echo htmlspecialchars($_POST['email'])?>"/><br>
          <span id="emailMissing" style="color:red; visibility:hidden">*Email Address is a required field</span>
          <?php if (isset($errors['email'])) echo $errors['email'] ?>
          <br>
          Username:
          <input type="text" name="username" placeholder = "Enter Username" style="width: 500px" onkeypress="invisible('usernameMissing')" value="<?php
          if(isset($_POST['username']))
            echo htmlspecialchars($_POST['username'])?>"/><br>
          <span id="usernameMissing" style="color:red; visibility:hidden">*Username is a required field</span>
          <?php if (isset($errors['username'])) echo $errors['username'] ?>
          </br>
          Password:
          <input type="password" name="password" placeholder = "Enter Password" style="width: 500px"/>
          <br>
          <?php if (isset($errors['password'])) echo $errors['password'] ?><br>
          Confirm Password:
          <input type="password" name="confirm_password" placeholder = "Confirm Password" style="width: 500px" onkeypress="invisible('differentPW')"><br>
          <span id="differentPW" style="color:red; visibility:hidden">*Password is invalid! Ensure both fields are entered and identical.</span>
          <br>
          Date of Birth:<br>
          <input type="date" name="dob" placeholder = "yyyy-mm-dd" max="1997-12-31" style="width: 250px" onkeypress="invisible('dobError')" value="<?php
          if(isset($_POST['dob']))
            echo htmlspecialchars($_POST['dob'])?>"/><br>
          <span id="dobError" style="color:red; visibility:hidden">*Date of Birth is invalid</span>
          <?php if (isset($errors['dob'])) echo $errors['dob'] ?>
          </br>
          Phone Number:<br>
          <input type = "text" name = "phone" placeholder = "Enter Phone Number" style="width: 250px" onkeypress="invisible('phoneError')" value="<?php
          if(isset($_POST['phone']))
            echo htmlspecialchars($_POST['phone'])?>"/><br>
          <span id="phoneError" style="color:red; visibility:hidden">*Phone Number is a required field</span>
          <?php if (isset($errors['phone'])) echo $errors['phone'] ?>
          </br>
          Post Code:<br>
          <input type = "text" name = "postcode" placeholder = "Enter Post Code" style="width: 250px" onkeypress="invisible('postalError')" value="<?php
          if(isset($_POST['postcode']))
            echo htmlspecialchars($_POST['postcode'])?>"/><br>
          <span id="postalError" style="color:red; visibility:hidden">*Post Code is a required field</span>
          <?php if (isset($errors['postcode'])) echo $errors['postcode'] ?>
          </br>
          <input type="submit" value="Create Account" style="width: 500px">
          <p>
          <input type="reset" value="Reset" style="width: 500px">
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
