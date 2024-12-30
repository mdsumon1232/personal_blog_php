<?php
include("./connection/connection.php");

$all_same_category_data = [];
$all_comments = [];

if (isset($_GET['id'])) {
    $post_id = $_GET['id'];

    // Fetch article and associated comments
    $postData = $conn->prepare("SELECT * FROM article WHERE article_id = ?");
    $postData->bind_param('i', $post_id);
    $postData->execute();
    $article_result = $postData->get_result();
    $article_data = $article_result->fetch_assoc();

    // Fetch comments
    $commentsData = $conn->prepare("SELECT * FROM comment WHERE post_id = ? AND status = 1");
    $commentsData->bind_param('i', $post_id);
    $commentsData->execute();
    $comments_result = $commentsData->get_result();
    
    while($comment_content = $comments_result ->fetch_assoc()){
        $all_comments[] = $comment_content;
    }

    // ------------------------------ left side ---------------

    $category_id = $article_data['category'];
     
    $similar_article = $conn -> prepare("SELECT * FROM article WHERE category = ?");
    $similar_article->bind_param("i", $category_id);
    $similar_article->execute();
    $this_category_article = $similar_article->get_result();
    
    while($same_category = $this_category_article -> fetch_assoc()){
        $all_same_category_data[] = $same_category;
    }

}


$comment_response = "";

// Handle Comment Submission
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['submit_comment'])) {
    $blog_id = $article_data['article_id'];
    $name = htmlspecialchars($_POST['name']);
    $email = htmlspecialchars($_POST['email']);
    $message = htmlspecialchars($_POST['message']);

    if (!empty($name) && !empty($email) && !empty($message)) {
        $comment_upload = $conn->prepare("INSERT INTO comment (reader_name, reader_email, comment, post_id) VALUES (?, ?, ?, ?)");
        $comment_upload->bind_param("sssi", $name, $email, $message, $blog_id);

        if ($comment_upload->execute()) {
            $comment_response = "Comment submitted successfully!";
        } else {
            $comment_response = "Failed to submit comment. Please try again.";
        }
    } else {
        $comment_response = "All fields are required.";
    }
}




?>



<!DOCTYPE html>
<html lang="en">
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>Blog Post with Comments</title>
<link rel="stylesheet" href="./css/blog.css">
<link rel="stylesheet" href="./css/style.css">
<link rel="stylesheet" href="./css/footer.css">
</head>

<body>

    <?php  require('./share/header.php')  ?>

    <main class="blog-container">
        <!-- First Column: Blog Post Content -->
        <div class="blog-content">
            <h1 class="blog-title"><?php echo $article_data['title'] ?> </h1>
            <p class="blog-date">Published: November 20, 2024, 10:30 AM</p>
            <div class="feature-img">
                <img src='<?php echo "http://localhost/personalBlog/admin/{$article_data['article_img']}"; ?>'>
            </div>
            <article class="blog-article">
                <?php echo $article_data['article'] ?>
            </article>

            <!-- Comment Form -->
            <div class="comments">

                <form id="commentForm" action="blog.php?id=<?php echo $post_id; ?>" method="POST">
                    <fieldset>
                        <legend>
                            <h2>Leave a Comment</h2>
                        </legend>
                        <input type="text" name="name" id="name" placeholder="Your Name" required>
                        <input type="email" name="email" id="email" placeholder="Your Email" required>
                        <textarea id="message" name="message" placeholder="Write your comment..." rows="3"
                            required></textarea>
                        <div>
                            <p><?php echo $comment_response; ?></p>
                        </div>
                        <button type="submit" class="comment-btn" name="submit_comment">Post Comment</button>
                    </fieldset>
                </form>
            </div>


            <!-- Display Comments -->
            <div class="display-comments">
                <h2>Comments</h2>
                <div id="commentList">
                    <?php 
                     
                     foreach ($all_comments as $comment){
                        echo "
                        <div>
                        <h4>{$comment['reader_name']}</h4>
                        <p> {$comment['comment']} </p>
                        </div>
                    ";
                     }
                    
                    ?>
                </div>
            </div>
        </div>

        <!-- Second Column: Sidebar -->
        <aside class="sidebar">
            <!-- Social Media Share -->
            <div class="social-share">
                <h3>Share this post</h3>
                <div class="social-icons">
                    <a href="#" class="share-icon">
                        <img src="http://localhost/personalBlog/admin/images/facebook.png" alt="">
                    </a>
                    <a href="#" class="share-icon">
                        <img src="http://localhost/personalBlog/admin/images/x.png" alt="">
                    </a>
                    <a href="#" class="share-icon">
                        <img src="http://localhost/personalBlog/admin/images/instagram1.png" alt="">
                    </a>
                    <a href="#" class="share-icon">
                        <img src="http://localhost/personalBlog/admin/images/what's%20app.png" alt="">
                    </a>
                </div>
            </div>

            <!-- Similar Posts -->
            <div class="similar-posts">
                <h3>Similar Posts</h3>
                <?php 
                     
                     foreach($all_same_category_data as $all_article){
                        echo '
                        <a href="./blog.php?id='.$all_article['article_id'].'">
                          <div class="post-item">
                  <div class="similar_post_img">
                          <img src="http://localhost/personalBlog/admin/'.$all_article['article_img'].'" alt="Post Image" class="post-thumbnail">
                  </div>

                    <div class="post-details">
                        <h4>'.$all_article['title'].'</h4>
                        <p class="post-description">'.$all_article['metaData'].'</p>
                    </div>
                </div>
                </a>
                        ';
                     }

                ?>
            </div>
        </aside>
    </main>
    <!-- ----------footer ------- -->

    <?php require("../client/share/footer.php") ?>

    <script src="scripts.js"></script>
</body>

</html>