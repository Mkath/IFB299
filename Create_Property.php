<?xml version="1.0" encoding="utf-8"?>

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
					<li><a href="home.html" class="current"> Home </a> </li>
					<li><a href="properties_1.html" class="current"> Properties </a> </li>
					<li><a href="contactus.html" class="current"> Contact us </a> </li>				
				</ul>
			</div> <!--Menu -->
			
	</div> <!--header -->

	
	<div id="secondBanner">

		<img src="images/house3.jpg" width="770" height="90" alt="welcome to Property Service"/>
	</div> <!---secondBanner -->


	<div id="bigContent">
			<div id="secondContent"> 
				<div id="searchForm">

	  				<form name="Search" onsubmit="return validate(Search)" method="GET" action="properties_1.php">
	  				<br>
	  				&nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp;Search Properties:<br>
	  				&nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp;<input type="text" name="street_address" notrequired placeholder="Enter Street Address" size = "50" maxlength = "100" onkeypress="invisible('suburbMissing')">
	          			<br>
	          			&nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp;<span id="suburbMissing" style="color:red; visibility:hidden">*'Suburb' is a required field</span>
	  				<br>
	  				&nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp;<input type="text" name="Suburb" notrequired placeholder="Enter Suburb" size = "50" maxlength = "100" onkeypress="invisible('suburbMissing')">
	          			<br>
	          			&nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp;<span id="suburbMissing" style="color:red; visibility:hidden">*'Suburb' is a required field</span>
	  				<br>
	  				&nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp;<input type="text" name="Bedrooms" notrequired placeholder="Enter number of rooms" size = "50" maxlength = "100" onkeypress="invisible('suburbMissing')">
	          			<br>
	          			&nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp;<span id="suburbMissing" style="color:red; visibility:hidden">*'Suburb' is a required field</span>
	  				<br>					
				        <br>
				         Property Type
						 <p>
				        <select name="ptype">
				          <option value="Unit">Unit</option>
				          <option value="House">House</option>
				          <option value="apartment">Apartment</option>
				        </select>
						</p>
				  	<br>
	  				Furnished<p> <input type="radio" name="furnished" value="TRUE">Yes
	  				<br>
	  				<input type="radio" name="furnished" value="2">No
	  				<br>
					</p>
	  				&nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp;<input type="text" name="Bathrooms" notrequired placeholder="Enter Number of Bathrooms" size = "50" maxlength = "100" onkeypress="invisible('suburbMissing')">
	          			<br>
	          			&nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp;<span id="suburbMissing" style="color:red; visibility:hidden">*'Suburb' is a required field</span>
	  				<br>					
	  				&nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp;<input type="text" name="Bathrooms" notrequired placeholder="Enter Rent Amount" size = "50" maxlength = "100" onkeypress="invisible('suburbMissing')">
	          			<br>
	          			&nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp;<span id="suburbMissing" style="color:red; visibility:hidden">*'Suburb' is a required field</span>					
			        </div> <!-- -->
				&nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; <input type="submit" value="Search" onclick="return val();"/>
				&nbsp; &nbsp; &nbsp; &nbsp; <input type="reset" value="Reset"/>
				<br>
				<br>
				</form>
	
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

