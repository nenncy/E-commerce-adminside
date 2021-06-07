<?php
  session_start();
?>


<!doctype html>
<html class="no-js" lang="">
   <meta http-equiv="content-type" content="text/html;charset=UTF-8" />
   <head>
      <meta charset="utf-8">
      <meta http-equiv="X-UA-Compatible" content="IE=edge">
      <title>Sign up Page</title>
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
     $emailErr =" ";


   
     if(isset($_POST['submit'])){
      $username= mysqli_real_escape_string($con,$_POST['username']);
      $email=mysqli_real_escape_string($con,$_POST['email']);
      error_reporting(0);
     
      $phone=mysqli_real_escape_string($con,$_POST['phone']);
      $password=mysqli_real_escape_string($con,$_POST['password']);
     
      
    

      $pass=password_hash($password,PASSWORD_BCRYPT);
      //token
      $token=bin2hex(random_bytes(15));

      $emailquery="select * from admin_login where email='$email' ";
      $query=mysqli_query($con,$emailquery);
      
      $emailcount=mysqli_num_rows($query);
      if($emailcount>0)
      {
        ?>
        <script>
        alert("Email already Exist");
        </script>
        <?php
        
      }
      else
      {
          $insertquery="insert into admin_login (username,email,phone,password,token,status) values ('$username','$email','$phone','$pass','$token','inactive') ";
          $iquery=mysqli_query($con,$insertquery);
          if($iquery)
          {
            $subject="Email activation";
            $body="Hi, $username. Click to activate your account
             http://localhost/adminpanel/activate.php?token=$token";
            $headers="From: nencyvpatel3010@gmail.com";
            if(mail($email,$subject,$body,$headers))
            {
              $_SESSION['msg']="Check your mail to activate your 
                      account $email";
                      header("Location:login.php");

            }
            else{
              echo "Email sending failed";
            }
              ?>
              <script>
              alert("Register succesfully");
              </script>
              <?php
              header("Location:login.php");
          }
          else{
            
            ?>
            <script>
            alert("Un succesfully");
            </script>
            <?php
          }
        }
      
  
  }

    

?>


   
 
      <div class="sufee-login d-flex align-content-center flex-wrap">
         <div class="container">
            <div class="login-content">
               <div class="login-form mt-150">
                  <form method="POST" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>">
                     <div class="form-group">
                        <label>Email address</label>
                        <input type="email" name="email" class="form-control" placeholder="Email" required>
                     </div>
                     <div class="form-group">
                        <label>Username</label>
                        <input type="username" name="username" class="form-control" placeholder="Name" required>
                     </div>
                     <div class="form-group">
                        <label>Phone</label>
                        <input type="username" name="phone" class="form-control" placeholder="Phone" required>
                     </div>
                     <div class="form-group">
                        <label>Password</label>
                        <input type="password" name="password" class="form-control" placeholder="Password" required>
                     </div>
                     <button type="submit" name="submit" class="btn btn-success btn-flat m-b-30 m-t-30">Sign up</button>
                     <div >
                    <p class="text-center">Do you have an account ?<a href="login.php">Sign in</a></p>
                    </div>
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