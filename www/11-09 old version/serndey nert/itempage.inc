<?php
  $parkCode = $_GET["parkCode"];
  //$parksDB = new PDO('mysql:host=fastapps04.qut.edu.au;dbname=n8815046', 'n8815046', 'burpfetish');
  //$parksDB = new PDO('mysql:host=localhost;dbname=parks', 'root', '');

  $parksDB = new PDO('mysql:host=localhost;dbname=parks', 'root', '');
  //$parksDB = new PDO('mysql:host=fastapps04.qut.edu.au;dbname=n8815046', 'n8815046', 'burpfetish');

  $parkInfo = $parksDB->prepare('SELECT * FROM `brisparks` WHERE `Park Code` = :parkCode');
  $parkInfo->bindParam(':parkCode', $parkCode, PDO::PARAM_STR);
  $parkInfo->execute();
  foreach($parkInfo as $item)
  {
    $lat1 = $item['Latitude'];
    $long1 = $item['Longitude'];
    echo '<h2>', $item['Name'], '<h2><br>';
    echo '<div id="map"></div>';
    echo '<div id="details">Park ID:', $item['Park Code'], '<br>Address: ',$item['Street'], $item['Suburb'], '</div><br><p>';
  }

?>
<script type="text/javascript">
  var newLat = "<?php echo $lat1; ?>";
  var newLong = "<?php echo $long1; ?>";
  google.maps.event.addDomListener(window, 'load', initializeIndividual(newLat,newLong));
</script>'
