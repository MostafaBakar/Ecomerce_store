 <?php require("header.php"); 
 ?>
 <?php include("app/core/functions.php"); ?>
 <?php
    if (isset($_SESSION["auth"])) {
        redirect("index.php");
        die();
    }
    ?>


 <div class="container">
     <div class="form-container">
         <h1 class="text-center mt-3">Login</h1>
         <?php
            if (isset($_SESSION['errors'])):
                foreach ($_SESSION['errors'] as $error):
            ?>
                 <div class="alert alert-danger text-center">
                     <?php echo $error; ?>
                 </div>
         <?php
                endforeach;
                unset($_SESSION['errors']);
            endif;
            ?>
         <form action="app/handelers//handelLogin.php" method="post">

             <div class="mb-3; mt-4">
                 <label for="email" class="form-label">Email</label>
                 <input type="email" class="form-control" id="email" name="email" placeholder="Enter your email" required>
             </div>
             <div class="mb-3">
                 <label for="password" class="form-label">Password</label>
                 <input type="password" class="form-control" id="password" name="password" placeholder="Enter your password" required>
             </div>

             <div class=" d-grid form-group text-center">
                 <button type="submit" class="btn btn-primary btn-block hover-up" name="login">login</button>
             </div>
         </form>
         <div class="text-center mt-3">
             <span style="margin-top: 10px">
                 Don't have an account? <a href="sign-up.php">Register</a></span>
         </div>
     </div>
 </div>