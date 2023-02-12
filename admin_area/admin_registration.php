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
    <title>Admin Registration</title>
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
    Admin Registration
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
            <label for="email" class="form-label">Email</label>
            <input type="email" name="email" class="form-control" id="email" placeholder="Enter your Email" required>
        </div>

        <div class="form-outline mb-4 w-50 m-auto">
            <label for="password" class="form-label">Password</label>
            <input type="password" name="password" class="form-control" id="password" placeholder="Enter your password" required>
        </div>

        <div class="form-outline mb-4 w-50 m-auto">
            <label for="confirm_password" class="form-label">Confirm Password</label>
            <input type="password" name="confirm_password" class="form-control" id="confirm_password" placeholder="Confirm your password" required>
        </div>

        <div class="form-outline mb-4 w-50 m-auto">
            <label for="user_image" class="form-label">User Image</label>
            <input type="file" name="user_image" class="form-control"  required>
        </div>

<div class='mb-4 w-50 m-auto'>
    <input type="submit" value="Register" class="bg-info py-2 px-3" name="admin_register">
    <p class="small fw-bold mt-2 pt-1">Do you already have an account? <a href="admin_login.php" class='link-danger' >Login</a></p>
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
if(isset($_POST['admin_register'])){
  $admin_name = $_POST['username'];
  $admin_email = $_POST['email'];
  $password = $_POST['password'];
  $admin_password = password_hash($password,PASSWORD_DEFAULT);
  $confirm_password = $_POST['confirm_password'];
  $admin_image = $_FILES['user_image']['name'];
  $admin_image_tmp = $_FILES['user_image']['tmp_name'];
  $admin_ip = getIPAddress();

  //select query
  $select_query = "Select * from `admin_table` where admin_name= '$admin_name' or admin_email ='$admin_email'";
  $result = mysqli_query($con,$select_query);
  $rows_count = mysqli_num_rows($result);
  if($rows_count>0){
    echo"<script>alert('This Admin already exists')</script>";
  }
  else if($password!=$confirm_password){
    echo"<script>alert('Passwords do not match')</script>";
  }
  else{

  //insert_query
  move_uploaded_file($admin_image_tmp,"./product_images/$admin_image");
  $insert_query = "insert into `admin_table` (admin_name,admin_email,admin_password,admin_ip,admin_image,date) 
  values('$admin_name',' $admin_email','$admin_password','$admin_ip','$admin_image',NOW())";
  $sql_execute = mysqli_query($con,$insert_query);
  }
  if($sql_execute){
    echo "<script>window.open('index.php','_self')</script>";
  }

}
}
?>
