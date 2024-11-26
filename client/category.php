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
            <div class="category-card">
                <img src="http://localhost/personalBlog/admin/' . $category['category_img'] . '" alt="Category 1">
                <h3>'. $category['category_name'] .'</h3>
                <p>'. $category['category_details'] .'</p>
            </div>
      
      ';
   }



?>