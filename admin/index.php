<?php
    require("./connection/connection.php");

    $postData = $conn -> prepare("SELECT * FROM article");
    $postData -> execute();
    $allPost = $postData -> get_result();
    
    $allDataArray  = $allPost -> fetch_assoc();
    $number_of_post = count($allDataArray);

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href="css/style.css">
</head>

<body>
    <div class="dashboard">
        <?php
            require('./common/leftbar.php');

       ?>
        <main class="content">
            <header>
                <h1>Dashboard</h1>
            </header>
            <section class="dashboard-overview">
                <div class="stats">Total Posts: <?php echo $number_of_post ?></div>
                <div class="stats">Views: 2.5K</div>
                <div class="stats">Comments: 300</div>
                <div class="stats">Followers: 1.2K</div>
            </section>
            <section class="main-section">
                <h2>Recent Posts</h2>
                <!-- Additional content goes here -->
            </section>
        </main>
    </div>

    <script src="script/sidetoggle.js"></script>
</body>

</html>