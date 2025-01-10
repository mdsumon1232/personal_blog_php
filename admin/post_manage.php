<?php
     require("connection/connection.php");

     $post_data = $conn->prepare("SELECT category.category_name, article.* FROM category INNER JOIN article ON article.category = category.category_id");

     $post_data -> execute();

     $result = $post_data -> get_result();
     $articles = [];

     $message = "";

     if($result -> num_rows > 0){
         
          while($article_data = $result -> fetch_assoc()){
            $articles[] = $article_data;
          }
     }
     else{
      $message = "NO post available";
     }
 

 
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href="css/post_manage.css">
    <link rel="stylesheet" href="css/style.css">
</head>

<body>
    <div class="dashboard">
        <?php
       require('./common/leftbar.php');
    ?>

        <section class="post_container">

            <h2>Post Manage</h2>

            <?php
       
       foreach($articles as $key => $value){
      echo "

      <div class='post'>
      <img src='{$value['article_img']}' alt=''>
          <p class='title'>{$value['title']}</p>
          <p class='article-container'>{$value['metaData']}</p>
          
          <div class='action'>
              <a href='./script/post_delete.php?id={$value['article_id']}'>
               <img src='./images/bin.png'>
              </a>
              <a href='./Edit_section/post_edit.php?id={$value['article_id']}'>
                <img src='./images/edit.png'>
              </a>
          </div>
      </div>
  ";
       }

       echo" <p> $message </p>";

?>



        </section>

    </div>

</body>

</html>