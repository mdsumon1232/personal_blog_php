<?php
   
    require('./connection/connection.php');
    
    $message = "";

    if(isset($_POST['category_submit'])){
        $category_name = $_POST['category-name'];
        $category_details = $_POST['category-details'];

        $category_img_name = $_FILES['category-image']['name'];
        $category_img_tmp_name = $_FILES['category-image']['tmp_name'];

        $img_folder = "./images/" . $category_img_name;

        if(move_uploaded_file($category_img_tmp_name , $img_folder)){

          $category_data_insert = $conn -> prepare("INSERT INTO category (category_name,category_details,category_img)values(?,?,?)");
          $category_data_insert -> bind_param('sss' , $category_name , $category_details , $img_folder);
          if($category_data_insert -> execute()){
            $message = "Category added";
          }
          else{
            $message = "Try again";
          }

        }
        else{
            echo "image can not upload";
        }
      
    }


?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href="css/style.css">
    <link rel="stylesheet" href="css/category.css">
</head>
<body>
<div class="dashboard">
    <?php
        require('common/leftbar.php');
    ?>
  <div class="form-container">
        <h1>Add New Category</h1>
        <form class="category-form" action="category.php" method="post" enctype="multipart/form-data">
            <label for="category-name">Category Name:</label>
            <input type="text" id="category-name" name="category-name" placeholder="Enter category name" required>
            
            <label for="category-details">Category Details:</label>
            <textarea id="category-details" name="category-details" placeholder="Enter category details" required></textarea>
            
            <label for="category-image">Category Image:</label>
            <input type="file" id="category-image" name="category-image" accept="image/*" required>
             
            <div class="message-container">
                 <p><?php echo $message;  ?></p>
            </div>

            <button type="submit" name="category_submit">Add Category</button>
        </form>
    </div>
</div>
</body>
</html>