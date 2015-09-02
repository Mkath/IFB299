<?php
  //this function removes an unwanted characters from the suburb
  function validate($field)
  {
    $field = trim($field);
    $field = stripslashes($field);
    $field = htmlspecialchars($field);
    $field = strtoupper($field);
    return $field;
  }
  //The following lines assign variables from the search form to local php variables
  $property_type = $_GET["type"];
  $suburb = validate($_GET["venuename"]);
  $room_number = $_GET["roomnumber"];
  $min_rent = $_GET["min"];
  $max_rent = $_GET["max"];
  $furnished = $_GET["furnishedtype"];

  //these lines set up the table for which to display the results
  echo '<table id = "results_table" border = "1">';
  echo '<td>Property ID</td><td>Suburb</td><td>Rent Per Week</td><td>Property Type</td><tr>';

  //this connects to the mysql database
  $conn = new PDO("mysql:host=localhost;dbname=property", 'root', '');

  //this retreives all the data from the table in mysql.
  //It then selects only the rows of information in which all the specified information
  //from the search form are found.
  $stmt = $conn->prepare('SELECT * FROM `property_details` WHERE `property_type` = :ptype AND `suburb` = :suburb AND `rent_amt` < :maxrent
  AND `rent_amt` > :minrent AND `number_rooms` = :nrooms AND `furnished` = :furnishedtype ORDER BY `suburb`, `rent_amt`');

  //the following lines combine local variables with the ones created in the above
  //statement. It then executes all prepared statments.
  $stmt->bindParam(':ptype', $property_type, PDO::PARAM_STR);
  $stmt->bindParam(':suburb', $suburb, PDO::PARAM_STR);
  $stmt->bindParam(':nrooms', $room_number, PDO::PARAM_STR);
  $stmt->bindParam(':maxrent', $max_rent, PDO::PARAM_STR);
  $stmt->bindParam(':minrent', $min_rent, PDO::PARAM_STR);
  $stmt->bindParam(':furnishedtype', $furnished, PDO::PARAM_STR);
  $stmt->execute();

  //removes duplicates
  $last = "placeholder";

  //these lines display all the chosen information from the selected rows of
  //the mysql database in a newly created table.
  foreach($stmt as $row)
  {
    if($row != $last)
    {
      echo '<td>', $row['propertyid'], '<td>', $row['suburb'], '<td>', $row['rent_amt'], '<td>', $row['property_type'], '<tr>';
    }
  }
?>
