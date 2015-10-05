<?xml version="1.0" encoding="utf-8"?>
<?php
  include 'connection.php';
  // make a note of the current working directory relative to root.
  $directory_self = str_replace(basename($_SERVER['PHP_SELF']), '', $_SERVER['PHP_SELF']);

  // make a note of the location of the upload handler script
  $uploadHandler = 'http://' . $_SERVER['HTTP_HOST'] . $directory_self . 'process_property_creation.php';

  // set a max file size for the html upload form
  $max_file_size = 30000; // size in bytes

  // now echo the html page
?>

<html xmlns="http://www.w3.org/1999/xhtml">
    <head>
        <!-- <meta http-equiv="content-type" content="text/html; charset=iso-8859-1"> -->

        <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
        <title> Welcome to Rent property </title>
        <link href="main_11.css" rel="stylesheet" type="text/css"/>
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
              <form id="Upload" action="<?php echo $uploadHandler ?>" enctype="multipart/form-data" method="post">

                  <h1>
                      Your Property Information
                  </h1>
                  <p>
                    Street Address<br>
                    <input type="text" name="address" placeholder = "123 example street" style="width: 500px">
                  </p>
                  <p>
                    Suburb<br>
                    <input type="text" name="suburb" placeholder = "Suburb" style="width: 300px">
                  </p>
                  <p>
                    Number of Bedrooms<br>
                    <input type="number" name="roomnumber" min="1" max="10" placeholder = "No." style="width: 50px">
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
                    <input type="radio" name="furnished" value="1">Yes
                    <input type="radio" name="furnished" value="0">No
                  </p>
                  <p>
                    Number of Bathrooms<br>
                    <input type="number" name="bathroom_number" min="1" max="10" placeholder = "No." style="width: 50px">
                  </p>
                  <p>
                    Rent Amount<br>
                    $<input type="text" name="rent_amt" placeholder="200" style="width:30px"> p/week
                  </p>
                  <p>
                    Link to Gumtree Advertisment (optional)<br>
                    <input type="url" name="gumtree_url" placeholder="www.gumtree.com.au/youradvertisment" style="width:500px">
                  </p>
                  <p>
                    Description of Property<br>
                    <input type="text" name="description" style="width: 500px; height: 100px">
                  </p>
                  <p>
                    1st Inspection Time<br>
                    <input type="text" name="inspection_time1" placeholder = "15 September 2015 12:00 - 12:15" style="width: 300px">
                  </p>
                  <p>
                    2nd Inspection Time<br>
                    <input type="text" name="inspection_time2" placeholder = "16 September 2015 12:15 - 12:30" style="width: 300px">
                  </p>
                  <p>
                      <input type="hidden" name="MAX_FILE_SIZE" value="<?php echo $max_file_size ?>">
                  </p>
                  <br>
                  <p>
                      <label for="file">Image to upload:</label>
                      <input id="file" type="file" name="file">
                  </p>
                  <p>
                    Image Description:
                    <input type="text" name="image_description" placeholder = "Description" style="width: 150px">
                  </p>
                  <br>
                  <p>
                      &nbsp; &nbsp; &nbsp; &nbsp; &nbsp;&nbsp; &nbsp; &nbsp; &nbsp; &nbsp;<input id="submit" type="submit" name="submit" value="Create Property">
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
