<?php

    require('./connection/connection.php');
    
    $data_count = $conn->prepare("SELECT COUNT(*) as totalRows FROM article");
    $data_count->execute();
    $data_result = $data_count->get_result();
    $row = $data_result->fetch_assoc();
    $number_of_data = $row['totalRows'];

   $page = ceil ($number_of_data / 5);

   $offset = 0;

   if(isset($_GET['page']) && !empty($_GET['page'])){
    $pageNo = $_GET['page'];
    $offset = ($pageNo-1)*5;
   }

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>all blog</title>
    <link rel="stylesheet" href="./css/style.css">
    <link rel="stylesheet" href="./css/footer.css">
    <link rel="stylesheet" href="./css/latest.css">
    <link rel="stylesheet" href="./css/pagination.css">
</head>

<body>

    <?php require('./share/header.php') ?>
    <section class="latest-posts">
        <div class="post-container">
            <?php

        $allBlog = $conn -> prepare("SELECT * FROM article LIMIT 5 OFFSET $offset");

        $allBlog -> execute();

        $blog_result = $allBlog -> get_result();
        if($blog_result -> num_rows > 0){
          
            while($row = $blog_result -> fetch_assoc()){
                echo '
            
                  <div class="post-card">
                <img src="http://localhost/personalBlog/admin/'.$row['article_img'].'" alt="Post Image" class="post-image">
                <div class="post-content">
                    <h3 class="post-title">'.$row['title'].'</h3>
                    <p class="post-time">Published: November 20, 2024</p>
                    <p class="post-details">'.$row['metaData'].'</p>
                    <a class="read-more" href="./blog.php?id='.$row['article_id'].'">Read More</a>
                </div>
            </div>
            ';
            }


        }else{
            echo "No blog found";
        }
 

   ?>

    </section>


    <div class="<?php echo  $number_of_data > 5 ? 'pagination': 'hide'  ?>">

        <?php 

for($pageNumber = 1 ; $pageNumber <= $page ; $pageNumber++){
    if($pageNumber == $_GET['page']){
       echo " <p class='active'>  $pageNumber  </p>";
    }
   else{
    echo  "<a href='?page=$pageNumber'> $pageNumber </a>";
   }
}

?>
    </div>

    <?php require('./share/footer.php'); ?>

</body>

</html>