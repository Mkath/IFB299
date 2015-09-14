<?php
  $parksDB = new PDO('mysql:host=localhost;dbname=parks', 'root', '');
  //$parksDB = new PDO('mysql:host=fastapps04.qut.edu.au;dbname=n8815046', 'n8815046', 'burpfetish');

  $suburbsArr = $parksDB->query('SELECT DISTINCT `Suburb` FROM `brisparks` ORDER BY `Suburb`');
  foreach($suburbsArr as $suburb)
  {
    echo '<option value = "', $suburb['Suburb'], '">', $suburb['Suburb'], '</option>';
  }
?>
