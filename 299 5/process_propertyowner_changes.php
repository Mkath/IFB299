<?php
include 'connection.php';
	if(!isset($_SESSION)){
    session_start();
	}

  if(!isset($_SESSION['o_id']) && (!isset($_SESSION['e_id']))) 
  {
    echo '<script type="text/javascript">
    alert("Forbidden");
    window.location.href = "signin.php";
    </script>';
  }
//Creates a Regex pattern for each field.
  function validateForm(&$errors, $field_list){
    $patternName = '/([A-Za-z])\w+/';
    $patternEmail = '/[a-zA-Z0-9._%+-]+@[a-zA-Z0-9.-]+\.[a-zA-Z]{2,4}/';
    $patternUsername = '/[a-zA-Z0-9\s\-\,]{5,}.\*?/';
    $patternPassword = '/[a-zA-Z]\w{3,14}/';
    $patternDOB = '/[0-9]{4}-[0-1][0-9]-[0-3][0-9]/';
    $patternPhone = '/^\+?\d((\.|\-)?\d)+$/';

//Matches each field to it's respective pattern. If they do not match then an error is created
    if (!preg_match($patternEmail, $field_list['email']))
      $errors['email'] = '*Email is Invalid';
    if (!preg_match($patternName, $field_list['firstname']))
        $errors['firstname'] = '<span syle="color:red">*Firstname is Invalid</span>';
    if (!preg_match($patternName, $field_list['lastname']))
        $errors['lastname'] = '*Last Name is Invalid';
    if (!preg_match($patternDOB, $field_list['dob']))
        $errors['dob'] = '*Date of Birth is Invalid';
    if (!preg_match($patternPhone, $field_list['phone']))
        $errors['phone'] = '* Phone is Invalid';
    if (!preg_match($patternPhone, $field_list['postcode']))
        $errors['postcode'] = '*Postcode is Invalid';


  }
  $errors = array();
  validateForm($errors, $_POST);
  if ($errors == null){
        //this function removes an unwanted characters from the suburb
        function validate($field)
        {
        $field = trim($field);
        $field = stripslashes($field);
        $field = htmlspecialchars($field);
        return $field;
        }
		 //Assigns all variables passed in from previous page
          $ownerid = $_GET['ID'];
          $first_name = validate($_POST["firstname"]);
          $last_name = validate($_POST["lastname"]);
          $email = validate($_POST["email"]);
          $dob = $_POST["dob"];
          $phone = $_POST["phone"];
          $postcode = $_POST["postcode"];
		  //$favourites = $_POST["favourite"];
		  

			
		//builds are connection to the database and updates all the fields with the new information.
          $conn = new PDO("mysql:host=$dbhost;dbname=$dbname", $dbuser, $dbpass);
          $stmt = $conn->prepare("UPDATE `propertyowner_details` SET `propertyowner_firstname` = :firstname, `propertyowner_phone` = :phone, `propertyowner_postal` = :postal, `propertyowner_dob` = :dob, `propertyowner_lastname` = :lastname, `propertyowner_email` = :email WHERE `propertyownerid` = :oid");
          $stmt->bindParam(':firstname', $first_name, PDO::PARAM_STR);
          $stmt->bindParam(':lastname', $last_name, PDO::PARAM_STR);
          $stmt->bindParam(':oid', $ownerid, PDO::PARAM_STR);
          $stmt->bindParam(':email', $email, PDO::PARAM_STR);
          $stmt->bindParam(':dob', $dob, PDO::PARAM_STR);
          $stmt->bindParam(':phone', $phone, PDO::PARAM_STR);
          $stmt->bindParam(':postal', $postcode, PDO::PARAM_STR);
          $stmt->execute();
		
		  //sends a message to the user if successful and redirects them back to the page.
         echo '<script type="text/javascript">
          alert("Your changes have been saved");
          window.location.href = "owner_profile.php?ID=';
		  echo $ownerid;
		  echo '";</script>';
          header( "refresh:0" ); 
		  
        }


  else{
    include "propertyowner_profile.php";
  }
?>
