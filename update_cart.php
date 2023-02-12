<?php
 $get_ip_add = getIPAddress();

 if(isset($_GET['products_id'])){
    $quantity = ($_GET['quantity']);
    $update_id = ($_GET['products_id']);
    $get_ip_add = getIPAddress();
     
    // echo "<h1>$quantity</h1>";
    // echo "<h1>$product_title</h1>";
    // echo "<h1>$product_id</h1>";
    $updateCart = "UPDATE cart_details SET quantity=$quantity WHERE ip_address ='$get_ip_add' and product_id = $update_id";
    $result_price_quantity = mysqli_query($con,$updateCart);
    }
?>