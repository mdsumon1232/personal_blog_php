<?php
require("../connection/connection.php");

// Fetch categories
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

// Load previous data
$post_id = '';
if (isset($_GET['id']) && !empty($_GET['id'])) {
    $post_id = $_GET['id'];
}

$post_data = $conn->prepare("SELECT * FROM article WHERE article_id = ? LIMIT 1");
$post_data->bind_param('i', $post_id);
$post_data->execute();
$result = $post_data->get_result();

$title = $article = $category = $img = "";
if ($result->num_rows > 0) {
    $post_array = $result->fetch_assoc();
    $title = $post_array['title'];
    $article = $post_array['article'];
    $category = $post_array['category'];
    $img = $post_array['article_img'];
} else {
    echo "Wrong ID! Try again.";
}

// Update post data
if (isset($_POST['submit'])) {
    $update_title = $_POST['postTitle'];
    $update_article = $_POST['postContent'];
    $post_id = $_POST['id'];
    $update_category = $_POST['postCategory'];
    $update_img = $_FILES['featuredImage'];

    if (!empty($update_img['name'])) {
        // Handle image upload
        $update_img_name = basename($update_img['name']);
        $update_img_tmp = $update_img['tmp_name'];
        $image_folder = '../images/' . $update_img_name;

        if (move_uploaded_file($update_img_tmp, $image_folder)) {
            // Update with new image
            $update_article_stmt = $conn->prepare(
                "UPDATE article SET title = ?, article = ?, category = ?, article_img = ? WHERE article_id = ? LIMIT 1"
            );
            $update_article_stmt->bind_param(
                "ssisi",
                $update_title,
                $update_article,
                $update_category,
                $image_folder,
                $post_id
            );

            if ($update_article_stmt->execute()) {
                header("Location: http://localhost/adminPanel/post_manage.php");
                exit;
            } else {
                echo "Database update failed! Try again.";
            }
        } else {
            echo "Image upload failed! Try again.";
        }
    } else {
        // Update without new image
        $update_article_stmt = $conn->prepare(
            "UPDATE article SET title = ?, article = ?, category = ? WHERE article_id = ? LIMIT 1"
        );
        $update_article_stmt->bind_param("ssii", $update_title, $update_article, $update_category, $post_id);

        if ($update_article_stmt->execute()) {
            header("Location: http://localhost/adminPanel/post_manage.php");
            exit;
        } else {
            echo "Database update failed! Try again.";
        }
    }
}
?>


<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Update Post</title>
    <link rel="stylesheet" href="../css/create_post.css">
    <link rel="stylesheet" href="../css/style.css">
    <script src="https://cdn.tiny.cloud/1/wq5s9vqm1cz8nu530v7bubvkg2x5u7ekawzlcud9isgdxma6/tinymce/7/tinymce.min.js"
        referrerpolicy="origin"></script>
</head>

<body>
    <div class="create-post-page">
        <h1>Update Post</h1>

        <form class="create-post-form" id="postForm" method="POST" enctype="multipart/form-data">
            <!-- Post Title -->
            <label for="postTitle">Title</label>
            <input type="text" id="postTitle" name="postTitle" placeholder="Enter post title"
                value="<?php echo htmlspecialchars($title); ?>" required />

            <!-- Category Selector -->
            <label for="postCategory">Category</label>
            <select id="postCategory" name="postCategory" required>
                <option>Select a Category</option>
                <?php foreach ($categories as $value): ?>
                <option value="<?php echo $value['category_id']; ?>"
                    <?php echo ($value['category_id'] == $category) ? 'selected' : ''; ?>>
                    <?php echo htmlspecialchars($value['category_name']); ?>
                </option>
                <?php endforeach; ?>
            </select>

            <!-- Tags Input -->
            <label for="postTags">Tags</label>
            <input type="text" id="postTags" name="postTags" placeholder="e.g., JavaScript, Coding, Web Development" />

            <!-- Featured Image Upload -->
            <label for="featuredImage">Featured Image</label>
            <input type="file" id="featuredImage" name="featuredImage" accept="image/*" />
            <div>
                <img src="<?php echo htmlspecialchars($img); ?>" alt="Featured Image">
            </div>

            <!-- Content Editor -->
            <label for="postContent">Content</label>
            <textarea id="postContent" name="postContent"><?php echo htmlspecialchars($article); ?></textarea>
            <input type="hidden" value="<?php echo $post_id; ?>" name="id">

            <!-- Submit Button -->
            <button type="submit" name="submit">Update Post</button>
        </form>
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