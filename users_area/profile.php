<!-- connect file to database -->
<?php
include("../includes/connect.php");
include("../functions/common-function.php");
session_start();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Welcome <?php $_SESSION['username'] ?></title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-gH2yIJqKdNHPEq0n4Mqa/HGKIhSkIHeL5AyhkYV8i59U5AR6csBvApHHNl/vI1Bx" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.1.2/css/all.min.css" integrity="sha512-1sCRPdkRXhBV2PBLUdRb4tMg1w2YPf37qatUFeS7zlBy7jJI8Lf4VHwWfZZfpXtYSLy85pkm9GaYVYMfw5BC1A==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    
    <link rel="stylesheet" href="../styles.css">
    <style>
        .profile_img{
    width: 90%;
    margin: auto;
    display: block;
    /* height: 100%; */
    object-fit: contain;
    
}
.edit_img{
  width: 100px;
  height: 100px;
}

h1,h2,h3,h4,h5,h6{
    overflow-y: hidden;
}
    </style>
</head>
<body>
    <!--navbar -->
    <div class="container-fluid p-0">
      <!--First Child-->
    <nav class="navbar navbar-expand-lg navbar-light bg-info">
  <div class="container-fluid">
    <img src="../Images/Technology/1(1).jpg" alt="" class="logo">
    <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
      <span class="navbar-toggler-icon"></span>
    </button>
    <div class="collapse navbar-collapse" id="navbarSupportedContent">
      <ul class="navbar-nav me-auto mb-2 mb-lg-0">
        <li class="nav-item">
          <a class="nav-link active" aria-current="page" href="../index.php">Home</a>
        </li>
        <li class="nav-item">
          <a class="nav-link" href="../display_all.php">Products </a>
        </li>

        <li class="nav-item">
          <a class="nav-link" href="profile.php">My Account </a>
        </li>
        <li class="nav-item">
          <a class="nav-link" href="#">Contact</a>
        </li>
        <li class="nav-item">
          <a class="nav-link" href="../cart.php"><i class="fa-solid fa-cart-shopping"></i><sup><?php cart_item();?></sup> </a>
        </li>
        <li class="nav-item">
          <a class="nav-link" href="#">Total Price:₦<?php total_cart_price(); ?></a>
        </li>

      </ul>
      <form class="d-flex" action="../search_product.php" method="GET">
        <input class="form-control me-2" type="search" placeholder="Search" aria-label="Search" name="search_data">
        <input type="submit" value="Search" class="btn btn-primary btn-outline-light" name="search_button">
      </form>
    </div>
  </div>
</nav>



<!--second child--> 
<nav class="navbar navbar-expand-lg navbar-dark bg-secondary">
    <ul class="navbar-nav me-auto">
    
 <?php
 if(!isset($_SESSION['username'])){
  echo  "    <li class='nav-item'>
  <a class='nav-link' href='#'>Welcome Guest </a>
</li>";
 }else{
  echo  "<li class='nav-item'>
  <a class='nav-link' href='#'>Welcome " .$_SESSION['username']."</a>
</li>";
 }
 if(!isset($_SESSION['username'])){
  echo  "<li class='nav-item'>
  <a class='nav-link' href='../users_area/user_login.php'>Login </a>
</li>";
 }else{
  echo  "<li class='nav-item'>
  <a class='nav-link' href='../users_area/logout.php'>Logout</a>
</li>";
 }
 ?>
    </ul>
</nav>

<!--third child-->
<div class="bg-light">
    <h3 class="text-center">KindleStone Store</h3>
    <p class="text-center">User Experience leads to better e-commerce</p>
</div>


<!--fourth child-->
<div class="row">
 <div class="col-md-10">
    <!--products-->
    <div class="row">

    <!--fetching products-->
    <?php
   
    get_unique_categories();
    get_unique_brand();
//     $ip = getIPAddress();
// echo 'User Real IP Address - '.$ip;
?>



<!--row end-->
    </div> 

<!--col end-->
 </div>

 
<!--main child -->
 <div class="row p-2.5" >
    <div class="col-md-2 ">
    <ul class="navbar-nav bg-secondary text-cnter" style="height:100vh">
    <li class="nav-item bg-info">
          <a class="nav-link text-light "  href="#"><h4>Your Profile</h4></a>
    </li> 

    <?php 
   $username = $_SESSION['username'];
   $user_image = "Select * from `user_table` where username = '$username'";
   $result_image = mysqli_query($con,$user_image);
   $fetch_image = mysqli_fetch_array($result_image);
   $user_image= $fetch_image['user_image'];
   echo "<li class='nav-item'>
   <img src='user_images/$user_image' class='profile_img my-4' alt=''>
  </li> "

    ?> 
    
    <li class="nav-item">
          <a class="nav-link text-light "  href="profile.php">Pending orders</a>
    </li> 
    <li class="nav-item">
          <a class="nav-link text-light "  href="profile.php?edit_account">Edit Account</a>
    </li> 
    <li class="nav-item">
          <a class="nav-link text-light "  href="profile.php?my_orders">My Orders</a>
    </li> 
    <li class="nav-item">
          <a class="nav-link text-light "  href="profile.php?delete_account">Delete Account</a>
    </li>  <li class="nav-item">
          <a class="nav-link text-light "  href="logout.php">Logout</a>
    </li> 
    </ul>
    </div>
    <div class="col-md-10">
      <?php
get_user_order_details();
if(isset($_GET['edit_account'])){
  include('./edit_account.php');
}
if(isset($_GET['my_orders'])){
  include('./user_orders.php');
}
if(isset($_GET['delete_account'])){
  include('delete_account.php');
}

      ?>
    </div>
 </div>

         




<!--last child-->
<!--include footer --->
<?php require('../includes/footer.php');

?>   
</div>





<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0/dist/js/bootstrap.bundle.min.js" integrity="sha384-A3rJD856KowSb7dwlZdYEkO39Gagi7vIsF0jrRAoQmDKKtQBHUuLZ9AsSv4jD4Xa" crossorigin="anonymous"></script>
  </body>
</body>
</html>