<!DOCTYPE html>
<html>
	<head>
		<title>Web Programming Assignment</title>
		<link href="resultsPageCSS.css" rel="stylesheet" type="text/css"/>
		<script type = "text/JavaScript" src = "javascript.js"></script>
		<script type="text/javascript" src="https://maps.googleapis.com/maps/api/js?key=AIzaSyCQe7uyhuWAIIi5avQRa3B3KOrsfIfNqr4"></script>
	  <script type="text/javascript">
      google.maps.event.addDomListener(window, 'load', initialize);
    </script>
	</head>
	<?php
		include 'pageLayout.inc';
	?>

			<div id="content">
				<div id="map">

				</div>

				<p>
				<div id="csvData">
					<?php include 'resultsPage.inc';?>
				</div>
			</div>
			<script>
			var myLatlng = new google.maps.LatLng(-27.38006149,153.0387005);
			var mapOptions = {
				zoom: 12,
				center: myLatlng
			}
			map = new google.maps.Map(document.getElementById('map'), mapOptions);

			var marker = new google.maps.Marker({
					position: myLatlng,
					map: map,
			});
			</script>
			<p><p><br>

			<div id="footer">
			Francis O'loghlin: n8815046<br>
			Sean Little: n9106201
			</div>
		</div>
	</body>
</html>
