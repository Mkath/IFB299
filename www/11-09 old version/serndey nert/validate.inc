<?php
//Creates a Regex pattern for each field.
  function validateForm(&$errors, $field_list){
    $patternEmail = '/^[a-zA-Z0-9._%+-]+@[a-zA-Z0-9.-]+\.[a-zA-Z]{2,4}$/';
    $patternName = '/^[a-zA-Z\-\s]+$/';
    $patternUsername = '/^[a-zA-Z0-9\s\-\,]{5,}.\*?$/';
    $patternPassword = '/^[a-zA-Z0-9\s\-\,]{5,}.\*?$/';
    $patternCountry = '/[A-Za-z]/';
    $patternBirthday = '/[0-9]/';
    $patternBirthmonth = '/[A-Za-z]/';
    $patternBirthyear = '/[0-9]/';
    $patternAddress = '/^[A-Za-z0-9\'.\-\s\,]+$/';

//Matches each field to it's respective pattern. If they do not match then an error is created
    if (!preg_match($patternEmail, $field_list['email']))
      $errors['email'] = 'invalid';
    if (!preg_match($patternName, $field_list['Name']))
        $errors['Name'] = 'invalid';
    if (!preg_match($patternUsername, $field_list['username']))
          $errors['username'] = 'invalid';
    if (!preg_match($patternPassword, $field_list['password']))
          $errors['password'] = 'invalid';
    if (!preg_match($patternCountry, $field_list['country']))
      $errors['country'] = 'invalid';
    if (!preg_match($patternBirthday, $field_list['BirthDay'])||!preg_match($patternBirthmonth, $field_list['BirthMonth'])||!preg_match($patternBirthyear, $field_list['BirthYear']))
      $errors['birthError'] = 'invalid';
    if (!preg_match($patternAddress, $field_list['address']))
      $errors['address'] = 'invalid';

  }
?>
