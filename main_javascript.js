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
