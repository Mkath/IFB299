<?xml version="1.0" encoding="utf-8"?>
<?php
  include 'connection.php';
  if(!isset($_SESSION)){
    session_start();
	}
  if(!isset($_SESSION['e_id']) and (!isset($_SESSION['o_id']))) {
    echo '<script type="text/javascript">
    alert("Forbidden");
    window.location.href = "home.php";
    </script>';
  }
  $propertyid = $_GET['ID'];
  // make a note of the current working directory relative to root.
  $directory_self = str_replace(basename($_SERVER['PHP_SELF']), '', $_SERVER['PHP_SELF']);

  // make a note of the location of the upload handler script
  $uploadHandler = 'http://' . $_SERVER['HTTP_HOST'] . $directory_self . "process_propertychanges.php?ID=$propertyid";

  // set a max file size for the html upload form
  $max_file_size = 30000; // size in bytes

  // now echo the html page

  //below grabs all the information for this property from the db

  try {
		//gets all their profile information from database
    $propertyid = $_GET['ID'];

		$conn = new PDO("mysql:host=$dbhost;dbname=$dbname", $dbuser, $dbpass);
		$conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
		$stmt = $conn->prepare('SELECT * FROM `property_details` WHERE `propertyid` = :ID');
		$stmt->bindParam(':ID', $propertyid, PDO::PARAM_STR);
		$stmt->execute();

		//assigns the information to local variables.
		foreach($stmt as $row)
		{

		  $_SESSION['street_address'] = $row['street_address'];
		  $_SESSION['suburb'] = $row['suburb'];
		  $_SESSION['number_rooms'] = $row['number_rooms'];
		  $_SESSION['property_type'] = $row['property_type'];
		  $_SESSION['furnished'] = $row['furnished'];
      $_SESSION['number_bathrooms'] = $row['number_bathrooms'];
		  $_SESSION['description'] = $row['description'];
      $_SESSION['rent_amt'] = $row['rent_amt'];
      if ($row['gumtree_url'] != ""){
        $_SESSION['gumtree_url'] = $row['gumtree_url'];
      }
		  $_SESSION['inspection_time1'] = $row['inspection_time1'];
		  $_SESSION['inspection_time2'] = $row['inspection_time2'];
		}

    $conn2 = new PDO("mysql:host=$dbhost;dbname=$dbname", $dbuser, $dbpass);
		$conn2->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
		$stmt2 = $conn2->prepare('SELECT * FROM `property_images` WHERE `propertyid` = :ID');
		$stmt2->bindParam(':ID', $propertyid, PDO::PARAM_STR);
		$stmt2->execute();
	}
	//errors if it cannot make a connection to the database
	catch(PDOException $e)
	{
		echo $e->getMessage();
	}
	$conn = null;
?>

