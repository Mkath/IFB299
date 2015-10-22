<html xmlns="http://www.w3.org/1999/xhtml">
<?php
	if(!isset($_SESSION)){
    session_start();
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


	<div id="bigContent">
			<div id="secondContent">
				<div id="searchForm">

	  				<form name="Search" onsubmit="return validate(Search)" method="GET" action="properties_1.php">
	  				<br>
	  				&nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp;Search Properties:<br>
	  				&nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp;<input type="text" name="venuename" notrequired placeholder="Enter Suburb" size = "50" maxlength = "100" onkeypress="invisible('suburbMissing')">
	          			<br>
	          			&nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp;<span id="suburbMissing" style="color:red; visibility:hidden">*'Suburb' is a required field</span>
	  				<br>
	  				&nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; <input type="checkbox" name="type[]" value="House" checked="checked">House
	  				<br>
	  				&nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; <input type="checkbox" name="type[]" value="Apartment">Apartment
	  				<br>
	  				&nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; <input type="checkbox" name="type[]" value="Unit">Unit
	  				<br>
					<br>
	  				&nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; <input type="checkbox" name="roomnumber[]" checked="checked" value="1">One room
	  				<br>
	  				&nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; <input type="checkbox" name="roomnumber[]" value="2">Two rooms
	  				<br>
	  				&nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; <input type="checkbox" name="roomnumber[]" value="3">Three rooms
	  				<br>
	  				&nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; <input type="checkbox" name="roomnumber[]" value="4|More">Four rooms and more
	  				<br>
					<br>
	  				&nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; <input type="checkbox" name="bathrooms[]" checked="checked" value="1">One bathroom
	  				<br>
	  				&nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; <input type="checkbox" name="bathrooms[]" value="2">Two bathrooms
	  				<br>
	  				&nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; <input type="checkbox" name="bathrooms[]" value="3">Three bathrooms
	  				<br>
	  				&nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; <input type="checkbox" name="bathrooms[]" value="4|More">Four bathrooms and more
	  				<br>
					<br>
	  				&nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; <input type="checkbox" name="furnishedtype[]" value="0" checked="checked">Unfurnished
	  				<br>
	  				&nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; <input type="checkbox" name="furnishedtype[]" value="1">Furnished
	  				<br>

				        <br>
				        &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; Minumum Rent per Week
				        <select name="min">
				          <option value="0">Min</option>
				          <option value="99">$100</option>
				          <option value="200">$200</option>
				          <option value="300">$300</option>
				          <option value="400">$400</option>
				        </select>
				  	<br>
				        &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; Maximum Rent per Week
				        <select name="max">
					        <option value="Max">Max</option>
					        <option value="200">$200</option>
					        <option value="300">$300</option>
					        <option value="400">$400</option>
					        <option value="400">$500</option>
					        <option value="400">$600</option>
					        <option value="400">$700</option>
					        <option value="400">$800</option>
					        <option value="400">$900</option>
							<option value="1000">$1000</option>
				        </select>
			        </div> <!--searchForm -->
				&nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; <input type="submit" value="Search" onclick="return val();"/>
				&nbsp; &nbsp; &nbsp; &nbsp; <input type="reset" value="Reset"/>
				<br>
				<br>
				</form>


				<h1>About Us</h1>
				<p>
				At Rental Service Estate Agents, we aim to be the best. We strive to shine in every area of our business, continually reinventing ourselves as we find better ways to achieve our clients' goals. We are a learning organisation. We regularly review our structure, systems and processes, asking ourselves: How can we improve our service to our clients?
				</p>
				<p>
				What service we provide?
				</p>
				<p>
				<ul>
				    <li>List all house information</li>
				    <li>News information</li>
				    <li>Quality service</li>
				    <li>... and much more!</li>
				</ul>
				</p>

			</div>

				<div id="news">
					<?php
					if ( isset($_SESSION['FirstName']))
					{
						//check to see what type of user they are owner/tenant/employee and create a view property link on the home page
						echo "<br>Welcome, ", $_SESSION['FirstName'], "</br>";
						if (isset($_SESSION['e_id']))
						{
							echo '<a href="employee_profile.php?ID=',$_SESSION['e_id'],'">View profile</a><p>';
						}
						elseif (isset($_SESSION['o_id']))
						{
							echo '<a href="owner_profile.php?ID=',$_SESSION['o_id'],'">View profile</a><p>';
						}
						else
						{
							echo '<a href="tenant_profile.php" class="current"> View Profile </a>';
						}
						
						/*if ($_SESSION['UserType'] != "Owner"){
							echo '| <a href="create_property.php" class="current"> Create New Property </a>';
						} */
					}
					?>
					<h3> News </h3>

					<img src="images/watch1.png" width="200" height="160" alt="watch1" />
					<h3> Organise your property search with new wearable app</h3>
					<p>
					Whether you’re looking to buy or rent property,
					our Android Wear app will help you land your
					dream home.
					</p>
					<p>
					The new Android Wear property app sends you interactive reminders about upcoming open for inspections and auctions of saved properties.
					</p>


					<h3> Find a property that suits your needs</h3>
					<p>
					Discover a home for your lifestyle and budget, in suburbs you may not have previously considered
					</p>

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
