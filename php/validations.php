<?php
  function strip_input($input){
     $input = trim($input);
     $input = stripslashes($input);
     $input = htmlspecialchars($input);
     return $input;
  }
  
  function is_valid_email($email){
    global $registration_status;
    if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
      $registration_status["Email"] = "Invalid Email ID";
      return false;
    }
    return true;
  }
  
  function is_valid_user($user){
    global $registration_status;
	if(!preg_match('/^[a-zA-Z0-9]{5,}/', $user)) {
  		$registration_status["Name"] = "User name must be atleast 5 letters!";
  		return false;
  	}
  	return true;
  }

function is_valid_Password($pwd){
  global $registration_status;
  $uppercase = preg_match('@[A-Z]@', $pwd);
  $lowercase = preg_match('@[a-z]@', $pwd);
  $number    = preg_match('@[0-9]@', $pwd);
  if(!$uppercase || !$lowercase || !$number || strlen($pwd) < 8) {
    $registration_status["Password"] = "Must be upper+lower+number and atleast 8 literals.";
    return false;
  } 
  else
    return true;

  return false;
}

function is_valid_phone_number($phone_num){
  global $registration_status;
    $number    = preg_match('@[0-9]@', $phone_num);
    if(!$number || strlen($phone_num) < 10){
        $registration_status["Phone_number"] = "Country Code-Phone number(Ex: 01-9403156721)";
        return false;
    }
    return true;
}
?>