<?php

   session_start();
   include 'dbconnection.php';

   if(isset($_GET['token'])){
       $token=$_GET['token'];
       $updatequery="update admin_login set status='active' where token='$token' ";

       $query=mysqli_query($con,$updatequery);
       if($query){
           if(isset($_SESSION['msg'])){
               $_SESSION['msg']="Account Update Succesfully!";
               header("Location:login.php");
           }
           else{
            $_SESSION['msg']="You are Logged out!";
            header("Location:login.php");

           }
       }
       else{
        $_SESSION['msg']="Account not Updated";
        header("Location:signup.php");
       }

   }
?>