<?php

        require("connection/connection.php");

        if(isset($_GET['message'])){
            echo '<script> alert("Invalid request!") </script>';
        }

        $article_load = $conn -> prepare("SELECT * FROM article");

        $article_load -> execute(); 
         
        $article_result = $article_load -> get_result();

        if($article_result -> num_rows > 0){
        while($article = $article_result -> fetch_assoc()){
        
            echo '
            
                  <div class="post-card">
                <img src="http://localhost/personalBlog/admin/'.$article['article_img'].'" alt="Post Image" class="post-image">
                <div class="post-content">
                    <h3 class="post-title">'.$article['title'].'</h3>
                    <p class="post-time">Published: November 20, 2024</p>
                    <p class="post-details">'.$article['metaData'].'</p>
                    <a class="read-more" href="./client/blog.php?id='.$article['article_id'].'">Read More</a>
                </div>
            </div>
            ';

}


        }
?>