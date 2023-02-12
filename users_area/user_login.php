<!-- connect file to database -->
<?php
include("../includes/connect.php");
include("../functions/common-function.php");
@session_start();
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
    <style>
     body{
      overflow-x: hidden;
     } 
    </style>
</head>
<body>
    <div class="container-fluid my-3 w-50">
      <h2 class="text-center">User Login</h2>   
      <div class="row d-flex align-item-center justify-content-center mt-5">
        <div class="lg-12 xl-6">
            <form action="" method="post" >
   <div class="form-outline mb-4">
   <!-- username field-->
     <label for="user_username" class="form-label">Username</label>
     <input type="text"  id="user_username" class="form-control" placeholder="Enter your username" autocomplete="off" required name="user_username"/>
   </div>

  

   <div class="form-outline mb-4">
 <!-- password field-->
 <label for="user_password" class="form-label">Password</label>
     <input type="password"  id="user_password" class="form-control" placeholder="Enter your password" autocomplete="off" required name="user_password"/>
   </div>

   <div class="mt-4 pt-2">
    <input type="submit" value="Login" class="bg-info py-2 px-3 border-0" name="user_login">
    <p class="small fw-bold mt-2 pt-1">Don't have an account ? <a href="user_registration.php" class="text-danger text-decoration-none">Register</a></p>
   </div>

            </form>
        </div>
      </div>
    </div>
</body>
</html>
<?php
if(isset($_POST['user_login'])){
   $user_username = $_POST['user_username'];

   $user_password = $_POST['user_password'];
  
   $select_query = "Select * from `user_table` where username = '$user_username'";
   $result = mysqli_query($con,$select_query);
   $row_count = mysqli_num_rows($result);
   $row_data = mysqli_fetch_assoc($result);
   $user_ip = getIPAddress();
   
   
   //cart item
   $select_queries = "Select * from `cart_details` where ip_address = '$user_ip'";
   $select_cart = mysqli_query($con,$select_queries);
   $row_count_cart = mysqli_num_rows($select_cart);

   if($row_count>0){
    $_SESSION['username'] = $user_username;
    if(password_verify($user_password,$row_data['user_password'])){
      //echo "<script>alert('Login Successful')</script>";
      if($row_count_cart == 0 and  $row_count == 1 ){
        $_SESSION['username'] = $user_username;
        echo "<script>alert('Login Successful')</script>";
        echo "<script>window.open('profile.php','_self')</script>";
      }else{
        $_SESSION['username'] = $user_username;
        echo "<script>alert('Login Successful')</script>";
        echo "<script>window.open('checkout.php','_self')</script>";
      }
    }else{
      echo "<script>alert('Invalid Password')</script>";
    }
   } else{
    echo "<script>alert('Invalid Credentials')</script>";
   }

}


?>