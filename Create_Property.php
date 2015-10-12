<?php
include 'connection.php';

	//renew the session
	if(!isset($_SESSION)){
    session_start();
	}

	
	//redirect user if they are not the administrator. 
  if(!isset($_SESSION['e_id']) and (!isset($_SESSION['o_id']))) {
    echo '<script type="text/javascript">
    alert("Forbidden");
    window.location.href = "home.php";
    </script>';
  }
?>
<html xmlns="http://www.w3.org/1999/xhtml">

<head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
    <title> Welcome to Rent property </title>
    <link href="main_11.css" rel="stylesheet" type="text/css"/>
    <script src="jquery.js"></script>
    <script src="script.js"></script>
    <script type="text/javascript" src="main_javascript.js"></script>
</head>

<body>

<div id="outside">
	<div id="header">
		<br>

			<div id="Menu">
				<ul>
					<?php include 'menu.php'; ?>
				</ul>
			</div> <!--Menu -->

	</div> <!--header -->


	<div id="secondBanner">

		<img src="images/house3.jpg" width="770" height="90" alt="welcome to Property Service"/>
	</div> <!---secondBanner -->


	<div id="bigContent">
			<div id="secondContent">
        <div id="maindiv">

            <div id="formdiv">
                <h2>Property Information</h2>
                <hr>
                <form name="Upload" onsubmit="return validate_createproperty(Upload)" enctype="multipart/form-data" action="process_property_creation.php" method="post">
                  <p>
                    Primary Image of your Property: <br>Only JPEG,PNG,JPG extensions. Max size 100MB.<br>
                    <div id="filediv"><input name="file[]" type="file" id="file"/></div><br/>
                  <br>
                    <input type="button" id="add_more" class="upload" value="Add More Images"/>
                  </p>
                  <p>
                    Street Address<br>
                    <input type="text" name="address" placeholder = "123 example street" style="width: 500px" onkeypress="invisible('addressERROR')"><br>
                    <span id="addressERROR" style="color:red; visibility:hidden">*Address is a Required Field</span>
                  </p>
                  <p>
                    Suburb<br>
                    <input type="text" name="suburb" placeholder = "Suburb" style="width: 300px" onkeypress="invisible('suburbERROR')"><br>
                    <span id="suburbERROR" style="color:red; visibility:hidden">*Suburb is a Required Field</span>
                  </p>
                  <p>
                    Number of Bedrooms<br>
                    <input type="number" name="roomnumber" min="1" max="10" placeholder = "No." style="width: 50px" onclick="invisible('roomnumberERROR')">
                    <span id="roomnumberERROR" style="color:red; visibility:hidden">*Number of Bedrooms is a Required Field</span>
                  </p>
                  <p>
                    Propert Type<br>
                    <select name="property_type" style="width: 150px">
    				          <option value="house">House</option>
    				          <option value="apartment">Apartment</option>
    				          <option value="unit">Unit</option>
    				        </select>
                  </p>
                  <p>
                    Furnished?<br>
                    <input type="radio" name="furnished" value="1" checked="true">Yes
                    <input type="radio" name="furnished" value="0">No
                  </p>
                  <p>
                    Number of Bathrooms<br>
                    <input type="number" name="bathroom_number" min="1" max="10" placeholder = "No." style="width: 50px" onclick="invisible('bathroom_numberERROR')">
                    <span id="bathroom_numberERROR" style="color:red; visibility:hidden">*Number of Bathrooms is a Required Field</span>
                  </p>
                  <p>
                    Rent Amount<br>
                    $<input type="text" name="rent_amt" placeholder="200" style="width:30px" onkeypress="invisible('rent_amountERROR')"> p/week<br>
                    <span id="rent_amountERROR" style="color:red; visibility:hidden">*Rent Amount is a Required Field</span>
                  </p>
                  <p>
                    Link to Gumtree Advertisment (optional)<br>
                    <input type="url" name="gumtree_url" placeholder="www.gumtree.com.au/youradvertisment" style="width:500px">
                  </p>
                  <p>
                    Description of Property<br>
                    <input type="text" name="description" style="width: 500px; height: 100px" onkeypress="invisible('descriptionERROR')"><br>
                    <span id="descriptionERROR" style="color:red; visibility:hidden">*Description of Property is a Required Field</span>
                  </p>
                  <p>
                    1st Inspection Time<br>
                    <input type="text" name="inspection_time1" placeholder = "15 September 2015 12:00 - 12:15" style="width: 300px" onkeypress="invisible('inspection_time1ERROR')"><br>
                    <span id="inspection_time1ERROR" style="color:red; visibility:hidden">*1st Inspection Time is a Required Field</span>
                  </p>
                  <p>
                    2nd Inspection Time<br>
                    <input type="text" name="inspection_time2" placeholder = "16 September 2015 12:15 - 12:30" style="width: 300px" onkeypress="invisible('inspection_time2ERROR')"><br>
                    <span id="inspection_time2ERROR" style="color:red; visibility:hidden">*2nd Inspection Time is a Required Field</span>
                  </p>

                  <p>
                    <input type="submit" value="Create Property" name="submit" id="upload" class="upload"/>
                  </p>
                </form>
                <br/>
                <br/>
            </div>

		   <!-- Right side div -->

        </div>
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
