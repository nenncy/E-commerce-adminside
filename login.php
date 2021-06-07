
<?php 

   session_start();
   include "dbconnection.php";
   if(isset($_POST['submit'])){
       $email=$_POST['email'];
       $password=$_POST['password'];
       $email_search="select * from admin_login where email='$email' and status='active' ";
       $query=mysqli_query($con,$email_search);
       $email_count=mysqli_num_rows($query);
       if($email_count)
       {
           $email_pass=mysqli_fetch_assoc($query);
            $_SESSION['username']=$email_pass['username'];
           $db_pass=$email_pass['password'];
           $pass_decode=password_verify($password,$db_pass);

           if($pass_decode){
            ?>
           
            <script>
             
            alert("Login succesfully");
            </script>
            <?php
            header("Location:index.php");
                 
           }
           else{
            ?>
            <script>
            alert("Inavalid email or password");
            </script>
            <?php
           }
       }
       else{
        ?>
        <script>
        alert("Inavalid email or password ");
        </script>
        <?php
       }
   }

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
   
 
      <div class="sufee-login d-flex align-content-center flex-wrap">
         <div class="container">
            <div class="login-content">
               <div class="login-form mt-150">
                  <form method="POST" >
                  <div>
                        <p class="bg-success text-white px-4 "style="padding: 1%;,margin:1%"><?php 
                          
                          if(isset($_SESSION['msg'])){
                            echo $_SESSION['msg'];
                          }
                          else{
                            echo $_SESSION['msg']="You are logged out!";
                          }
                        
                          ?> </p>
                   </div>
                     <div class="form-group">
                        <label>Email address</label>
                        <input type="email" name="email"class="form-control" placeholder="Email" required>
                     </div>
                     <div class="form-group">
                        <label>Password</label>
                        <input type="password" name="password" class="form-control" placeholder="Password" required>
                     </div>
                     <button type="submit" name="submit" class="btn btn-success btn-flat m-b-30 m-t-30">Sign in</button>
                     <p class="text-center">Forget Your Password ?<a href="recover_email.php">Reset Password</a></p>
                     <p class="text-center">Don't have an account ?<a href="signup.php">Sign Up</a></p>
                    
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