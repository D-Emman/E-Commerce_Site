<!-- connect file to database -->
<?php
include("../includes/connect.php");
include("../functions/common-function.php")
?>



<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>User Registration</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-gH2yIJqKdNHPEq0n4Mqa/HGKIhSkIHeL5AyhkYV8i59U5AR6csBvApHHNl/vI1Bx" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.1.2/css/all.min.css" integrity="sha512-1sCRPdkRXhBV2PBLUdRb4tMg1w2YPf37qatUFeS7zlBy7jJI8Lf4VHwWfZZfpXtYSLy85pkm9GaYVYMfw5BC1A==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    
    <link rel="stylesheet" href="styles.css">
</head>
<body>
    <div class="container-fluid my-3 w-50">
      <h2 class="text-center">New User Registration</h2>   
      <div class="row d-flex align-item-center justify-content-center">
        <div class="lg-12 xl-6">
            <form action="" method="post" enctype="multipart/form-data">
   <div class="form-outline mb-4">
   <!-- username field-->
     <label for="user_username" class="form-label">Username</label>
     <input type="text"  id="user_username" class="form-control" placeholder="Enter your username" autocomplete="off" required name="user_username"/>
   </div>

   <div class="form-outline mb-4">
 <!-- email field-->
 <label for="user_email" class="form-label">Email</label>
     <input type="email" id="user_email" class="form-control" placeholder="Enter your email" autocomplete="off" required name="user_email"/>
   </div>

   <div class="form-outline mb-4">
 <!-- image field-->
 <label for="user_image" class="form-label">Email</label>
     <input type="file"  id="user_image" class="form-control"  required name="user_image"/>
   </div>

   <div class="form-outline mb-4">
 <!-- password field-->
 <label for="user_password" class="form-label">Password</label>
     <input type="password" required name="user_password" id="user_password" class="form-control" placeholder="Enter your password" autocomplete="off" />
   </div>

   <div class="form-outline mb-4">
 <!-- confirm password field-->
 <label for="conf_user_password" class="form-label">Confirm Password</label>
     <input type="password"  id="conf_user_password" class="form-control" placeholder="Confirm password" autocomplete="off"  name="conf_user_password"/>
   </div>

   <div class="form-outline mb-4">
   <!-- address field-->
     <label for="user_address" class="form-label">Address</label>
     <input type="text"  id="user_address" class="form-control" placeholder="Enter your address" autocomplete="off" required name="user_address"/>
   </div>

   <div class="form-outline mb-4">
   <!-- Contact field-->
     <label for="user_contact" class="form-label">Contact</label>
     <input type="text"  id="user_contact" class="form-control" placeholder="Enter your mobile number" autocomplete="off" required name="user_contact"/>
   </div>

   <div class="mt-4 pt-2">
    <input type="submit" value="Register" class="bg-info py-2 px-3 border-0" name="user_register">
    <p class="small fw-bold mt-2 pt-1">Already have an account ? <a href="user_login.php" class="text-danger text-decoration-none">Login</a></p>
   </div>

            </form>
        </div>
      </div>
    </div>
</body>
</html>




<!-- php code -->
<?php
if($_SERVER['REQUEST_METHOD'] ==='POST'){
if(isset($_POST['user_register'])){
  $user_username = $_POST['user_username'];
  $user_email = $_POST['user_email'];
  $user_password = $_POST['user_password'];
  $hash_password = password_hash($user_password,PASSWORD_DEFAULT);
  $conf_user_password = $_POST['conf_user_password'];
  $user_address = $_POST['user_address'];
  $user_contact = $_POST['user_contact'];
  $user_image = $_FILES['user_image']['name'];
  $user_image_tmp = $_FILES['user_image']['tmp_name'];
  $user_ip = getIPAddress();

  //select query
  $select_query = "Select * from `user_table` where username= '$user_username' or user_email ='$user_email'";
  $result = mysqli_query($con,$select_query);
  $rows_count = mysqli_num_rows($result);
  if($rows_count>0){
    echo"<script>alert('User already exists')</script>";
  }
  else if($user_password!=$conf_user_password){
    echo"<script>alert('Passwords do not match')</script>";
  }
  else{

  //insert_query
  move_uploaded_file($user_image_tmp,"./user_images/$user_image");
  $insert_query = "insert into `user_table` (username,user_email,user_password,user_image,user_ip,user_address,user_mobile) 
  values('$user_username','$user_email','$hash_password','$user_image','$user_ip','$user_address','$user_contact')";
  $sql_execute = mysqli_query($con,  $insert_query);

  }
  //selecting cart items
  $select_cart_items ="Select * from `cart_details` where ip_address ='$user_ip'";
  $result_cart = mysqli_query($con,$select_cart_items);
  $user_rows_count = mysqli_num_rows($result_cart);
  if($user_rows_count){
    $_SESSION['username'] = $user_username;
    echo"<script>alert('You have items in your cart')</script>";
    echo"<script>window.open('checkout.php','_self')</script>";
  }else{
    echo"<script>window.open('../index.php','_self')</script>";
  }


}
}
?>
