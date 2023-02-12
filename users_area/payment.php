<?php
include("../includes/connect.php");
include("../functions/common-function.php");
//@session_start();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Payment Page</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-gH2yIJqKdNHPEq0n4Mqa/HGKIhSkIHeL5AyhkYV8i59U5AR6csBvApHHNl/vI1Bx" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.1.2/css/all.min.css" integrity="sha512-1sCRPdkRXhBV2PBLUdRb4tMg1w2YPf37qatUFeS7zlBy7jJI8Lf4VHwWfZZfpXtYSLy85pkm9GaYVYMfw5BC1A==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    
    <link rel="stylesheet" href="styles.css">
    <style>
        .img{
            width: 80%;
            margin: auto;
            display: block;
        }
    </style>
</head>
<body>

<!--php code to access user id -->
<?php
$user_ip =getIPAddress();
$get_user = "Select * from `user_table` where user_ip ='$user_ip' ";
$result = mysqli_query($con,$get_user);
$fetch_data = mysqli_fetch_array($result);
$user_id = $fetch_data['user_id'];

?>
    <div class="container">
        <h2 class="text-center text-info">Payment Options</h2>
        <div class="row d-flex justify-content-center align-items-center my-5">
            <div class="col-md-6">
            <a href="https://www.paypal.com" target="_blank">
                <img class="img" src="../Images/slim2.jpg"   alt="payment">
            </a>
            </div>
            <div class="col-md-6">
            <a href="order.php?user_id=<?php echo $user_id?>" >
             <h2 class="text-info text-center">Pay Offline</h2>  
            </a>
            <a href="../display_all.php" class="d-flex">
            <h2 class="text-secondary text-center btn m-auto">Continue Shopping</h2>
            </a>
            </div>
    </div>
    </div>
</body>
</html>