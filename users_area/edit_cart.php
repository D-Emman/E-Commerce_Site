
<?php
$get_ip_add = getIPAddress();
if(isset($_GET['edit_cart'])){
    $edit_cart = $_GET['edit_cart'];

    $get_cart = "Select * from `cart_details` where product_id=$edit_cart";

    $result = mysqli_query($con, $get_cart);
    $row = mysqli_fetch_assoc($result);
    $product_quantity = $row['quantity'];

    

}
?>

<div class="container mt-3">
    
    <form action="" method="post" class="text-center">
     <div class="form-outline mb-4 w-50 m-auto">
        <label for="quantity" class="form-label">Edit </label>
        <input type="number" name="quantity" id="quantity" class="form-control w-50 m-auto"  required>
     </div>
     <input name="edit_cat" type="submit" value="Update Quantity" class="btn btn-info px-3 mb-3" >
     <?php
$get_ip_add = getIPAddress();

if(isset($_POST['edit_cat'])){
    $cart_quantity = $_POST['quantity'];
    echo"$cart_quantity";
    $update_query = "UPDATE `cart_details` set quantity = $cart_quantity where product_id='3' and ip_address = '$get_ip_add'  ";
    $result_cart = mysqli_query($con,$update_query);
    if($result_cart){
        echo "<script>alert('Cart has been updated successfully')</script>";
        echo "<script>window.open('./index.php?view_categories','_self')</script>";
    }
}

?>
    </form>
</div>



