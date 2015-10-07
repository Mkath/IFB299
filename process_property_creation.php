<?php
  include 'connection.php';
  // filename: upload.processor.php

  // first let's set some variables

  // make a note of the current working directory, relative to root.
  $directory_self = str_replace(basename($_SERVER['PHP_SELF']), '', $_SERVER['PHP_SELF']);

  // make a note of the directory that will recieve the uploaded file
  $uploadsDirectory = $_SERVER['DOCUMENT_ROOT'] . $directory_self . 'images/';

  // make a note of the location of the upload form in case we need it
  $uploadForm = 'http://' . $_SERVER['HTTP_HOST'] . $directory_self . 'create_property.php';

  // make a note of the location of the success page
  $uploadSuccess = 'http://' . $_SERVER['HTTP_HOST'] . $directory_self . 'home.php';

  // fieldname used within the file <input> of the HTML form
  $fieldname = 'file';

  // Now let's deal with the upload

  // possible PHP upload errors
  $errors = array(1 => 'php.ini max file size exceeded',
                  2 => 'html form max file size exceeded',
                  3 => 'file upload was only partial',
                  4 => 'no file was attached');

  // check the upload form was actually submitted else print the form
  isset($_POST['submit'])
      or error('the upload form is needed', $uploadForm);

  // check for PHP's built-in uploading errors
  //($_FILES[$fieldname]['error'] == 0)
      //or error($errors[$_FILES[$fieldname]['error']], $uploadForm);

  // check that the file we are working on really was the subject of an HTTP upload
  @is_uploaded_file($_FILES[$fieldname]['tmp_name']);
      //or error('not an HTTP upload', $uploadForm);

  // validation... since this is an image upload script we should run a check
  // to make sure the uploaded file is in fact an image. Here is a simple check:
  // getimagesize() returns false if the file tested is not an image.
  @getimagesize($_FILES[$fieldname]['tmp_name']);
      //or error('only image uploads are allowed', $uploadForm);

  // make a unique filename for the uploaded file and check it is not already
  // taken... if it is already taken keep trying until we find a vacant one
  // sample filename: 1140732936-filename.jpg
  $now = time();
  while(file_exists($uploadFilename = $uploadsDirectory.$now.'-'.$_FILES[$fieldname]['name']))
  {
      $now++;
  }

  // now let's move the file to its final location and allocate the new filename to it
  @move_uploaded_file($_FILES[$fieldname]['tmp_name'], $uploadFilename);

      //or error('receiving directory insuffiecient permission', $uploadForm);
  // if ($_POST["image_description"] != ""){
  //   $fieldname2 = 'file2';
  //   @is_uploaded_file($_FILES[$fieldname2]['tmp_name']);
  //   @getimagesize($_FILES[$fieldname]['tmp_name']);
  //
  //   $now = time();
  //   while(file_exists($uploadFilename2 = $uploadsDirectory.$now.'-'.$_FILES[$fieldname2]['name']))
  //   {
  //       $now++;
  //   }
  //   @move_uploaded_file($_FILES[$fieldname2]['tmp_name'], $uploadFilename);
  // }

  // If you got this far, everything has worked and the file has been successfully saved.
  // We are now going to redirect the client to a success page.
  //header('Location: ' . $uploadSuccess);
  $address = $_POST['address'];
  $suburb = $_POST['suburb'];
  $roomnumber = $_POST['roomnumber'];
  $propert_type = $_POST['property_type'];
  $furnished = $_POST['furnished'];
  $bathroom_number = $_POST['bathroom_number'];
  $rent_amount = $_POST['rent_amt'];
  $gumtree_url = $_POST['gumtree_url'];
  $property_description = $_POST['description'];
  $inspection_time1 = $_POST['inspection_time1'];
  $inspection_time2 = $_POST['inspection_time2'];

  //Connect to DB, Insert detail information into table
  $conn1=new PDO("mysql:host=$dbhost;dbname=$dbname",$dbuser,$dbpass);
  $stmt1 = $conn1->prepare("INSERT INTO `property_details` (street_address, suburb, number_rooms, property_type, furnished, number_bathrooms, description, rent_amt, gumtree_url, inspection_time1, inspection_time2)
  VALUES (:street_address, :suburb, :number_rooms, :propert_type, :furnished, :number_bathrooms, :property_description, :rent_amt, :gumtree_url, :inspection_time1, :inspection_time2)");
  $stmt1->bindParam(':street_address', $address, PDO::PARAM_STR);
  $stmt1->bindParam(':suburb', $suburb, PDO::PARAM_STR);
  $stmt1->bindParam(':number_rooms', $roomnumber, PDO::PARAM_STR);
  $stmt1->bindParam(':propert_type', $propert_type, PDO::PARAM_STR);
  $stmt1->bindParam(':furnished', $furnished, PDO::PARAM_STR);
  $stmt1->bindParam(':number_bathrooms', $bathroom_number, PDO::PARAM_STR);
  $stmt1->bindParam(':rent_amt', $rent_amount, PDO::PARAM_STR);
  $stmt1->bindParam(':gumtree_url', $gumtree_url, PDO::PARAM_STR);
  $stmt1->bindParam(':property_description', $property_description, PDO::PARAM_STR);
  $stmt1->bindParam(':inspection_time1', $inspection_time1, PDO::PARAM_STR);
  $stmt1->bindParam(':inspection_time2', $inspection_time2, PDO::PARAM_STR);
  $stmt1->execute();

  //select latest property id value
  $stmt2 = $conn1->prepare('SELECT MAX(propertyid) AS propertyid FROM `property_details`');
  $stmt2->execute();

  foreach ($stmt2 as $row)
  {
    $pid = $row['propertyid'];

    $file_name = $now.'-'.$_FILES[$fieldname]['name'];
    $description = $_POST["image_description"];


    $conn = new PDO("mysql:host=$dbhost;dbname=$dbname",$dbuser,$dbpass);
    $stmt = $conn->prepare("INSERT INTO `property_images` (image_description, image_path, propertyid)
    VALUES (:description, :filename, :pid)");
    $stmt->bindParam(':filename', $file_name, PDO::PARAM_STR);
    $stmt->bindParam(':description', $description, PDO::PARAM_STR);
    $stmt->bindParam(':pid', $pid, PDO::PARAM_STR);
    $stmt->execute();

    echo '<script type="text/javascript">
    alert("Your Property has Successfully been Created");
    window.location.href = "home.php";
    </script>';
  }

  //

?>
