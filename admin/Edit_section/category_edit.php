<?php
        require("../connection/connection.php");

       if(isset($_GET['id']) && !empty($_GET['id'])){
        $category_id = $_GET['id'];

        $previous_data = $conn -> prepare("SELECT * FROM category WHERE category_id = $category_id LIMIT 1");
        $previous_data -> execute();

        $previous_category = $previous_data -> get_result();
         $category_name = $category_details = $category_img = "";
        if($previous_category -> num_rows > 0){
            $previous_category_data = $previous_category -> fetch_assoc();
            $category_name = $previous_category_data['category_name'];
            $category_details = $previous_category_data['category_details'];
            $category_img = $previous_category_data['category_img'];
        }

       }


        // -----------form data receive------------

        if(isset($_POST['category_update'])){
            $category_id = $_POST['id'];
            $update_name = $_POST['category-name'];
            $update_details = $_POST['category-details'];
            $update_img_name = $_FILES['category-image'];
            $update_tmp_name = $_FILES['tmp_name'];
            if(isset($update_img_name) && !empty($update_img_name)){
                $image_file = '../images/'.$update_img_name;
                move_uploaded_file($update_tmp_name , $image_file);
                $update_category = $conn -> prepare("UPDATE category SET category_name = ? , category_details = ? , category_img = ? WHERE category_id  = ? LIMIT 1");
                $update_category -> bind_param('sssi' , $update_name , $update_details , $image_file , $category_id );
                if($update_category -> execute()){
                    header("location: http://localhost/adminPanel/category_manage.php#");

                }
                else{
                    echo "try again!";
                }

            
            }
            else{
                $update_category = $conn -> prepare("UPDATE category SET category_name = ? , category_details =? WHERE category_id = ? LIMIT 1");
                $update_category -> bind_param("ssi" , $category_name , $category_details , $category_id);
                if($update_category -> execute()){
                    
                    header("location: http://localhost/adminPanel/category_manage.php#");
                    
                }
                else{
                    echo "try again!";
                }
            }
        }


?>


<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>category edit</title>
    <link rel="stylesheet" href="../css/category.css">
</head>

<body>
    <div class="form-container">
        <a href="">back</a>
        <h1>Update Category</h1>
        <form class="category-form" action="category_edit.php" method="post" enctype="multipart/form-data">
            <label for="category-name">Category Name:</label>
            <input type="text" id="category-name" name="category-name" placeholder="Enter category name"
                value="<?php echo $category_name ?>" required>

            <label for="category-details">Category Details:</label>
            <textarea id="category-details" name="category-details" placeholder="Enter category details"
                required> <?php echo $category_details ?></textarea>

            <label for="category-image">Category Image:</label>
            <input type="file" id="category-image" name="category-image" accept="image/*">
            <input type="text" value="<?php echo $category_id ?>" name="id" hidden>

            <button type="submit" name="category_update">Update Category</button>
        </form>
    </div>
</body>

</html>