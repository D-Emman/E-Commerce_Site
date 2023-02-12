<?php
       include('../includes/connect.php');
if(isset($_POST['insert_product'])){
    $product_title = $_POST['product_title'];
    $description = $_POST['description'];
    $keyword = $_POST['keyword'];
    $product_category = $_POST['product_category'];
    $product_brand = $_POST['product_brand'];
    $product_price = $_POST['product_price'];
    $product_status = "true";

    //accessing images
    $product_image1 = $_FILES['product_image1']['name'];
    $product_image2 = $_FILES['product_image2']['name'];
    $product_image3 = $_FILES['product_image3']['name'];

    //accessing image temp name
    $temp_image1 = $_FILES['product_image1']['tmp_name'];
    $temp_image2 = $_FILES['product_image2']['tmp_name'];
    $temp_image3 = $_FILES['product_image3']['tmp_name'];

    //checking empty condition
    if($product_title=='' or   $description=='' or  $keyword=='' or  $product_category=='' or $product_brand=='' or  $product_price=='' or  $product_image1=='' or $product_image3=='' or $product_image3==''){
        echo "<script>alert('Please fill all the available fields')</script>";
        exit();
    }
else{
    move_uploaded_file($temp_image1,"./product_images/$product_image1");
    move_uploaded_file($temp_image2,"./product_images/$product_image2");
    move_uploaded_file($temp_image3,"./product_images/$product_image3");

    //insert query
    $insert_products = "insert into `products` (product_title,product_description,product_keywords,category_id,brand_id,product_image1,product_image2,product_image3,product_price,date,status) 
    values ('$product_title','$description','$keyword','$product_category','$product_brand','$product_image1','$product_image2','$product_image3','$product_price',NOW(),'$product_status') ";
    $result_query = mysqli_query($con,$insert_products);
    if($result_query){
        echo "<script>alert('Successfully inserted the products')</script>";
    }
}
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-gH2yIJqKdNHPEq0n4Mqa/HGKIhSkIHeL5AyhkYV8i59U5AR6csBvApHHNl/vI1Bx" crossorigin="anonymous">
   <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.1.2/css/all.min.css" integrity="sha512-1sCRPdkRXhBV2PBLUdRb4tMg1w2YPf37qatUFeS7zlBy7jJI8Lf4VHwWfZZfpXtYSLy85pkm9GaYVYMfw5BC1A==" crossorigin="anonymous" referrerpolicy="no-referrer" />
   <link rel="stylesheet" href="../styles.css">
    <title>Insert Products</title>
</head>
<body class="bg-light">
    <div class="container mt-3 ">	
        <h1 class="text-center">Insert Products</h1>
       <!--form -->
       <form action="" method="post" enctype="multipart/form-data">

       <!-- Title-->
       <div class="form-outline mb-4 w-50 m-auto">
        <label for="product title" class="form-label">Product Title</label>
        <input type="text" name="product_title" id="product_title" class="form-control" placeholder="Enter product title" autocomplete="off" required>
       </div>

           <!-- Description-->
           <div class="form-outline mb-4 w-50 m-auto">
        <label for="description" class="form-label">Product Description</label>
        <input type="text" name="description" id="description" class="form-control" placeholder="Enter product description" autocomplete="off" required>
       </div>

        <!-- Keyword-->
        <div class="form-outline mb-4 w-50 m-auto">
        <label for="keyword" class="form-label">Product Keywords</label>
        <input type="text" name="keyword" id="keyword" class="form-control" placeholder="Enter product keyword" autocomplete="off" required>
       </div>



 <!-- categories-->
 <div class="form-outline mb-4 w-50 m-auto">
       <select name="product_category" id="" class="form-select"> 
        <option value="">Select a Category</option>
     
     <?php
       include('../includes/connect.php');
$select_categories = "Select * from `categories` ";
$result_categories = mysqli_query($con,$select_categories);
// $row_data = mysqli_fetch_assoc($result_brands);
// echo $row_data['category_title'];
while($row_data = mysqli_fetch_assoc($result_categories)){
  $category_title = $row_data['category_title'];
  $category_id = $row_data['category_id'];
  echo  "        <option value='$category_id'>$category_title</option>
</li>";
} ?>
       </select>
       </div>

       
 <!-- brands-->
 <div class="form-outline mb-4 w-50 m-auto">
       <select name="product_brand" id="" class="form-select"> 
        <option value="">Select a Brand</option>
    
    <?php
$select_brands = "Select * from `brands` ";
$result_brands = mysqli_query($con,$select_brands);
// $row_data = mysqli_fetch_assoc($result_brands);
// echo $row_data['category_title'];
while($row_data = mysqli_fetch_assoc($result_brands)){
  $brand_title = $row_data['brand_title'];
  $brand_id = $row_data['brand_id'];
  echo  "        <option value='$brand_id'>$brand_title</option>
</li>";
} ?>
       </select>
       </div>

        <!-- Image 1-->
        <div class="form-outline mb-4 w-50 m-auto">
        <label for="product_image1" class="form-label">Product Image 1</label>
        <input type="file" name="product_image1" id="product_image1" class="form-control"   required>
       </div>

        <!-- Image 1-->
        <div class="form-outline mb-4 w-50 m-auto">
        <label for="product_image2" class="form-label">Product Image 2</label>
        <input type="file" name="product_image2" id="product_image2" class="form-control"   required>
       </div>

        <!-- Image 3-->
        <div class="form-outline mb-4 w-50 m-auto">
        <label for="product_image3" class="form-label">Product Image 3</label>
        <input type="file" name="product_image3" id="product_image3" class="form-control"   required>
       </div>


  <!-- Price-->
  <div class="form-outline mb-4 w-50 m-auto">
        <label for="product_price" class="form-label">Product price</label>
        <input type="text" name="product_price" id="product_price" class="form-control" placeholder="Enter product price" autocomplete="off" required>
       </div>

 <!-- Submit-->
 <div class="form-outline mb-4 w-50 m-auto">
   <input type="submit" name="insert_product" class="btn btn-info mb-3 px-3" value="Insert Products">
       </div>



       </form>


    </div>
    







<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0/dist/js/bootstrap.bundle.min.js" integrity="sha384-A3rJD856KowSb7dwlZdYEkO39Gagi7vIsF0jrRAoQmDKKtQBHUuLZ9AsSv4jD4Xa" crossorigin="anonymous"></script>
</body>
</html>