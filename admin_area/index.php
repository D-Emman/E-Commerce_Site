<!-- connect file to database -->

<?php
include("../includes/connect.php");
include("../functions/common-function.php");
session_start();
?>
<?php
                    if(isset($_SESSION['admin_name'])){


                        ?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-gH2yIJqKdNHPEq0n4Mqa/HGKIhSkIHeL5AyhkYV8i59U5AR6csBvApHHNl/vI1Bx" crossorigin="anonymous">
   <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.1.2/css/all.min.css" integrity="sha512-1sCRPdkRXhBV2PBLUdRb4tMg1w2YPf37qatUFeS7zlBy7jJI8Lf4VHwWfZZfpXtYSLy85pkm9GaYVYMfw5BC1A==" crossorigin="anonymous" referrerpolicy="no-referrer" />

   <!-- <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-gH2yIJqKdNHPEq0n4Mqa/HGKIhSkIHeL5AyhkYV8i59U5AR6csBvApHHNl/vI1Bx" crossorigin="anonymous"> -->
   <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/css/bootstrap.min.css">
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/js/bootstrap.min.js"></script>
   <link rel="stylesheet" href="../styles.css">
    <title>Admin Dashboard</title>
    <style>
        .admin-image{
    width: 100px;
    object-fit: contain;
}     
       .footer{
        
        bottom:0
       }
       body{
        overflow-x: hidden;
       }
       .product_img{
        width: 100px;
        object-fit: contain;
       }
    </style>
</head>
<body>
    

    <!-- navbar --->
    <div class="container-fluid p-0 ">
    <!-- first child -->
        <nav class="navbar navbar-expand-lg navbar-light bg-info">
            <div class="container-fluid">
                <div>
                    <?php
                    if(isset($_SESSION['username'])){
echo "<li class='nav-item'>
<h2 class='text-success bg-light ' href='#'>Welcome " .$_SESSION['username']."</h2>
</li>";
                    }
?>
                </div>
                <img src="../Images/Technology/1(1).jpg" class="logo" alt="">
                <nav class="navbar navbar-expand-lg ">
                    <ul class="navbar-nav">
                        <!-- <li class="nav-item">
                            <a href="" class="nav-link">Welcome guest</a>
                        </li> -->
                    </ul>
                </nav>
                </div>
        </nav>
        
                <!--second child -->
                <div class="bg-light">
                    <h3 class="text-center p-2">Manage Details</h3>
                </div>

                                <!--third child -->
           <div class="row">
            <div class="col-md-12 bg-secondary p-1 d-flex align-items-center">
                <div class="px-2 mr-8 ">
                    
                    <?php
                    if(isset($_SESSION['username'])){
            $username = $_SESSION['username'];
        $fetch_image = "Select * from `admin_table` where admin_name = '$username'";
        $result = mysqli_query($con,$fetch_image);
        $fetch = mysqli_fetch_assoc($result);
        $image = $fetch['admin_image'];

                 echo" <img src='./product_images/$image' alt='admin' class='admin-image m-1'> ";
                        




                    }

        ?>
     
                </div>
                <div class="button text-center ">
                    <!-- button*10>a.nav-link.text-light.bg-info.my-1 -->
                    <button class="mb-2 mx-3"><a href="insert_product.php" class="nav-link text-light bg-info my-0 p-3 fw-bold">Insert Products</a></button>
                    <button class="mb-2 mx-3"><a href="index.php?view_products" class="nav-link text-light bg-info my-0 p-3 fw-bold">View Products</a></button>
                    <button class="mb-2 mx-3"><a href="index.php?insert_category " class="nav-link text-light bg-info my-0 p-3 fw-bold">Insert Categories</a></button>
                    <button class="mb-2 mx-3"><a href="index.php?view_categories" class="nav-link text-light bg-info my-0 p-3 fw-bold">View Categories</a></button>
                    <button class="mb-2 mx-3"><a href="index.php?insert_brand " class="nav-link text-light bg-info my-0 p-3 fw-bold">Insert Brands</a></button>
                    <button class="mb-2 mx-3"><a href="index.php?view_brands" class="nav-link text-light bg-info my-0 p-3 fw-bold">View Brands</a></button>
                    <button class="mb-2 mx-3"><a href="index.php?list_orders" class="nav-link text-light bg-info my-0 p-3 fw-bold">All Orders</a></button>
                    <button class="mb-2 mx-3"><a href="index.php?list_payments" class="nav-link text-light bg-info my-0 p-3 fw-bold">All Payments</a></button>
                    <button class="mb-2 mx-3"><a href="index.php?list_users" class="nav-link text-light bg-info my-0 p-3 fw-bold">List users</a></button>
                    <button class="mb-2 mx-3"><a href="../users_area/logout.php" class="nav-link text-light bg-info my-0 p-3 fw-bold">Logout</a></button>

                </div>

            </div>
           </div>

<!---- fourth child-->
<div class="container my-3 ">
    <?php
    if(isset($_GET['insert_category'])){
        include('insert_categories.php');
    }
    if(isset($_GET['insert_brand'])){
        include('insert_brands.php');
    }
    if(isset($_GET['view_products'])){
        include('view_product.php');
    }
    if(isset($_GET['edit_products'])){
        include('edit_products.php');
    }
    if(isset($_GET['delete_product'])){
        include('delete_product.php');
    }
    if(isset($_GET['view_categories'])){
        include('view_categories.php');
    }
    if(isset($_GET['view_brands'])){
        include('view_brands.php');
    }
    if(isset($_GET['edit_category'])){
        include('edit_category.php');
    }
    if(isset($_GET['edit_brand'])){
        include('edit_brand.php');
    }
    if(isset($_GET['delete_category'])){
        include('delete_category.php');
    }
    if(isset($_GET['delete_brand'])){
        include('delete_brand.php');
    }
    if(isset($_GET['list_orders'])){
        include('list_orders.php');
    }
    if(isset($_GET['delete_order'])){
        include('delete_order.php');
    }
    if(isset($_GET['list_payments'])){
        include('list_payments.php');
    }
    if(isset($_GET['delete_payment'])){
        include('delete_payment.php');
    }
    if(isset($_GET['list_users'])){
        include('list_users.php');
    }
    if(isset($_GET['delete_user'])){
        include('delete_user.php');
    }
    ?>
</div>



           <!----------last child -------->
           <div class="bg-info p-3 text-center footer">
   <p>All rights reserved ©-Designed by Emmane</p> 
</div>
    </div>
  

<!-- JavaScript Bundle with Popper -->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0/dist/js/bootstrap.bundle.min.js" integrity="sha384-A3rJD856KowSb7dwlZdYEkO39Gagi7vIsF0jrRAoQmDKKtQBHUuLZ9AsSv4jD4Xa" crossorigin="anonymous"></script>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/js/bootstrap.min.js"></script> <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0/dist/js/bootstrap.bundle.min.js" integrity="sha384-A3rJD856KowSb7dwlZdYEkO39Gagi7vIsF0jrRAoQmDKKtQBHUuLZ9AsSv4jD4Xa" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.5/dist/umd/popper.min.js" integrity="sha384-Xe+8cL9oJa6tN/veChSP7q+mnSPaj5Bcu9mPX5F5xIGE0DVittaqT5lorf0EI7Vk" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0/dist/js/bootstrap.min.js" integrity="sha384-ODmDIVzN+pFdexxHEHFBQH3/9/vQ9uori45z4JjnFsRydbmQbmL5t1tQ0culUzyK" crossorigin="anonymous"></script> 
</body>
</html>


<?php


                    }
                    else{ echo"<h1>UnAuthorized Access</h1>";}?>