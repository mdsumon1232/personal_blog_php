<?php
            require("./client/connection/connection.php");
            require("./client/postCard.php"); 

            $popular_post = $conn -> prepare("SELECT * FROM article");
            $popular_post -> execute();

            $popular_result = $popular_post -> get_result();

            $trending_posts = [];

            while($popular_post_data = $popular_result -> fetch_assoc()){
                $trending_posts[] = $popular_post_data;
            }

?>






<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>personal blog</title>
    <link rel="stylesheet" href="./client/css/footer.css">
    <link rel="stylesheet" href="./client/css/style.css">
    <link rel="stylesheet" href="client/css/latest.css">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css" rel="stylesheet">
</head>

<body>
    <?php require('./client/share/header.php') ?>

    <!-- ---------------------------------- main content start ---------------------------------- -->


    <section class="main-container">

        <?php 
            
            

            if($article_result -> num_rows > 0){
                echo "<div class='left'>";
                while($article = $article_result -> fetch_assoc()){
        
                    $publish_date = new DateTime($article['create_at']);
                    $formated_date = $publish_date -> format('d F Y');
                
                    echo '
                    
                          <div class="post-card">
                        <img src="http://localhost/personalBlog/admin/'.$article['article_img'].'" alt="Post Image" class="post-image">
                        <div class="post-content">
                            <h3 class="post-title">'.$article['title'].'</h3>
                            <p class="post-time">Published: ' . $formated_date .'</p>
                            <p class="post-details">'.$article['metaData'].'</p>
                            <a class="read-more" href="./client/blog.php?id='.$article['article_id'].'">Read More</a>
                        </div>
                    </div>
                    ';
        
        }
        echo "</div>";
        
        
                }
                else {
                    echo "
                        <div class='no-posts'>
                            <h4>POST NOT FOUND</h4>
                        </div>
                    ";
                }
            
            
            ?>

        <div class="right">

            <div class="category-list">
                <h3>বিভাগ</h3>

                <?php require("./client/category.php") ?>
            </div>

            <div class="about-section">
                <div class="author">
                    <img src="./admin/images/profile.jpg" alt="">
                    <div class="author-name">
                        <h4>Md.Sumon</h4>
                        <p>Unknown person</p>
                    </div>
                </div>
                <article class="about-content">
                    Lorem ipsum dolor sit amet consectetur adipisicing elit. Possimus provident at odit vero sed
                    praesentium, repudiandae accusantium dicta magnam rem perspiciatis aliquid harum ipsam temporibus
                    molestias laborum velit,aut unde.Consequuntu, totam
                </article>
                <div class="social-group">
                    <a href=""><img src="./admin/images/facebook.png" alt=""></a>
                    <a href=""><img src="./admin/images/instagram1.png" alt=""></a>
                    <a href=""><img src="./admin/images/what's app.png" alt=""></a>
                    <a href=""><img src="./admin/images/x.png" alt=""></a>
                </div>
            </div>

            <!-- ---------------------popular post-------------------- -->

            <div class="<?php echo $article_result -> num_rows > 0   ? 'popular_container' : 'hidden' ?>">
                <h3>Popular Posts</h3>
                <?php 
                        
                        $all_trending_post =array_slice($trending_posts ,0, 3);

                        foreach($all_trending_post as $trending_post){
                            $metaData = substr($trending_post['metaData'], 1 , 60);
                            echo "
                            
                            <div class='popular-item'> 
                            
                             <img src='http://localhost/personalBlog/admin/$trending_post[article_img]'>
                             

                             <div class='overlay'> 
                            <div>
                                 <p> $metaData </p> 
                             <a href='./client/blog.php?id=$trending_post[article_id]' class='popular-read'> READ </a>
                            </div>
                             </div>

                             

                            </div>
                            
                            ";
                        }

                ?>
            </div>

        </div>
    </section>


    <!-- --------------------------------------main content end---------------------------------- -->

    <?php require('./client/share/footer.php') ?>

    <!--javascript code-->

    <script src="./client/script/script.js"></script>


</body>

</html>