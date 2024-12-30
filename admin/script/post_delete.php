<?php
    
    require("../connection/connection.php");
   
    $post_id = $_GET['id'];
    
    $delete_post = $conn -> prepare("DELETE FROM article WHERE article_id = $post_id LIMIT 1");
    if($delete_post -> execute()){
        header("Location: http://localhost/personalBlog/admin/post_manage.php");
    }
    else{
        echo "try again";
    }



?>