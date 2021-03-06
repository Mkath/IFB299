<?php
include 'connection.php';
	if(!isset($_SESSION)){
    session_start();
	}
	
  if(!isset($_SESSION['e_id']) && ($_SESSION['UserType'] != "Admin")) {
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
    if (!preg_match($patternUsername, $field_list['username']))
          $errors['username'] = '*User Name is Invalid';
    if (!preg_match($patternPassword, $field_list['password']))
          $errors['password'] = '&nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; *Password is Invalid';
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

	try {
		//The following lines assign variables from the search form to local php variables
        $username = validate($_POST["username"]);

        $conn = new PDO("mysql:host=$dbhost;dbname=$dbname",$dbuser,$dbpass);
        $stmt1 = $conn->prepare('SELECT * FROM `propertyowner_details` WHERE `propertyowner_username` = :uname');
        $stmt1->bindParam(':uname', $username, PDO::PARAM_STR);
        $stmt1->execute();
        $nCounter = 0;
        foreach($stmt1 as $row1)
        {
          if ($row1['propertyowner_username'] == $username){
            echo '<script type="text/javascript">
            alert("username already exists!");
            </script>';
            include "propertyowner_registration.php";
            $nCounter = $nCounter+1;
          }
        }
        if ($nCounter == 0){

          $first_name = validate($_POST["firstname"]);
          $last_name = validate($_POST["lastname"]);
          $email = validate($_POST["email"]);
          $username = validate($_POST["username"]);
          $password = validate($_POST["password"]);
          $dob = $_POST["dob"];
          $phone = $_POST["phone"];
          $postcode = $_POST["postcode"];

          $stmt = $conn->prepare("INSERT INTO `propertyowner_details` (propertyowner_firstname, propertyowner_lastname, propertyowner_dob, propertyowner_phone, propertyowner_email, propertyowner_postal, propertyowner_username, propertyowner_password)
          VALUES (:firstname, :lastname, :dob, :phone, :email, :postal, :username, SHA2(CONCAT(:password,salt),0))");
          $stmt->bindParam(':firstname', $first_name, PDO::PARAM_STR);
          $stmt->bindParam(':lastname', $last_name, PDO::PARAM_STR);
          $stmt->bindParam(':email', $email, PDO::PARAM_STR);
          $stmt->bindParam(':username', $username, PDO::PARAM_STR);
          $stmt->bindParam(':password', $password, PDO::PARAM_STR);
          $stmt->bindParam(':dob', $dob, PDO::PARAM_STR);
          $stmt->bindParam(':phone', $phone, PDO::PARAM_STR);
          $stmt->bindParam(':postal', $postcode, PDO::PARAM_STR);
          $stmt->execute();

          $stmt = $conn->prepare('SELECT * FROM `propertyowner_details` WHERE `propertyowner_username` = :uname AND `propertyowner_password` = SHA2(CONCAT(:pword,salt),0)');
          $stmt->bindParam(':uname', $username, PDO::PARAM_STR);
          $stmt->bindParam(':pword', $password, PDO::PARAM_STR);
          $stmt->execute();

          echo '<script type="text/javascript">
          alert("Congratulations! Account successfully created.");
          window.location.href = "home.php";
          </script>';
        }
	}

	catch(PDOException $e)
	{
		echo $e->getMessage();
	}

  }
  else{
	  //echo "errors";
    include "owner_registeration.php";
  }
?>
