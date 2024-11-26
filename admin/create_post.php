<?php
    require ("./connection/connection.php");
    
    #------------- CATEGORY DATA INSERT------------------

    $category_data = $conn->prepare("SELECT * FROM category");
    $category_data->execute();
    $result = $category_data->get_result();

    $categories = [];

    if ($result->num_rows > 0) {
        while ($category = $result->fetch_assoc()) {
            $categories[] = $category;
        }
    } else {
        echo "Data not found";
    }


    #-------------------- INSERT ARTICLE DATA---------------------

     if(isset($_POST['post'])){

       $title = $_POST['postTitle'];
       $category = $_POST['postCategory'];
       $article = $_POST['postContent'];
       $metaData = $_POST['metaData'];
        
       $feature_img_name = $_FILES['featuredImage']['name'];
       $feature_img_tmp_name = $_FILES['featuredImage']['tmp_name'];

       $feature_img_folder = 'images/'.$feature_img_name;

            if(strlen($metaData) > 100){
                echo "meta data maximum 100 character";
            }
            else{
                if(strlen($article) > 10000){
                    echo "article length must be less then 1000 character";
                  }
                  else{
                   if(move_uploaded_file($feature_img_tmp_name , $feature_img_folder )){
                     $insert_article = $conn -> prepare("INSERT INTO article (title,article,category,article_img,metaData) values(?,?,?,?,?)");
                     $insert_article -> bind_param('ssiss' , $title,$article,$category,$feature_img_folder,$metaData);
                     $insert_article -> execute();
           
                     if($insert_article -> execute()){
                        echo "data insert successfully";
                     }
                     else{
                       echo "something wrong ! try again";
                     }
           
                   }
                   else{
                     echo "image not uploaded";
                   }
                  }
            }

      }
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href="css/create_post.css">
    <link rel="stylesheet" href="css/style.css">
    <script src="https://cdn.tiny.cloud/1/wq5s9vqm1cz8nu530v7bubvkg2x5u7ekawzlcud9isgdxma6/tinymce/7/tinymce.min.js"
        referrerpolicy="origin"></script>
</head>

<body>
    <div class="dashboard">
        <?php
        require('./common/leftbar.php');
   ?>
        <div class="create-post-page">
            <h1>Create a New Post</h1>

            <form class="create-post-form" id="postForm" action="create_post.php" method="POST"
                enctype="multipart/form-data">
                <!-- Post Title -->
                <label for="postTitle">Title</label>
                <input type="text" id="postTitle" name="postTitle" placeholder="Enter post title" required />

                <!-- Category Selector -->
                <label for="postCategory">Category</label>
                <select id="postCategory" name="postCategory" required>
                    <option>Select a Category</option>

                    <?php
              foreach ($categories as $key => $value) {
                  echo "<option value='{$value['category_id']}'>{$value['category_name']}</option>";
              }
          ?>

                </select>

                <!-- Tags Input -->
                <label for="postTags">Tags</label>
                <input type="text" id="postTags" name="postTags"
                    placeholder="e.g., JavaScript, Coding, Web Development" />

                <!-- Featured Image Upload -->
                <label for="featuredImage">Featured Image</label>
                <input type="file" id="featuredImage" name="featuredImage" accept="image/*" require />

                <!-- Content Editor -->
                <label for="postContent">Content</label>
                <textarea id="postContent" name="postContent"></textarea>

                <!-- --------meta data------ -->

                <label for="metaData">Meta Data</label>
                <textarea name="metaData" id="metaData" rows="10"></textarea>

                <!-- Publish Settings -->
                <div class="publish-settings">
                    <label>
                        <input type="checkbox" name="publishNow" checked />
                        Publish Now
                    </label>
                </div>

                <!-- Submit Button -->
                <button type="submit" name="post">Publish Post</button>
            </form>
        </div>
    </div>

    <script>
    tinymce.init({
        selector: "#postContent",
        height: 300,
        plugins: "link image code lists",
        toolbar: "undo redo | bold italic underline | alignleft aligncenter alignright alignjustify | bullist numlist outdent indent | link image | code",
        menubar: false,
    });
    </script>

</body>

</html>