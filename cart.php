<!-- connect file to database -->
<?php
include("./includes/connect.php");
include("./functions/common-function.php");
session_start();
?>





<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Ecommerce website Cart Details</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-gH2yIJqKdNHPEq0n4Mqa/HGKIhSkIHeL5AyhkYV8i59U5AR6csBvApHHNl/vI1Bx" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.1.2/css/all.min.css" integrity="sha512-1sCRPdkRXhBV2PBLUdRb4tMg1w2YPf37qatUFeS7zlBy7jJI8Lf4VHwWfZZfpXtYSLy85pkm9GaYVYMfw5BC1A==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    
    <link rel="stylesheet" href="styles.css">
    <style>
        .cart_img{
    width: 50px;
    height: 50px;
    object-fit: contain;
}
    </style>
</head>
<body>
    <!--navbar -->
    <div class="container-fluid p-0">
      <!--First Child-->
    <nav class="navbar navbar-expand-lg navbar-light bg-info">
  <div class="container-fluid">
    <img src="./Images/Technology/1(1).jpg" alt="" class="logo">
    <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
      <span class="navbar-toggler-icon"></span>
    </button>
    <div class="collapse navbar-collapse" id="navbarSupportedContent">
      <ul class="navbar-nav me-auto mb-2 mb-lg-0">
        <li class="nav-item">
          <a class="nav-link active" aria-current="page" href="index.php">Home</a>
        </li>
        <li class="nav-item">
          <a class="nav-link" href="display_all.php">Products </a>
        </li>

        <?php
if(isset($_SESSION['username'])){
echo"    <li class='nav-item'>
<a class='nav-link' href='./users_area/profile.php'>My Account </a>
</li>";
}else{

  echo"    <li class='nav-item'>
<a class='nav-link' href='./users_area/user_registration.php'>Register </a>
</li>";
}
        ?>
        <li class="nav-item">
          <a class="nav-link" href="#">Contact</a>
        </li>
        <li class="nav-item">
          <a class="nav-link" href="cart.php"><i class="fa-solid fa-cart-shopping"></i><sup><?php cart_item();?></sup> </a>
        </li>
      </ul>
     
    </div>
  </div>
</nav>

<!---calling cart function-->
<?php
cart();
?>

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
  <a class='nav-link' href='./users_area/user_login.php'>Login </a>
