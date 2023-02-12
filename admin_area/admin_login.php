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
    <title>Admin Login</title>
       <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-gH2yIJqKdNHPEq0n4Mqa/HGKIhSkIHeL5AyhkYV8i59U5AR6csBvApHHNl/vI1Bx" crossorigin="anonymous">
   <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/css/bootstrap.min.css">
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
  <!-- <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/js/bootstrap.min.js"></script> -->
   <link rel="stylesheet" href="../styles.css">
   <style>

   </style>
</head>
<body>
    <div class="container-fluid m-3">
  <h2 class="text-center mb-5">
    Admin Login
  </h2>
<div class="row d-flex justify-content-center ">
    <div class="col-lg-6 col-xl-5">
        <img src="../Images/slim1.jfif" alt="Admin Registration" class="img-fluid">
    </div>
    <div class="col-lg-6 col-xl-4">


      <form action="" method="post" enctype="multipart/form-data">
        <div class="form-outline mb-4 w-50 m-auto">
            <label for="username" class="form-label">Username</label>
            <input type="text" name="username" class="form-control" id="username" placeholder="Enter Username" required>
        </div>

        <div class="form-outline mb-4 w-50 m-auto">
            <label for="password" class="form-label">Password</label>
            <input type="password" name="password" class="form-control" id="password" placeholder="Enter your password" required>
        </div>


<div class='mb-4 w-50 m-auto'>
    <input type="submit" value="Login" class="bg-info py-2 px-3" name="admin_login">
    <p class="small fw-bold mt-2 pt-1">Don't you have an account? <a href="admin_registration.php" class='link-danger'>Register</a></p>
</div>

      </form> 
    </div>
</div>

    </div>
</body>
</html>


<?php
if(isset($_POST['admin_login'])){
   $username = $_POST['username'];

   $password = $_POST['password'];
  
   $select_query = "Select * from `admin_table` where admin_name = '$username'";
   $result = mysqli_query($con,$select_query);
   $row_count = mysqli_num_rows($result);
   $row_data = mysqli_fetch_assoc($result);
//    $user_ip = getIPAddress();
   
   
   
    $_SESSION['admin_name'] = $username;
    if(password_verify($password,$row_data['admin_password'])){
      
        $_SESSION['username'] = $username;
        echo "<script>alert('Login Successful')</script>";
        echo "<script>window.open('index.php','_self')</script>";
      
       
    }else{
      echo "<script>alert('Invalid Password')</script>";
    }



   } 




?>