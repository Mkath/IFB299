function validate(form){
	//variable is set to stop the form is any tests return false
	var test = true;
	//if the form is null, the error message is made visible, field is focussed on
	//and variable - test, returns false.
	if (form.Name.value == ""){
		document.getElementById("nameMissing").style.visibility = "visible";
		form.Name.focus();
		test = false;
	}
  if (form.username.value == ""){
		document.getElementById("usernameMissing").style.visibility = "visible";
		form.username.focus();
		test = false;
	}
	//compares password to password wonfirmation to see if they are identical
  if ((form.confirmuserpw.value != form.password.value)||(form.password.value == "")){
		document.getElementById("differentPW").style.visibility = "visible";
		form.confirmuserpw.value = "";
		form.confirmuserpw.focus();
		test = false;
	}
	if ((form.email.value == "")){
		document.getElementById("emailMissing").style.visibility = "visible";
		form.email.focus();
		test = false;
	}
	//checks if the number of selected items is == to less than 1.
  if (form.country.selectedIndex < 1){
    document.getElementById("countryError").style.visibility = "visible";
    form.country.focus();
		test = false;
  }
  if ((form.BirthDay.selectedIndex < 1)||(form.BirthMonth.selectedIndex < 1)||(form.BirthYear.selectedIndex < 1)){
    document.getElementById("birthError").style.visibility = "visible";
		test = false;
  }
	//checks if both radio buttons are not checked
  if ((form.male.checked == false)&&(form.female.checked == false)){
    document.getElementById("genderError").style.visibility = "visible";
		test = false;
  }
  if (form.address.value == ""){
		document.getElementById("addressError").style.visibility = "visible";
		form.address.focus();
		test = false;
	}
	//returns the variable test to determine if the form should be submitted or not
	return test;
}
//makes the desired error message inisible again
function invisible(element){
	document.getElementById(element).style.visibility = "hidden";
}
//function searchParks(form)
function searchParks()
{
	//get table
	//window.location.href = "resultsPage.html";
	//window.location.assign("resultsPage.html");

	//Get form info
  var xmlHttp = new XMLHttpRequest();
  xmlHttp.open( "GET", "resultsPage.html", false );
  xmlHttp.send( null );
	//xmlHttp.responseText
  alert(xmlHttp.responseText.parkName);

	var rows = document.getElementById('parks').rows;
	alert("Got Parks");
	var checkCells;
	var hideRow;

	//break up search text into words

	//cycle through rows
	for( var y = 1; x < rows.length; i++)
	{
		hideRow = false
		checkCells = rows[i];
		if(checkCells[0] != form.parkName)//check if name cell contains searched name
		{
			hideRow = true;
		}else if(form.parkName == " ")
		{
			alert("search empty");
		}
			//eliminate rows where false
		//check if suburb row contains selected suburb
			//eliminate rows where false

		if(hideRow == true)
		{
			row.style.display = 'none';
		}
	}
	return false;
}

function searchValidate(form)
{
	var searchOK = false;
	if(form.parkName.value == ""){
		/*
		document.getElementById("parkNameMissing").style.visibility = "visible";
		form.parkName.focus();
		*/
	}
	else {
		searchOK = true;
	}

	if(form.suburb.selectedIndex < 1)
	{
		document.getElementById("suburbMissing").style.visibility = "visible";
	}
	else
	{
		searchOK = true;
	}

	if(form.rating.value != "Any")
	{
		searchOK = true;
	}

	if(!searchOK)
	{
		document.getElementById("searchMissing").style.visibility = "visible";
		form.parkName.focus();
	}

	return searchOK;
}

function checkName(form)
{
	if(form.parkName.value == ""){
		document.getElementById("parkNameMissing").style.visibility = "visible";
		form.parkName.focus();
		return false;
	}
}

function hideWarning()
{
	console.log("hideW");
	document.getElementById("parkNamesMissing").style.visibility = "hidden";
}

function checkSuburb(form){
	/*
	console.log(form.subburb.selectedIndex);
	if(form.subburb.selectedIndex < 1)
	{
		document.getElementById("suburbMissing").style.visibility = "visible";
		return false;
	}
	*/
}

function checkRating(form){
	console.log("checkA");
	if(form.address.value == "")
	{
		document.getElementById("ratingMissing").style.visibility = "visible";
		return false;
	}
}
function checkState(form)
{
	console.log("checkS");
	if(form.state.value == "state"){
		window.alert("Please select a state.");
		return false;
	}
}



var x = document.getElementById("parkName");
function checkGeolocation()
{
	if (navigator.geolocation) {
        navigator.geolocation.getCurrentPosition(showPosition);
    } else {
        x.innerHTML = "Geolocation is not supported by this browser.";
    }
}

function showPosition(position) {
    //x.innerHTML = "Latitude: " + position.coords.latitude +
    //"<br>Longitude: " + position.coords.longitude;
		var geoURL;
		geoURL = 'resultsPage.php?searchLocation=1&latitude=' + position.coords.latitude + '&longitude=' + position.coords.longitude;
		window.location.href = geoURL;

	//document.write("Latitude: " + position.coords.latitude +
  //"<br>Longitude: " + position.coords.longitude);
}


function initializeIndividual(newLat,newLong) {
				//moved map initialize to top for global

        var myLatlng = new google.maps.LatLng(newLat,newLong);
        var mapOptions = {
          zoom: 12,
          center: myLatlng
        }
        map = new google.maps.Map(document.getElementById('map'), mapOptions);

        var marker = new google.maps.Marker({
            position: myLatlng,
            map: map,
        });
      }

function initialize() {
	//moved map initialize to top for global
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
}

function writeReview () {

}

function addMarker(lat, long)	//doesn't work
{
	var myLatlng = new google.maps.LatLng(lat,long);

	var myLatlng = new google.maps.LatLng(-27.38006149,153.0387005);


	var marker = new google.maps.Marker({
			position: myLatlng,
			map: map,
	});
}
