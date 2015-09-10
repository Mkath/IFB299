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
        <form name="registration">
          First Name:
          <input type="text" name="firstname" placeholder = "Enter First Name" style="width: 500px" onkeypress="invisible('firstnameMissing')"><br>
          <span id="firstnameMissing" style="color:red; visibility:hidden">*First Name is a required field</span>
          </br>
          Last Name:
          <input type="text" name="lastname" placeholder = "Enter Last Name" style="width: 500px" onkeypress="invisible('lastnameMissing')"><br>
          <span id="lastnameMissing" style="color:red; visibility:hidden">*Last Name is a required field</span>
          </br>
          Email:
          <input type="text" name="email" placeholder = "Enter Email Address" style="width: 500px" onkeypress="invisible('emailMissing')"><br>
          <span id="emailMissing" style="color:red; visibility:hidden">*Email Address is a required field</span>
          <br>
          Password:
          <input type="password" name="password" placeholder = "Enter Password" style="width: 500px">
          <br>
          Confirm Password:
          <input type="password" name="confirm_password" placeholder = "Confim Password" style="width: 500px" onkeypress="invisible('differentPW')"><br>
          <span id="differentPW" style="color:red; visibility:hidden">*Password is invalid! Ensure both fields are entered and identical.</span>
          <br>
          Date of Birth:<br>
          <input type="date" name="dob" placeholder = "yyyy-mm-dd" max="1997-12-31" style="width: 250px" onkeypress="invisible('dobError')"><br>
          <span id="dobError" style="color:red; visibility:hidden">*Date of Birth is invalid</span>
          </br>
          Phone Number:<br>
          <input type = "text" name = "phone" placeholder = "Enter Phone Number" style="width: 250px" onkeypress="invisible('phoneError')"><br>
          <span id="phoneError" style="color:red; visibility:hidden">*Phone Number is a required field</span>
          </br>
          Post Code:<br>
          <input type = "text" name = "postcode" placeholder = "Enter Post Code" style="width: 250px" onkeypress="invisible('postalError')"><br>
          <span id="postalError" style="color:red; visibility:hidden">*Post Code is a required field</span>
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
