<?php
    require("./connection/connection.php");
   
    $articles = [];
    $categoryName = "";

    if(isset($_GET['id']) && !empty($_GET['id'])){

    $category_id = $_GET['id'];

    $load_article = $conn -> prepare("SELECT * FROM article WHERE 	category = ?");
    $load_article -> bind_param('i' , $category_id);

    $load_article -> execute();

    $article_result = $load_article -> get_result();

    if($article_result -> num_rows > 0){
  
        while($all_article = $article_result -> fetch_assoc()){
            $articles[] = $all_article;
        }
    

    }
    else{
        $message = "Data Not Found";
    }


    $category_name = $conn -> prepare("SELECT * FROM category WHERE category_id = ?");

    $category_name -> bind_param('i' , $category_id);

    $category_name -> execute();

    $category_name_data = $category_name -> get_result();

    $category = $category_name_data -> fetch_assoc();
    $categoryName = $category['category_name'];


}

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href="./css/latest.css">
    <link rel="stylesheet" href="./css/style.css">
    <link rel="stylesheet" href="./css/footer.css">
</head>

<body>

    <?php  require("./share/header.php");  ?>

    <section class="latest-posts">
        <h2 class="section-title"><?php echo $categoryName ?></h2>
        <div class="post-container">
            <?php  
             
             foreach($articles as $article){
                echo '
                <div class="post-card">
                <img src="http://localhost/personalBlog/admin/'.$article['article_img'].'" alt="Post Image" class="post-image">
                <div class="post-content">
                    <h3 class="post-title">'.$article['title'].'</h3>
                    <p class="post-time">Published: November 20, 2024</p>
                    <p class="post-details">'.$article['metaData'].'</p>
                    <a class="read-more" href="./blog.php?id='.$article['article_id'].'">Read More</a>
                </div>
            </div>
                
                     ';
    }

    ?>
        </div>
    </section>

    <?php  require("./share/footer.php");   ?>

</body>

</html>