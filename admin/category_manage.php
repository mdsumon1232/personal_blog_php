<?php
    
    require("./connection/connection.php");
    
    $categories = [];

    $category_data = $conn -> prepare("SELECT * FROM category");
    $category_data -> execute();
    
    $all_data = $category_data -> get_result();

    $message = "";

    if($all_data -> num_rows > 0){
      while($row = $all_data -> fetch_assoc()){
        $categories[] = $row;
      }
    }
    else{
        $message = "No category available";
    }

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>category manage</title>
    <link rel="stylesheet" href="css/post_manage.css">
    <link rel="stylesheet" href="css/style.css">
</head>

<body>
    <div class="dashboard">
        <?php

            require("./common/leftbar.php");

        ?>

        <section class="post_container">
            <h2>All Category</h2>

            <?php

                foreach($categories as $category){
                    echo "
                    
                       <div class='post'>
            <img src='{$category['category_img']}' alt=''>
            <p>{$category['category_name']}</p>
            <div class='action'>
                <a href='./script/category_delete.php?id={$category['category_id']}'>
                    <img src='images/bin.png' alt=''>
                </a>
                <a href='./Edit_section/category_edit.php?id={$category['category_id']}'>
                    <img src='images/edit.png' alt=''>
                </a>
            </div>
        </div>
                    
                    ";
                }
 
                echo "<p> $message </p> ";

 ?>
        </section>
    </div>
</body>

</html>