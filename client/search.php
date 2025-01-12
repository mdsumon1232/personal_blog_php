<?php

 require("./connection/connection.php");

 $searches_data = [];

    if(isset($_GET['keyword'])){
        $keyword = $_GET['keyword'];

        $query = $conn ->prepare("SELECT* FROM article WHERE title LIKE ?") ;
    

    // Bind the parameter (add % for partial matching)
    $searchPattern = '%' . $keyword  . '%';
    $query->bind_param("s", $searchPattern );

    // Execute the query
    $query->execute();

    // Get the result
    $result = $query->get_result();

    // Check if any articles are found
    if ($result->num_rows > 0) {
        while ($row = $result->fetch_assoc()) {
           
            $searches_data[] = $row;
          
        }
       
    } 

    // Close the statement
 
    }

    elseif($_GET['keyword']== ''){
        header("location: http://localhost/personalBlog/");
    }
   
    else{
        header("location: http://localhost/personalBlog/");
    }

?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href="./css/latest.css">
    <link rel="stylesheet" href="./css/search.css">
</head>

<body>

    <div class="searchBlogContainer">
        <?php
 


   foreach($searches_data as $searchData){

    $publish_date = new DateTime($searchData['create_at']);
    $formated_date = $publish_date -> format('d F Y');
        
            echo '
            
                  <div class="post-card">
                <img src="http://localhost/personalBlog/admin/'.$searchData['article_img'].'" alt="Post Image" class="post-image">
                <div class="post-content">
                    <h3 class="post-title">'.$searchData['title'].'</h3>
                    <p class="post-time">Published: ' . $formated_date .'</p>
                    <p class="post-details">'.$searchData['metaData'].'</p>
                    <a class="read-more" href="./blog.php?id='.$searchData['article_id'].'">Read More</a>
                </div>
            </div>
            ';
    
    


   }
 
 
 ?>
    </div>

</body>

</html>