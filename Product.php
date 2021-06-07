<?php

session_start();
include "dbconnection.php";
if(!isset($_SESSION['username'])){
  header("Location:login.php");
}
require('dbconnection.php');

//updating active or deactive catagory

if(isset($_GET['type']) && $_GET['type']!=''){
 
    $type=mysqli_real_escape_string($con,$_GET['type']);
    if($type=='status'){
       $operation =mysqli_real_escape_string($con,$_GET['operation']);
       $id=mysqli_real_escape_string($con,$_GET['id']);
       if($operation=='active'){
          $status='1';
       }
       else{
          $status='0';
       }
       $update_status="update product set status='$status' where id='$id' ";
       mysqli_query($con,$update_status);
   }
   if($type=='delete'){
     
      $id=mysqli_real_escape_string($con,$_GET['id']);
      
      $delete="delete from  product where id='$id' ";
      mysqli_query($con,$delete);
  }
}


//display catagory
$query = "SELECT product.*,categaries.category  from product,categaries where product.category_id=categaries.id order by product.id desc";
$data=mysqli_query($con,$query);




?>

<!doctype html>
<html class="no-js" lang="">
   <meta http-equiv="content-type" content="text/html;charset=UTF-8" />
   <head>
      <meta charset="utf-8">
      <meta http-equiv="X-UA-Compatible" content="IE=edge">
      <title>Dashboard Page</title>
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
   <body>
     
   <aside id="left-panel" class="left-panel">
         <nav class="navbar navbar-expand-sm navbar-default">
            <div id="main-menu" class="main-menu collapse navbar-collapse">
               <ul class="nav navbar-nav">
                  
               <li class="menu-title">Menu</li>
                  <li class="menu-item-has-children dropdown">
                     <a href="index.php" >Catagorry</a>
                  </li>
                  <li class="menu-item-has-children dropdown">
                     <a href="Product.php" >Product</a>
                  </li>
				  <li class="menu-item-has-children dropdown">
                     <a href="#" > Order Master</a>
                  </li>
                  <li class="menu-item-has-children dropdown">
                     <a href="#" > User Master</a>
                  </li>
                  <li class="menu-item-has-children dropdown">
                     <a href="contact.php" > Contact Us</a>
                  </li>
               </ul>
            </div>
         </nav>
      </aside>
      <div id="right-panel" class="right-panel">
         <header id="header" class="header">
            <div class="top-left">
               <div class="navbar-header">
                  <a class="navbar-brand" href="index.html"><img src="images/logo.png" alt="Logo"></a>
                  <a class="navbar-brand hidden" href="index.html"><img src="images/logo2.png" alt="Logo"></a>
                  <a id="menuToggle" class="menutoggle"><i class="fa fa-bars"></i></a>
               </div>
            </div>
            <div class="top-right">
               <div class="header-menu">
                  <div class="user-area dropdown float-right">
                     <a href="#" class="dropdown-toggle active" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">Welcome Admin</a>
                     <div class="user-menu dropdown-menu">
                        <a class="nav-link" href="logout.php"><i class="fa fa-power-off"></i>Logout</a>
                     </div>
                  </div>
               </div>
            </div>
         </header>
         <div class="content pb-0">
            <div class="orders">
               <div class="row">
                  <div class="col-xl-12">
                     <div class="card">
                        <div class="card-body">
                           <h4 class="box-title">Product </h4>
                           <h4 class="box-title"><a href="add_product.php">Add Product </a></h4>
                        </div>
                        <div class="card-body--">
                           <div class="table-stats order-table ov-h">
                              <table class="table ">
                                 <thead>
                                    <tr>
                                       <th class="serial">#</th>
                                       <th >Name</th>
                                       <th>Category</th>
                                       <th>Image</th>
                                       <th>Mrp</th>
                                       <th>price</th>
                                       <th>qty</th>
                                       <th>short_desc</th>
                                       <th>des</th>
                                       <th>meta_title</th>
                                       <th>meta_desc</th>
                                       <th>meta_keyword</th>
                                       <th>status</th>
                                       
                                    </tr>
                                 </thead>
                                 <tbody>
                                   
                                 <?php
                                   $i=1;
                                   while($result=mysqli_fetch_assoc($data)){ 
                                 ?>
                              
	                              
                                    <tr>
                                       <td class="serial"><?php echo $result['id']; ?> </td>
                                       
                                       <td><?php echo $result['name']; ?> </td>
                                       <td><?php echo $result['category']; ?> </td>
                                       <td><?php echo "<img src='../media/product".$result['image']."' >" ?></td>
                                       <td><?php echo $result['mrp']; ?> </td>
                                       <td><?php echo $result['saving_price']; ?> </td>
                                       <td><?php echo $result['qty']; ?> </td>
                                       <td><?php echo $result['short_desc']; ?> </td>
                                       <td><?php echo $result['des']; ?> </td>
                                       <td><?php echo $result['meta_title']; ?> </td>
                                       <td><?php echo $result['meta_desc']; ?> </td>
                                       <td><?php echo $result['meta_keyword']; ?> </td>
                                       
                                       <td><?php 
                                       if($result['status']==1){
                                          echo "<span class='badge badge-complete'><a href='?type=status&operation=deactive&id=".$result['id']." '>Active</a></span>&nbsp";
                                       }
                                       else{
                                          echo "<span class='badge badge-pending'><a href='?type=status&operation=active&id=".$result['id']." '>Deactive</a></span>&nbsp";
                                       }
                                       echo "<span class='badge badge-edit'><a href='add_product.php?id=".$result['id']." '> Edit </a></span>";
                                       echo "<span class='badge badge-delete'><a href='?type=delete&id=".$result['id']." '> Delete </a></span>";
                                     ?> </td>
                                       
                                    </tr>
                                    <?php  } ?>
                                    
                                 
                                
                                  
                                  
                                 </tbody>
                              </table>
                           </div>
                        </div>
                     </div>
                  </div>
               </div>
            </div>
		  </div>
         <div class="clearfix"> </div>
         <footer class="site-footer">
            <div class="footer-inner bg-white">
               <div class="row">
                  <div class="col-sm-6">
                     Copyright &copy; 2018 Ela Admin
                  </div>
                  <div class="col-sm-6 text-right">
                     Designed by <a href="https://colorlib.com/">Nency</a>
                  </div>
               </div>
            </div>
         </footer>
      </div>
      <script src="assets/js/vendor/jquery-2.1.4.min.js" type="text/javascript"></script>
      <script src="assets/js/popper.min.js" type="text/javascript"></script>
      <script src="assets/js/plugins.js" type="text/javascript"></script>
      <script src="assets/js/main.js" type="text/javascript"></script>
   </body>
</html>