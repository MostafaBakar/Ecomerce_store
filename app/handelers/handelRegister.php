<?php
session_start();
include("../core/functions.php");
include("../core/validations.php");
include_once("../core/session.php");
include("../models/User.php");

$validations = new Validation;

$user = new User;
$errors = [];

if(checkRequestMethod("POST") && checkPostInput("name")){


  // Check Post Type
  foreach($_POST as $key => $value){
    $$key= sanitizeInput($value);
  }

  // Validations
  // Name
  if(!$validations->requiredVal($name)){
    $errors[] = "name is required";
  }elseif(!$validations->minVal($name,3)){
    $errors[] = "Name must be greater than 3 chars";
  }elseif(!$validations->maxVal($name,25)){
    $errors[] = "Name must be smaller than 25 chars";
  }


  // Email
  if(!$validations->requiredVal($email)){
    $errors[] = "email is required";
  }elseif(!$validations->emailVal($email)){
    $errors[] = "Please type a valid email";
  }

  // Password
  if(!$validations->requiredVal($password)){
    $errors[] = "Password is required";
  }elseif(!$validations->minVal($password,6)){
    $errors[] = "Password must be greater than 6 chars";
  }elseif(!$validations->maxVal($password,20)){
    $errors[] = "Password must be smaller than 20 chars";
  }

  // Confirm Password
  if(!$validations->requiredVal($confirmPassword)){
    $errors[] = "Confirm Password is required";
  }elseif($confirmPassword != $password){
    $errors[] = "Confirm Password must be equal Password";
  }

  // check Errors And Store Data
if(empty($errors)){

  // Store Data
  $data = [
    'name' => $name,
    'email' => $email,
    'password' => sha1($password)
    
  ];
  
  $user->create($data);
  // User Redirection
  $_SESSION["auth"] = [$name,$email];
  $valuesas=[$email];
  checkSession('auth');
  redirect("../../../index.php");
}else{
  $_SESSION["errors"] = $errors;
  redirect("../../../sign-up.php");
  die();
}

}else{
  redirect("../../../sign-up.php");
}