</li>";
 }else{
  echo  "<li class='nav-item'>
  <a class='nav-link' href='./users_area/logout.php'>Logout</a>
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


<!--fourth child -->
<div class="container">
   <div class="row">
    <form action="<?php echo $_SERVER['PHP_SELF']; ?>" method="POST" enctype="form/multipath">
    <table class="table table-bordered text-center">
  
        <!-- php code to display dynamic data -->
      <?php
      global $con;
      $get_ip_add = getIPAddress();
      $total = 0;
      $cart_query = "Select * from `cart_details` where ip_address ='$get_ip_add'";
      $result = mysqli_query($con,$cart_query);
      $result_count=mysqli_num_rows($result);
      
      if($result_count>0){
       echo " <thead>
        <tr>
            <th>Product Title</th>
            <th>Product Image</th>
            <th>Quantity</th>
            <th>Total Price</th>
            <th>Remove </th>
            <th colspan='2'>Operations</th>

        </tr>
       </thead> 
       <tbody> ";
       while($row = mysqli_fetch_assoc($result)){
          $number = $row['quantity'];
          $product_id = $row['product_id'];
          $select_products= "Select * from `products` where product_id= $product_id";
          $result_products = mysqli_query($con,$select_products);
          while($row_product_price = mysqli_fetch_array($result_products)){
          $prod_id = $row_product_price['product_id'];
          $product_price = array($row_product_price['product_price']);
          $price_table = $row_product_price['product_price'];
          $product_title = $row_product_price['product_title'];
          $product_image1 = $row_product_price['product_image1'];
          $product_values = array_sum($product_price);

          $total+= $product_values; 

?>

        <tr>
          <td><?php echo $product_title ?></td>  
          <td><img src="./admin_area/product_images/<?php echo $product_image1 ?>" alt="product image" class="cart_img"></td>
     <form>   <td><?php echo  $number ?>  <a href='cart.php?edit_cart=<?php echo $product_id; ?>' ><i class='fa-solid fa-pen-to-square '></i></a>
      <!--update qty -->
<?php

if(isset($_GET['edit_cart'])){
  include('./users_area/edit_cart.php');
}
?>
      </td> 
</form>
         <?php
$get_ip_add = getIPAddress();
if(isset($_POST['update_cart'])){
    
    // $quantity =($_POST['qty']);
    
     
    // echo "<h1>$quantity</h1>";
    // echo "<h1>$product_title</h1>";
    // echo "<h1>$product_id</h1>";
    $updateCart = "UPDATE cart_details SET quantity=$quantity WHERE ip_address ='$get_ip_add'";
    $result_price_quantity = mysqli_query($con,$updateCart);
   $total = $total*$quantity;
}

          ?>
          <td>₦<?php echo  $price_table ?></td>
          <td><input type="checkbox" name="removeitem[]" id="" value="<?php echo $product_id ?>" > </td>
          <td>
            <!-- <button class="bg-info p-3 border-0 mx-3">Update</button> -->
            <input type="submit" value="Update Cart" class="bg-info p-3 border-0 mx-3" name="update_cart">
            <!-- <button class="bg-info p-3 border-0 mx-3">Remove</button> -->
            <input type="submit" value="Remove Cart" class="bg-info p-3 border-0 mx-3" name="remove_cart">
          </td>
        </tr>
        

        <?php }}
       } 
       else{
        echo "<H2 class='text-center text-danger'>Cart is empty</H2>";
       }?>
       </tbody>
    </table>
    <!-- subtotal -->
    <div class="d-flex mb-5">
        <?php
  $get_ip_add = getIPAddress();
  $cart_query = "Select * from `cart_details` where ip_address ='$get_ip_add'";
  $result = mysqli_query($con,$cart_query);
  $result_count=mysqli_num_rows($result);
  if($result_count>0){

   echo "      <h4 class='px-3'> Subtotal: <strong class='text-primary'>₦$total</strong>
   </h4>
   <input type='submit' value='Continue Shopping' class='bg-info p-3 border-0 mx-3' name='continue_shopping'>
<button class='bg-secondary p-3 border-0 text-light'>   <a href='./users_area/checkout.php' class='text-light text-decoration-none' >Checkout</button></a>";
  }
  else{ echo"
    <input type='submit' value='Continue Shopping' class='bg-info p-3 border-0 mx-3' name='continue_shopping'>";
  }
if(isset($_POST['continue_shopping'])){
     echo "<script>window.open('index.php','_self')</script>";
}

        ?>
    
   
    </div>  
    </form>
   </div> 
</div>
 




<!-- function to remove _cart_item -->
<?php
function remove_cart_item(){
    global $con;
  if(isset($_POST['remove_cart'])){
    foreach($_POST['removeitem'] as $remove_id){
       echo $remove_id;
       $delete_query = "Delete from `cart_details` where product_id = $remove_id" ;
       $run_delete = mysqli_query($con,$delete_query);
       if($run_delete){
        echo "<script>window.open('cart.php','self')</script>";
       }
    }
  }
}
echo $remove_item = remove_cart_item();

?>



<!--last child-->
<!--include footer --->
<?php require('./includes/footer.php');

?>   
</div>





<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0/dist/js/bootstrap.bundle.min.js" integrity="sha384-A3rJD856KowSb7dwlZdYEkO39Gagi7vIsF0jrRAoQmDKKtQBHUuLZ9AsSv4jD4Xa" crossorigin="anonymous"></script>
  
</body>
</html>