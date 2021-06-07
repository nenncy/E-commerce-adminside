<?php

   session_start();
   ob_start();
?>
<!doctype html>
<html class="no-js" lang="">
   <meta http-equiv="content-type" content="text/html;charset=UTF-8" />
   <head>
      <meta charset="utf-8">
      <meta http-equiv="X-UA-Compatible" content="IE=edge">
      <title>Login Page</title>
      <meta name="viewport" content="width=device-width, initial-scale=1">
      <link rel="stylesheet" href="assets/css/normalize.css">
      <link rel="stylesheet" href="assets/css/bootstrap.min.css">
      <link rel="stylesheet" href="assets/css/font-awesome.min.css">
      <link rel="stylesheet" href="assets/css/themify-icons.css">
      <link rel="stylesheet" href="assets/css/pe-icon-7-filled.css">
      <link rel="stylesheet" href="assets/css/flag-icon.min.css">
      <link rel="stylesheet" href="assets/css/cs-skin-elastic.css">
      <link rel="stylesheet" href="assets/css/style.css">
      <link href='https://fonts.googleapis.com/css?family=Open+Sans:400,600,700,800' rel='stylesheet' type='text/css'>
   </head>
   <body class="bg-dark">
   <?php
include 'dbconnection.php';

   
  if(isset($_POST['submit'])){


    if(isset($_GET['token'])){

        $token = $_GET['token'];
        echo $token;

     
      $password=mysqli_real_escape_string($con,$_POST['password']);
      
     
      $pass=password_hash($password,PASSWORD_BCRYPT);
    
       
           $updatequery="update admin_login set password = '$pass' where token='$token' ";
            
            $iquery = mysqli_query($con , $updatequery);
         
          if($iquery)
          {
            
             $_SESSION['msg'] = "Your password has been updated";
             header('Location:login.php');
              
          }
          else{

             $_SESSION['passmsg'] = "Your Password is not Updated";
             header('Location:reset_password.php');
            
        
          }
        
       
    }
    else{
        echo "token not found";
    }
}



?>
   
 
      <div class="sufee-login d-flex align-content-center flex-wrap">
         <div class="container">
            <div class="login-content">
               <div class="login-form mt-150">
                  <form method="POST" >
                  <div>
                  <h2 class=" mb-3">Reset your password</h2>
                     <h5>Enter your new password here</h5>

                   </div>
                   
                     <div class="form-group">
                        <label>Password</label>
                        <input type="password" name="password" class="form-control" placeholder="Password" required>
                     </div>
                     <button type="submit" name="submit" class="btn btn-success btn-flat m-b-30 m-t-30">Update Password</button>
                    
					</form>
               </div>
            </div>
         </div>
      </div>
      <script src="assets/js/vendor/jquery-2.1.4.min.js" type="text/javascript"></script>
      <script src="assets/js/popper.min.js" type="text/javascript"></script>
      <script src="assets/js/plugins.js" type="text/javascript"></script>
      <script src="assets/js/main.js" type="text/javascript"></script>
   </body>
</html>