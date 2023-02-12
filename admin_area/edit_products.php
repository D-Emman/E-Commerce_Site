<?php 

if(isset($_GET['edit_products'])){
    $edit_id = $_GET['edit_products'];

    $get_data = "Select * from `products` where product_id = $edit_id";
    $result = mysqli_query($con,$get_data);
    $row = mysqli_fetch_assoc($result);
    $product_title = $row['product_title'];
    $product_description = $row['product_description'];
    $product_keywords = $row['product_keywords'];
    $category_id = $row['category_id'];
    $brand_id = $row['brand_id'];
    $product_image1 = $row['product_image1'];
    $product_image2 = $row['product_image2'];
    $product_image3 = $row['product_image3'];
    $product_price = $row['product_price'];


    //fetching category name
    $select_category = "Select * from `categories` where category_id = $category_id";
    $result_category = mysqli_query($con, $select_category);
    $row_category = mysqli_fetch_assoc($result_category);
    $category_title = $row_category['category_title'];



 //fetching brand name
 $select_brand = "Select * from `brands` where brand_id = $brand_id";
 $result_brand = mysqli_query($con, $select_brand);
 $row_brand = mysqli_fetch_assoc($result_brand);
 $brand_title = $row_brand['brand_title'];
}

?>


<div class="container mt-5">
    <h1 class="text-center text-success">Edit Products</h1>
    <form action="" method="post" enctype="multipart/form-data">
        <div class="form-outline w-50 m-auto mb-4">
            <label for="product_title" class="form-label">Product Title</label>
            <input type="text" name="product_title" id="product_title" class="form-control " value="<?php echo $product_title ?>" required>
        </div>
        <div class="form-outline w-50 m-auto mb-4">
            <label for="product_description" class="form-label">Product Description</label>
            <input type="text" name="product_description" id="product_description" value="<?php echo $product_description ?>"  class="form-control " required>
        </div>
        <div class="form-outline w-50 m-auto mb-4">
            <label for="product_keywords" class="form-label">Product Keywords</label>
            <input type="text" name="product_keywords" id="product_keywords" value="<?php echo $product_keywords ?>"  class="form-control " required>
        </div>
        <div class="form-outline w-50 m-auto mb-4">
        <label for="product_categories" class="form-label">Product Categories</label>
<select name="product_category" class="form-select" >
    <option value="<?php echo $category_title ?>" ><?php echo $category_title ?></option>
    <?php

$select_category_all = "Select * from `categories` ";
$result_category_all = mysqli_query($con, $select_category_all);
 
while($row_category_all = mysqli_fetch_assoc($result_category_all)){
    $category_title = $row_category_all['category_title'];
    $category_id = $row_category_all['category_id'];
    echo"<option value ='$category_id'>$category_title</option>";
};

    ?>
    
  
</select>
        </div>
        <div class="form-outline w-50 m-auto mb-4">
        <label for="product_brands" class="form-label">Product Brands</label>
<select name="product_brands" class="form-select">
    <option value="<?php echo $brand_title ?>" ><?php echo $brand_title ?></option>
    <?php

$select_brand_all = "Select * from `brands` ";
$result_brand_all = mysqli_query($con, $select_brand_all);
 
while($row_brand_all = mysqli_fetch_assoc($result_brand_all)){
    $brand_title = $row_brand_all['brand_title'];
    $brand_id = $row_category_all['brand_id'];
    echo"<option value ='$brand_id'>$brand_title</option>";
};


    ?>
</select>
        </div>
        <div class="form-outline w-50 m-auto mb-4">
            <label for="product_image1" class="form-label">Product Image1</label>
            <div class="d-flex">
            <input type="file" name="product_image1" id="product_image1" class="form-control w-90 margin-auto" required>
            <img src="./product_images/<?php echo $product_image1 ?>"  class="product_img" alt="">
            </div>
        
        </div>
        <div class="form-outline w-50 m-auto mb-4">
            <label for="product_image2" class="form-label">Product Image2</label>
            <div class="d-flex">
            <input type="file" name="product_image2" id="product_image2" class="form-control w-90 margin-auto" required>
            <img src="./product_images/<?php echo $product_image2 ?>" class="product_img" alt="">
            </div>
        
        </div>
        <div class="form-outline w-50 m-auto mb-4">
            <label for="product_image3" class="form-label">Product Image3</label>
            <div class="d-flex">
            <input type="file" name="product_image3" id="product_image3" class="form-control w-90 margin-auto" required>
            <img src="./product_images/<?php echo $product_image3 ?>" class="product_img" alt="">
            </div>   
        </div>

        <div class="form-outline w-50 m-auto mb-4">
            <label for="product_price" class="form-label">Product Price</label>
            <input type="text" name="product_price" id="product_price" class="form-control " value="<?php echo $product_price ?>"  required>
        </div>
        <div class="w-50 m-auto">
            <input type="submit" value="Update product" class="btn btn-info px-3 mb-3" name="edit_product">
        </div>
    </form>
</div>


<!--Editting Products-->
<?php
if(isset($_POST['edit_product'])){
    $product_title = $_POST['product_title'];
    $product_description = $_POST['product_description'];
    $product_keywords = $_POST['product_keywords'];
    $product_category = $_POST['product_category'];
    $product_brand = $_POST['product_brands'];
    $product_image1 = $_FILES['product_image1']['name'];
    $product_image2 = $_FILES['product_image2']['name'];
    $product_image3 = $_FILES['product_image3']['name'];
    $product_price = $_POST['product_price'];

    $product_image1_tmp = $_FILES['product_image1']['tmp_name'];
    $product_image2_tmp = $_FILES['product_image2']['tmp_name'];
    $product_image3_tmp = $_FILES['product_image3']['tmp_name'];

    //checking for fields  empty or not
    if($product_title =='' or $product_description ==''){
        echo"<script>alert('Mumu fill all fields now')";
    }else{
      move_uploaded_file($product_image1_tmp,"./product_images/$product_image1");
      move_uploaded_file($product_image2_tmp,"./product_images/$product_image2");
      move_uploaded_file($product_image3_tmp,"./product_images/$product_image3");

      //query to update product
      $update_product = "update `products` set product_title= '$product_title',product_description='$product_description',product_keywords='$product_keywords',category_id=$product_category,brand_id=$product_brand,product_image1='$product_image1',
      product_image2='$product_image2',product_image3='$product_image3',product_price='$product_price',date=NOW()   where product_id=$edit_id";
      $result_update = mysqli_query($con,$update_product);
      if($result_update){
        echo"<script>alert('Product updated successfully')</script>";
        echo"<script>window.open ('./index.php','_self')</script>";
      }

    }
}
?>