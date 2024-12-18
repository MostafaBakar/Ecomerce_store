<?php require("header.php"); ?>
<?php include("app/core/functions.php"); ?>
<?php 
    if(isset($_SESSION["auth"])){
        redirect("index.php");
        die();
    }
 ?>
<div class="container">
  <div class="row">
    <div class="col-8 mx-auto my-5">
      <h1 class="border p-2 my-2 text-center">Create an Account</h1>

      <!-- Print Errors -->
      <?php 
        if(isset($_SESSION['errors'])):
        foreach($_SESSION['errors'] as $error): 
      ?>
        <div class="alert alert-danger text-center">
          <?php echo $error; ?>
        </div>
      <?php
        endforeach;
        unset($_SESSION['errors']);
        endif;        
      ?>
    
    <div class="container">
        <div class="form-container">
            <h1 class="text-center">Register</h1>
            <form action="app/handelers//handelRegister.php" method="post">
                <div class="mb-3">
                    <label for="username" class="form-label">Username</label>
                    <input type="text" class="form-control" id="username" name="name" placeholder="Enter your username" required>
                </div>
                <div class="mb-3">
                    <label for="email" class="form-label">Email</label>
                    <input type="email" class="form-control" id="email" name="email" placeholder="Enter your email" required>
                </div>
                <div class="mb-3">
                    <label for="password" class="form-label">Password</label>
                    <input type="password" class="form-control" id="password" name="password" placeholder="Enter your password" required>
                </div>
                <div class="mb-3">
                    <label for="confirmPassword" class="form-label">Confirm Password</label>
                    <input type="password" class="form-control" id="confirmPassword" name="confirmPassword" placeholder="Confirm your password" required>
                </div>
                <div class=" d-grid form-group text-center">
                    <button type="submit" class="btn btn-primary btn-block hover-up"> Register</button>
                </div>
            </form>
            <div class="text-center mt-3">
                <span>Already have an account? <a href="login.php">Login</a></span>
            </div>
        </div>
    </div>
    
         
    

   