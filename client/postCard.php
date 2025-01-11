<?php

       require("connection/connection.php");

           
    $data_count = $conn->prepare("SELECT COUNT(*) as totalRows FROM article");
    $data_count->execute();
    $data_result = $data_count->get_result();
    $row = $data_result->fetch_assoc();
    $number_of_data = $row['totalRows'];

   $page = ceil ($number_of_data / 6);

   $offset = 0;

   $pageNo = "";

   if(isset($_GET['page']) && !empty($_GET['page'])){
    $pageNo = $_GET['page'];
    $offset = ($pageNo-1)*5;
   }

        if(isset($_GET['message'])){
            echo '<script> alert("Invalid request!") </script>';
        }

        $article_load = $conn -> prepare("SELECT * FROM article LIMIT 6 OFFSET $offset");

        $article_load -> execute(); 
         
        $article_result = $article_load -> get_result();

       
?>