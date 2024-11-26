<?php
include("./connection/connection.php");

if (isset($_GET['id'])) {
    $post_id = $_GET['id'];

    // Fetch article and associated comments
    $postData = $conn->prepare("SELECT * FROM article WHERE article_id = ?");
    $postData->bind_param('i', $post_id);
    $postData->execute();
    $article_result = $postData->get_result();
    $article_data = $article_result->fetch_assoc();

    // Fetch comments
    $commentsData = $conn->prepare("SELECT * FROM comment WHERE post_id = ?");
    $commentsData->bind_param('i', $post_id);
    $commentsData->execute();
    $comments_result = $commentsData->get_result();
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
            <img src='<?php echo "http://localhost/personalBlog/admin/{$article_data['article_img']}"; ?>'>
            <article class="blog-article">
                <?php echo $article_data['article'] ?>
            </article>

            <!-- Comment Form -->
            <div class="comments">
                <h2>Leave a Comment</h2>
                <form id="commentForm" action="blog.php?id=<?php echo $post_id; ?>" method="POST">
                    <input type="text" name="name" id="name" placeholder="Your Name" required>
                    <input type="email" name="email" id="email" placeholder="Your Email" required>
                    <textarea id="message" name="message" placeholder="Write your comment..." rows="3"
                        required></textarea>
                    <div>
                        <p><?php echo $comment_response; ?></p>
                    </div>
                    <button type="submit" class="comment-btn" name="submit_comment">Post Comment</button>
                </form>
            </div>


            <!-- Display Comments -->
            <div class="display-comments">
                <h2>Comments</h2>
                <div id="commentList">
                    <?php 
                     
                     
                    
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
                    <a href="#" class="social-icon">Facebook</a>
                    <a href="#" class="social-icon">Twitter</a>
                    <a href="#" class="social-icon">LinkedIn</a>
                    <a href="#" class="social-icon">WhatsApp</a>
                </div>
            </div>

            <!-- Similar Posts -->
            <div class="similar-posts">
                <h3>Similar Posts</h3>
                <div class="post-item">
                    <img src="https://via.placeholder.com/100x100" alt="Post Image" class="post-thumbnail">
                    <div class="post-details">
                        <h4>Exploring CSS Grid Layout</h4>
                        <p class="post-date">Published: Nov 18, 2024</p>
                        <p class="post-description">Learn how to create powerful layouts using CSS grid in this
                            tutorial...</p>
                    </div>
                </div>
            </div>
        </aside>
    </main>
    <!-- ----------footer ------- -->

    <?php require("../client/share/footer.php") ?>

    <script src="scripts.js"></script>
</body>

</html>