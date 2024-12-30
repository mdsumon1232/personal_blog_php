<?php
    
    require("../connection/connection.php");

    if(isset($_GET['id']) && !empty($_GET['id'])){

         $id = $_GET['id'];
        $update_status = $conn -> prepare("UPDATE comment SET status = 1 WHERE comment_id = ? LIMIT 1");

        $update_status -> bind_param('i' , $id );
        if($update_status -> execute()){
            header("location: http://localhost/personalBlog/admin/comment.php");
        }
    }



?>