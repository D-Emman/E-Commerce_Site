<?php 
if(isset($_GET['delete_payment'])){
    $delete_payment = $_GET['delete_payment'];
 
// echo "<script>   if (confirm('Proceed to Checkout')) ";
    $delete_query = "Delete from `user_payments` where 
    payment_id = $delete_payment";
    $result = mysqli_query($con,$delete_query);
    if($result){
        echo "<script>alert('Payment has been deleted successfully')</script>";
        echo "<script>window.open('./index.php?list_payments','_self')</script>";
    }
}

?>