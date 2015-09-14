<!DOCTYPE html>
<html>
	<head>
		<title>Search for Parks</title>
		<link href="searchPageCSS.css" rel="stylesheet" type="text/css"/>
		<script type = "text/JavaScript" src = "javascript.js"></script>
	</head>
	<?php
		include 'pageLayout.inc';
	?>

			<div id="content">
				<form method = "GET" action = "resultsPage.php" onsubmit="return searchValidate(this)";>
				<!--<form onsubmit="return searchValidate(this)";>-->
					<span id = "searchMissing" style = 'visibility:hidden;color:red'> Please use at least one of the following fields </span>
					<p> Find a park based on: </p>
					<p>Name:

						<input type = "text" name = "parkName">
						<span id = "parkNameMissing" style = 'visibility:hidden;color:red'> Enter a park name</span>
					</p>
					<p>Suburb:
						<select name = "suburb">	<!-- Generate suburbs with php -->
							<option value = "Any">
								Any Suburb
							</option>
							<?php include 'searchPage.inc';?>
						</select>
						<span id = "suburbMissing" style = 'display:none;color:red'> Enter a subburb</span>
					</p>

					<p>
						Rating:
						<input type = "radio" name = "rating" value = "1"> 1
						<input type = "radio" name = "rating" value = "2"> 2
						<input type = "radio" name = "rating" value = "3"> 4
						<input type = "radio" name = "rating" value = "4"> 4
						<input type = "radio" name = "rating" value = "5"> 5
						<input type = "radio" name = "rating" value = "Any" checked = "checked" style = 'visibility:hidden'> <!-- Default -->
						<span id = "ratingMissing" style = 'visibility:hidden;color:red'> Enter a rating</span>
					</p>

					<input type = "radio" name = "searchLocation" value = "0" checked = "checked" style = "display:none">	<!--check location flag-->

					<input type = "submit">

					<!--<input type = button value = "search" onclick = "self.location = 'resultsPage.html'; searchParks(form)">-->
					<!--<input type = button value = "search" onclick = "searchParks(form)">-->
					<!-- The problem here is, that I'm calling searchParks(form) from search page. -->
				</form>
				<p>
					Or, find a park based on your current location:
				</p>

				<button id="geoButt"onclick = "checkGeolocation()"> Search Near me </button>
				<!--
				<form  id = "geoForm" onsubmit = "checkGeolocation" method = "GET" action = "resultsPage.php";>
					<input type = "radio" name = "searchLocation" value = "1" checked = "checked" style = "display:none">
					<input type = "submit">
				</form>
			-->
			</div>

			<div id="footer">
			Francis O'loghlin: n8815046<br>
			Sean Little: n9106201
			</div>
		</div>
	</body>
</html>
