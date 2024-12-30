<?php

        require("../connection/connection.php");
   
    if(isset($_GET['id'])){
        $id = $_GET['id'];
        echo $id;


         $delete_comment = $conn -> prepare("DELETE FROM comment WHERE comment_id = ?");

         $delete_comment -> bind_param('i' ,$id);

          if($delete_comment -> execute()){
            header("location: http://localhost/personalBlog/admin/comment.php");

          }
    }
 

?>