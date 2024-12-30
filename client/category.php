<?php 

        require("connection/connection.php");

        $category_load = $conn -> prepare("SELECT * FROM category");

        $category_load -> execute();

        $category_result = $category_load -> get_result();
        
        $categories = [];

        if($category_result -> num_rows > 0){
           while($category = $category_result -> fetch_assoc()){
            $categories[] = $category;
        }
        }
        else{
            $message = "No category Found";
        }


  
   foreach($categories as $category){
      echo '
                <li> <a href="./client/category_blog.php?id='.$category['category_id'].'">'. $category['category_name'] .' </a></li>
      ';
   }



?>