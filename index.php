<?php
            require("./client/connection/connection.php");

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>personal blog</title>



    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css" rel="stylesheet">
    <link rel="stylesheet" href="./client/css/style.css">
    <link rel="stylesheet" href="./client/css/category.css">
    <link rel="stylesheet" href="./client/css/latest.css">
    <link rel="stylesheet" href="./client/css/footer.css">

    <!-- -------------google fonts----------- -->

    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Raleway:ital,wght@0,100..900;1,100..900&display=swap"
        rel="stylesheet">

</head>

<body>

    <?php require('./client/share/header.php');  ?>




    <section class="main-container">
        <div class="left">
            <?php require("./client/postCard.php"); ?>
        </div>
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

        </div>
    </section>

    <!-- Footer Section -->

    <?php require('./client/share/footer.php') ?>



    <script src="./client/script/script.js"></script>
</body>