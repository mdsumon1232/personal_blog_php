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
    } 


    #-------------------- INSERT ARTICLE DATA---------------------
    $tag_message = "";
    
     if(isset($_POST['post'])){

       $title = $_POST['postTitle'];
       $category = $_POST['postCategory'];
       $article = $_POST['postContent'];
       $metaData = $_POST['metaData'];
    
        
       $feature_img_name = $_FILES['featuredImage']['name'];
       $feature_img_tmp_name = $_FILES['featuredImage']['tmp_name'];

       $feature_img_folder = 'images/'.$feature_img_name;
       echo mb_strlen($metaData);

            if(mb_strlen($metaData) <= 100){
             
                   if(move_uploaded_file($feature_img_tmp_name , $feature_img_folder )){
                     $insert_article = $conn -> prepare("INSERT INTO article (title,article,category,article_img,metaData) values(?,?,?,?,?)");
                     $insert_article -> bind_param('ssiss' , $title,$article,$category,$feature_img_folder,$metaData);
           
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
            else{
                echo "meta data maximum 100 character";
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


                <!-- Featured Image Upload -->
                <label for="featuredImage">Featured Image</label>
                <input type="file" id="featuredImage" name="featuredImage" accept="image/*" require />

                <!-- Content Editor -->
                <label for="postContent">Content</label>
                <textarea id="postContent" name="postContent"></textarea>

                <!-- --------meta data------ -->

                <label for="metaData">Meta Data</label>
                <textarea name="metaData" id="metaData" rows="10" oninput="metadataChange(this.value)"></textarea>

                <!-- display meta count -->
                <div>
                    <p id="metaCount"></p>
                </div>

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
        toolbar: "undo redo |blocks fontfamily fontsize | bold italic underline | alignleft aligncenter alignright alignjustify | bullist numlist outdent indent | link image | code",
        menubar: false,
    });


    const metaData = document.getElementById('metaData');

    const metadataChange = (value) => {

        const metaCount = document.getElementById('metaCount');
        const numberOfMetaCharacter = value.length;
        metaCount.innerText = numberOfMetaCharacter;
        if (numberOfMetaCharacter > 100) {
            metaCount.classList.add('red');
        } else {
            metaCount.classList.add('green');
        }
    }
    </script>

</body>

</html>