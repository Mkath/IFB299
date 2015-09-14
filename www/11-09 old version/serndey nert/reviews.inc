<?php
  $parksDB = new PDO('mysql:host=localhost;dbname=parks', 'root', '');
  //$parksDB = new PDO('mysql:host=fastapps04.qut.edu.au;dbname=n8815046', 'n8815046', 'burpfetish');

  //$reviewInfo = $parksDB->prepare('INSERT INTO parkreviews (Title, Name, Review)
    //VALUES ("This", "Is", "Annoying")');
  //if(isset($_POST['title']) || isset($_POST["title"]) || isset($_POST["title"])){
  $review = $_GET["review"];
  if ($review != null) {
    $name = $_GET["name"];
    $title = $_GET["title"];
    $stmt = $parksDB->prepare("INSERT INTO parkreviews (Title, Name, Review) VALUES (:title, :name, :review)");
    $stmt->bindParam(':title', $title, PDO::PARAM_STR);
    $stmt->bindParam(':name', $name, PDO::PARAM_STR);
    $stmt->bindParam(':review', $review, PDO::PARAM_STR);
    $stmt->execute();
  }

  $stmt = $parksDB->prepare('SELECT * FROM `parkreviews`');
  $stmt->bindParam(':parkCode', $parkCode, PDO::PARAM_STR);
  $stmt->execute();
  foreach($stmt as $item)
  {
    echo '<br><h3>',$item['Title'],'</h3>';
    echo '<h5>',$item['Name'],'</h5>';
    echo $item['Review'];
  }
?>
