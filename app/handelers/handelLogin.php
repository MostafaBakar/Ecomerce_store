<?php
session_start();
include_once("../core/functions.php");
include_once("../core/validations.php");
include_once("../core/session.php");

include("../models/User.php");

$user = new User;
$errors = [];


if(checkRequestMethod("POST") && checkPostInput("email")){
   


  // Check Post Type
  foreach($_POST as $key => $value){
    $$key= sanitizeInput($value);
  }
  if (empty($email)) {
        $errors[] = "Email is required";
    } elseif (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        $errors[] = "Please enter a valid email address";
    }

    // Validate Password
    if (empty($password)) {
        $errors[] = "Password is required";
    } elseif (strlen($password) < 6) {
        $errors[] = "Password must be at least 6 characters";
    } elseif (strlen($password) > 20) {
        $errors[] = "Password must be less than 20 characters";
    }

    // If there are no validation errors
    if (empty($errors)) {
        // Fetch user data
        $data = $user->fetchAssoc();

        $authenticated = false;
        foreach ($data as $row) {
            if ($email === $row['email'] && password_verify($password, $row['password'])) {
                // Successful authentication
                 
                $_SESSION["auth"] = [$row['id'], $row['email']];
                 // Assuming $row['id'] is the user ID
                 checkSession("auth");
                $authenticated = true;
                break;
            }
        }

        if ($authenticated) {
            redirect("../../../index.php");
        } else {
            $errors[] = "Invalid email or password";
        }
    }

    // Handle errors
    if (!empty($errors)) {
        
        $_SESSION["errors"] = $errors;
        // redirect("../../login.php");
        header("location:../../../login.php");
        
    }
} else {
    redirect("../../../index.php");
}
?>

  <!-- // Validations
  // Email
//   if(!$validations->requiredVal($email)){
//     $errors[] = "email is required";
//   }elseif(!$validations->emailVal($email)){
//     $errors[] = "Please type a valid email";
//   }

//   // Password
//   if(!$validations->requiredVal($password)){
//     $errors[] = "Password is required";
//   }elseif(!$validations->minVal($password,6)){
//     $errors[] = "Password must be greater than 6 chars";
//   }elseif(!$validations->maxVal($password,20)){
//     $errors[] = "Password must be smaller than 20 chars";
//   }

//   // Read Data
//   if(empty($errors)){
//     // Check Data
//     $data = $user->fetchAssoc();

//     // Check Data
//     foreach($data as $row){
//       if($email == $row['email'] && sha1($password) == $row['password']){
//         // User Redirection
//         $_SESSION["auth"] = [$row[0],$row[1]];
//         redirect("../../index.php");
//       }
//     }

//     if(!isset($_SESSION["auth"])){
//       $errors[] = "Email or Password is not valid";
//       $_SESSION["errors"] = $errors;
//       redirect("../../login.php");
//     }

//   }else{
//     $_SESSION["errors"] = $errors;
//     redirect("../../login.php");
//     die();
//   }

// }else{
//   redirect("../login.php");
// }
} -->

