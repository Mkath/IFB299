<?php

  function validate($field)
  {
    $field = trim($field);
    $field = stripslashes($field);
    $field = htmlspecialchars($field);
    $field = strtoupper($field);
    return $field;
  }

  function getDistance($lat1, $long1, $lat2, $long2)  //http://www.geodatasource.com/developers/php
  {
    $theta = $long1 - $long2;
    $dist = sin(deg2rad($lat1)) * sin(deg2rad($lat2)) +  cos(deg2rad($lat1)) * cos(deg2rad($lat2)) * cos(deg2rad($theta));
    $dist = acos($dist);
    $dist = rad2deg($dist);
    $kms = $dist * 60 * 1.853159616;

    return $kms;
  }


  $doGeoLoc = $_GET["searchLocation"];


    $parksDB = new PDO('mysql:host=localhost;dbname=parks', 'root', '');
    //$parksDB = new PDO('mysql:host=fastapps04.qut.edu.au;dbname=n8815046', 'n8815046', 'burpfetish');
  if($doGeoLoc == 0)
  {
    $parkName = validate($_GET["parkName"]);
    $suburb = validate($_GET["suburb"]);


    //$stmt = $parksDB->query('SELECT * FROM `brisparks` WHERE Suburb = "TOOWONG"');  //this works
    $stmt = $parksDB->prepare('SELECT * FROM `brisparks` WHERE `Name` = :checkName OR `Suburb` = :checkSuburb ORDER BY `Name`');

    $stmt->bindParam(':checkName', $parkName, PDO::PARAM_STR);
    $stmt->bindParam(':checkSuburb', $suburb, PDO::PARAM_STR);
    $stmt->execute();
    $last = "placeholder";  //removes duplicates
    echo '<table id = numbers border = "1">';
    echo '<th>ID</th><th>Park Code</th><th>Name</th><th>Street</th><th>Suburb</th><th>Easting</th><th>Northing</th><th>Latitude</th><th>Longitude</th>';
    foreach($stmt as $row)
    {
      echo '<tr method = "GET" action = "page3itempage.php">';
      foreach($row as $item)
      {
        if($item != $last)
        {
          echo '<td>', $item, '</td>';
          $last = $item;
        }
      }
      echo '<td>', '<a href="page3itempage.php?review=&parkCode=', $row['Park Code'], '">See More</a>', '</td>';
      echo '</tr>';
    }


  }else {
    $lat = $_GET["latitude"];
    $long = $_GET["longitude"];
    $dist;
    $results = array( "distance" => array(), "index" => array());
    //get all parks
    $pdoParks = $parksDB->query('SELECT * FROM `brisparks`');
    $parksArr = $pdoParks->fetchAll(); //send results to array
    $length = Count($parksArr)-1;
    for($x = 0; $x < $length; $x++)//step through parks
    {
      $dist = getDistance($lat, $long, $parksArr[$x]['Latitude'], $parksArr[$x]['Longitude']);//call getdistance
      if($dist < 1)//if distance is less than maxDistance add to array
      {
        array_push($results["index"], $x);
        array_push($results["distance"], $dist);
      }
    }
    //sort array
    array_multisort($results["distance"], SORT_ASC, SORT_NUMERIC, $results["index"], SORT_NUMERIC, SORT_ASC);
    $row;

    echo '<table id = numbers border = "1">';
    echo '<th>Distance (kms)</th><th>ID</th><th>Park Code</th><th>Name</th><th>Street</th><th>Suburb</th><th>Easting</th><th>Northing</th><th>Latitude</th><th>Longitude</th>';
    for($i = 0; $i < 10; $i++)
    {
      echo '<tr>';
      echo '<td>', round($results["distance"][$i], 3) ,'</td>';
      echo '<td>', $parksArr[$results["index"][$i]]["id"] ,'</td>';
      echo '<td>', $parksArr[$results["index"][$i]]["Park Code"] ,'</td>';
      echo '<td>', $parksArr[$results["index"][$i]]["Name"] ,'</td>';
      echo '<td>', $parksArr[$results["index"][$i]]["Street"] ,'</td>';
      echo '<td>', $parksArr[$results["index"][$i]]["Suburb"] ,'</td>';
      echo '<td>', $parksArr[$results["index"][$i]]["Easting"] ,'</td>';
      echo '<td>', $parksArr[$results["index"][$i]]["Northing"] ,'</td>';
      echo '<td>', $parksArr[$results["index"][$i]]["Latitude"] ,'</td>';
      echo '<td>', $parksArr[$results["index"][$i]]["Longitude"] ,'</td>';
      echo '<td>', '<a href="page3itempage.php?parkCode=', $parksArr[$results["index"][$i]]["Park Code"], '">See More</a>', '</td>';
      echo '</tr>';

    }
      /*
        //put array on screen
      echo 'distance is ', $results["distance"][$i], ' name is ', $parksArr[$results["index"][$i]]["Name"], '<br>';
    }
    */


  }
?>
