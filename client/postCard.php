<?php

        require("connection/connection.php");

        if(isset($_GET['message'])){
            echo '<script> alert("Invalid request!") </script>';
        }

        $article_load = $conn -> prepare("SELECT * FROM article");

        $article_load -> execute(); 
         
        $article_result = $article_load -> get_result();

       
?>