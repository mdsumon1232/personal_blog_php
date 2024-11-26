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
</head>

<body>

    <?php require('./client/share/header.php');  ?>

    <!-- -------------category----------------- -->

    <section class="category-section">
        <h2 class="section-title">Categories</h2>
        <div class="category-container">
            <?php require("./client/category.php");  ?>
        </div>
    </section>

    <!-- ---------------latest post------------------ -->

    <section class="latest-posts">
        <h2 class="section-title">Latest Posts</h2>
        <div class="post-container">
            <?php  require("./client/postCard.php")  ?>
        </div>
    </section>

    <!-- Footer Section -->

    <?php require('./client/share/footer.php') ?>

    <script src="./client/script/script.js"></script>

</body>

</html>