<html xmlns="http://www.w3.org/1999/xhtml">
    <head>
        <!-- <meta http-equiv="content-type" content="text/html; charset=iso-8859-1"> -->

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
              <form id="Upload" name="Upload" action="<?php echo $uploadHandler ?>" onsubmit="return validate_propertychanges(Upload)" enctype="multipart/form-data" method="post">

                  <h1>
                      Property Information
                  </h1>
                  <p>
                    Street Address<br>
                    <input type="text" name="address" placeholder = "123 example street" style="width: 500px" onkeypress="invisible('addressERROR')" value="<?php
                    if(isset($_SESSION['street_address']))
                      echo ($_SESSION['street_address'])?>"/><br>
                    <span id="addressERROR" style="color:red; visibility:hidden">*Address is a Required Field</span>
                  </p>
                  <p>
                    Suburb<br>
                    <input type="text" name="suburb" placeholder = "Suburb" style="width: 300px" onkeypress="invisible('suburbERROR')" value="<?php
                    if(isset($_SESSION['suburb']))
                      echo ($_SESSION['suburb'])?>"/><br>
                    <span id="suburbERROR" style="color:red; visibility:hidden">*Suburb is a Required Field</span>
                  </p>
                  <p>
                    Number of Bedrooms<br>
                    <input type="number" name="roomnumber" min="1" max="10" placeholder = "No." style="width: 50px" onclick="invisible('roomnumberERROR')" value="<?php
                    if(isset($_SESSION['number_rooms']))
                      echo ($_SESSION['number_rooms'])?>"/><br>
                    <span id="roomnumberERROR" style="color:red; visibility:hidden">*Number of Bedrooms is a Required Field</span>
                  </p>
                  <p>
                    Property Type<br>
                    <select name="property_type" style="width: 150px">
                    <option value="<?php
                    if(isset($_SESSION['property_type']))
                      echo ($_SESSION['property_type'])?>"><?php
                      if(isset($_SESSION['property_type']))
                        echo ($_SESSION['property_type'])?></option>
    				          <option value="house">House</option>
    				          <option value="apartment">Apartment</option>
    				          <option value="unit">Unit</option>
    				        </select>
                  </p>
                  <p>
                    Furnished?<br>
                    <input type="radio" name="furnished" <?php if ($_SESSION['furnished'] == "1")
                      echo 'checked = "true"'?> value="1">Yes
                    <input type="radio" name="furnished" <?php if ($_SESSION['furnished'] == "0")
                      echo 'checked = "true"'?> value="0">No
                  </p>
                  <p>
                    Number of Bathrooms<br>
                    <input type="number" name="bathroom_number" min="1" max="10" placeholder = "No." style="width: 50px" onclick="invisible('bathroom_numberERROR')" value = "<?php
                    if(isset($_SESSION['number_bathrooms']))
                      echo ($_SESSION['number_bathrooms'])?>">
                    <span id="bathroom_numberERROR" style="color:red; visibility:hidden">*Number of Bathrooms is a Required Field</span>
                  </p>
                  <p>
                    Rent Amount<br>
                    $<input type="text" name="rent_amt" placeholder="200" style="width:30px" onkeypress="invisible('rent_amountERROR')" value = "<?php
                    if(isset($_SESSION['rent_amt']))
                      echo ($_SESSION['rent_amt'])?>"> p/week<br>
                    <span id="rent_amountERROR" style="color:red; visibility:hidden">*Rent Amount is a Required Field</span>
                  </p>
                  <p>
                    Link to Gumtree Advertisment (optional)<br>
                    <input type="url" name="gumtree_url" placeholder="www.gumtree.com.au/youradvertisment" style="width:500px" value = "<?php
                    if(isset($_SESSION['gumtree_url']))
                      echo ($_SESSION['gumtree_url'])?>">
                  </p>
                  <p>
                    Description of Property<br>
                    <input type="text" name="description" style="width: 500px; height: 100px" onkeypress="invisible('descriptionERROR')" value = "<?php
                    if(isset($_SESSION['description']))
                      echo ($_SESSION['description'])?>"><br>
                    <span id="descriptionERROR" style="color:red; visibility:hidden">*Description of Property is a Required Field</span>
                  </p>
                  <p>
                    1st Inspection Time<br>
                    <input type="text" name="inspection_time1" placeholder = "15 September 2015 12:00 - 12:15" style="width: 300px" onkeypress="invisible('inspection_time1ERROR')" value = "<?php
                    if(isset($_SESSION['inspection_time1']))
                      echo ($_SESSION['inspection_time1'])?>"><br>
                    <span id="inspection_time1ERROR" style="color:red; visibility:hidden">*1st Inspection Time is a Required Field</span>
                  </p>
                  <p>
                    2nd Inspection Time<br>
                    <input type="text" name="inspection_time2" placeholder = "16 September 2015 12:15 - 12:30" style="width: 300px" onkeypress="invisible('inspection_time2ERROR')" value = "<?php
                    if(isset($_SESSION['inspection_time2']))
                      echo ($_SESSION['inspection_time2'])?>"><br>
                    <span id="inspection_time2ERROR" style="color:red; visibility:hidden">*2nd Inspection Time is a Required Field</span>
                  </p>
                  <p>
                      <input type="hidden" name="MAX_FILE_SIZE" value="<?php echo $max_file_size ?>">
                  </p>
                  <br>
                  <p>
                    Your Current Property Images<br>
                    <?php
                      foreach ($stmt2 as $images){
                        //echo '<input type="text" name="image_description" placeholder = "Description" style="width: 150px" value = ', $images["image_description"],'><br>';
                        echo '<a href="/images/', $images['image_path'],'" target="_blank" >';
            						echo '<img style="float: left; margin: 30px 30px 30px 30px; width: 150px;height: 100px;border:0" src="/images/',$images['image_path'], '" alt="', $images['image_description'], '">';
            						echo '</a>';
                      }
                    ?>
                  </p>
                  <p>
                  </p>
                  <br>
                  Images may be changed in the section below
                  </br>

                  <p>
                      <label for="file">Primary Image of your Property:</label>
                      <input id="file" type="file" name="file" onclick="invisible('fileERROR')"><br>
                      <span id="fileERROR" style="color:red; visibility:hidden">*An image of your property is required</span>
                  </p>
                  <p>
                    Image Description:
                    <input type="text" name="image_description" placeholder = "Description" style="width: 150px" onkeypress="invisible('image_descriptionERROR')"><br>
                    <span id="image_descriptionERROR" style="color:red; visibility:hidden">*An description of your property is required</span>
                  </p>
                  <p>
                    <label for="file">Secondary set of images of your Property (Optional, Max. 3):</label>
                    <input type="text" name="image_description2" placeholder = "Description" style="width: 150px" onkeypress="invisible('image_description2ERROR')"><input id="file2" type="file" name="file2">
                    <input type="text" name="image_description3" placeholder = "Description" style="width: 150px" onkeypress="invisible('image_description2ERROR')"><input id="file3" type="file" name="file3">
                    <input type="text" name="image_description4" placeholder = "Description" style="width: 150px" onkeypress="invisible('image_description2ERROR')"><input id="file4" type="file" name="file4"><br>
                    <span id="image_description2ERROR" style="color:red; visibility:hidden">*An description of your chosen image is required</span>
                  </p>

                  <p>
                      &nbsp; &nbsp; &nbsp; &nbsp; &nbsp;&nbsp; &nbsp; &nbsp; &nbsp; &nbsp;<input id="submit" type="submit" name="submit" value="Save Changes">
                  </p>

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
