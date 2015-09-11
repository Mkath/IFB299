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
