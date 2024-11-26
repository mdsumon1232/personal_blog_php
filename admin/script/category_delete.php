<?php
    
    require("../connection//connection.php");

    $category_id = $_GET['id'];
    echo $category_id;

    $delete_category = $conn -> prepare("DELETE FROM category WHERE category_id = $category_id LIMIT 1");

    
    if($delete_category -> execute()){
        header("location: http://localhost/adminPanel/category_manage.php#");
    }
    else{
        echo "try again";
    }


?>