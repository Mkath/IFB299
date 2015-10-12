<?php
include 'connection.php';
if (isset($_POST['submit'])) {

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
    $property_id = $row['propertyid'];
  }

  //connection for the image insertion
  $conn3=new PDO("mysql:host=$dbhost;dbname=$dbname",$dbuser,$dbpass);
    $j = 0; //Variable for indexing uploaded image

	$folder_path = "images/"; //Declaring Path for uploaded images
    for ($i = 0; $i < count($_FILES['file']['name']); $i++) {//loop to get individual element from the array
        $validextensions = array("jpeg", "jpg", "png");  //Extensions which are allowed
        $ext = explode('.', basename($_FILES['file']['name'][$i]));//explode file name from dot(.)
        $file_extension = end($ext); //store extensions in the variable
        $img_path = md5(uniqid()) . "." . $ext[count($ext) - 1];
		    $target_path = $folder_path . $img_path;//set the target path with a new name of image
        $j = $j + 1;//increment the number of uploaded images according to the files in array
	       if (($_FILES["file"]["size"][$i] < 100000) //Approx. 100kb files can be uploaded.
                && in_array($file_extension, $validextensions)) {
            if (move_uploaded_file($_FILES['file']['tmp_name'][$i], $target_path)) {//if file moved to uploads folder
                echo '<span id="noerror">',$img_path,'</span><br/><br/>';
                echo $property_id;
                $stmt3 = $conn3->prepare("INSERT INTO `property_images` (image_path, propertyid)
                VALUES (:img_path, :property_id)");
                $stmt3->bindParam(':img_path', $img_path, PDO::PARAM_STR);
                $stmt3->bindParam(':property_id', $property_id, PDO::PARAM_STR);
                $stmt3->execute();


            } else {//if file was not moved.
                echo $j. ').<span id="error">please try again!.</span><br/><br/>';
            }
        } else {//if file size and file type was incorrect.
            echo $j. ').<span id="error">***Invalid file Size or Type***</span><br/><br/>';
        }
    }
}
?>
