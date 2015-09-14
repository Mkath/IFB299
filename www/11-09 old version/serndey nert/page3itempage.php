<!DOCTYPE html>
<html>
	<head>
		<title>Web Programming Assignment</title>
		<link href="page3CSS.css" rel="stylesheet" type="text/css"/>
		<script type="text/javascript" src="javascript.js"></script>
		<script type="text/javascript" src="https://maps.googleapis.com/maps/api/js?key=AIzaSyCQe7uyhuWAIIi5avQRa3B3KOrsfIfNqr4"></script>

	</head>
	<?php
		include 'pageLayout.inc';
	?>
			<div id="content">
				<p>
				<div id="map">

	      </div>
				<?php include 'itemPage.inc';?>


				<!--<h2 id="nameHeading">7TH BRIGADE PARK<h2><br>
				<div id="map">
				</div>
				<div id="details">
					Park ID: D0228<br>
					Address: HAMILTON RD, CHERMSIDE
				</div><br>
				<p>

				<div id="map"></div>
			-->
				<div id="reviewHeader">
					Reviews<br>
				</div>
				<p>
				<div class="scroll">
					<?php
						include 'reviews.inc';

					?>
				</div>
				<br>
				<div id="form">
					<form name="formOne" action="page3itempage.php" method="get">
						<?php include "parkCode.inc"; ?>
						Review Title:
						<input type="text" name="title" style="width: 100px;"><br><br>
						Please Enter Name:
						<input type="text" name="name" style="width: 100px"><br><br>
						<textarea name="review" style="width: 600px"></textarea></br>
						<input type="submit" value="Submit" style="width: 50px">
					</form>
				</div>

				<div id="footer">
					Francis O'loghlin: (Student ID)<br>
					Sean Little: n9106201
				</div>
			</div>
		</div>
	</body>
</html>
