function validate(form){
	//validation variable is set to stop the form if venuename is null
	var validation = true;
	//if the field is null, the error message is made visible, field is focussed on
	//and variable - 'validation', returns false.
	if (form.venuename.value == ""){
		document.getElementById("suburbMissing").style.visibility = "visible";
		form.venuename.focus();
		validation = false;
	}
  return validation;
}

function validate_registration(form){
	var validation = true;
	if (form.firstname.value == ""){
		document.getElementById("firstnameMissing").style.visibility = "visible";
		form.firstname.focus();
		validation = false;
	}
	if (form.lastname.value == ""){
		document.getElementById("lastnameMissing").style.visibility = "visible";
		form.lastname.focus();
		validation = false;
	}
  if (form.email.value == ""){
		document.getElementById("emailMissing").style.visibility = "visible";
		form.email.focus();
		validation = false;
	}
	if (form.username.value == ""){
		document.getElementById("usernameMissing").style.visibility = "visible";
		form.username.focus();
		validation = false;
	}
	//compares password to password wonfirmation to see if they are identical
  if ((form.confirm_password.value != form.password.value)||(form.password.value == "")){
		document.getElementById("differentPW").style.visibility = "visible";
		form.confirm_password.value = "";
		form.confirm_password.focus();
		validation = false;
	}
	if ((form.dob.value == "")){
		document.getElementById("dobError").style.visibility = "visible";
		form.dob.focus();
		validation = false;
	}
  if (form.phone.value == ""){
		document.getElementById("phoneError").style.visibility = "visible";
		form.phone.focus();
		validation = false;
	}
	if (form.postcode.value == ""){
		document.getElementById("postalError").style.visibility = "visible";
		form.postcode.focus();
		validation = false;
	}
	return validation;
}


function signinvalidate(form){
	//validation variable is set to stop the form if venuename is null
	var validation = true;
	//if the field is null, the error message is made visible, field is focussed on
	//and variable - 'validation', returns false.
	if (form.username.value == ""){
		document.getElementById("usernameMissing").style.visibility = "visible";
		form.username.focus();
		validation = false;
	}
	if (form.password.value == ""){
		document.getElementById("passwordMissing").style.visibility = "visible";
		form.password.focus();
		validation = false;
	}
  return validation;
}

//this function is used to make the suburb element invisible again
function invisible(element){
	document.getElementById(element).style.visibility = "hidden";
}

function validate_profilechanges(form){
	var validation = true;
	if (form.firstname.value == ""){
		document.getElementById("firstnameMissing").style.visibility = "visible";
		form.firstname.focus();
		validation = false;
	}
	if (form.lastname.value == ""){
		document.getElementById("lastnameMissing").style.visibility = "visible";
		form.lastname.focus();
		validation = false;
	}
  if (form.email.value == ""){
		document.getElementById("emailMissing").style.visibility = "visible";
		form.email.focus();
		validation = false;
	}
	if ((form.dob.value == "")){
		document.getElementById("dobError").style.visibility = "visible";
		form.dob.focus();
		validation = false;
	}
  if (form.phone.value == ""){
		document.getElementById("phoneError").style.visibility = "visible";
		form.phone.focus();
		validation = false;
	}
	if (form.postcode.value == ""){
		document.getElementById("postalError").style.visibility = "visible";
		form.postcode.focus();
		validation = false;
	}
	return validation;
}
//this function is for the validation of propery creation
function validate_createproperty(form){
	var validation = true;
	if (form.address.value == ""){
		document.getElementById("addressERROR").style.visibility = "visible";
		form.address.focus();
		validation = false;
	}
	if (form.suburb.value == ""){
		document.getElementById("suburbERROR").style.visibility = "visible";
		form.suburb.focus();
		validation = false;
	}
	if (form.roomnumber.value == ""){
		document.getElementById("roomnumberERROR").style.visibility = "visible";
		form.roomnumber.focus();
		validation = false;
	}
	if (form.bathroom_number.value == ""){
		document.getElementById("bathroom_numberERROR").style.visibility = "visible";
		form.bathroom_number.focus();
		validation = false;
	}
	if (form.rent_amt.value == ""){
		document.getElementById("rent_amountERROR").style.visibility = "visible";
		form.rent_amt.focus();
		validation = false;
	}
	if (form.description.value == ""){
		document.getElementById("descriptionERROR").style.visibility = "visible";
		form.description.focus();
		validation = false;
	}
	if (form.inspection_time1.value == ""){
		document.getElementById("inspection_time1ERROR").style.visibility = "visible";
		form.inspection_time1.focus();
		validation = false;
	}
	if (form.inspection_time2.value == ""){
		document.getElementById("inspection_time2ERROR").style.visibility = "visible";
		form.inspection_time2.focus();
		validation = false;
	}
	if (form.file.value == ""){
		document.getElementById("fileERROR").style.visibility = "visible";
		validation = false;
	}
	if (form.image_description.value == ""){
		document.getElementById("image_descriptionERROR").style.visibility = "visible";
		form.image_description.focus();
		validation = false;
	}


	return validation;
}
