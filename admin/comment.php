<?php

    require("./connection/connection.php");

    $comment_data = $conn->prepare("SELECT comment.*, article.title 
    FROM comment 
    INNER JOIN article 
    ON comment.post_id = article.article_id WHERE comment.status = 0");    $comment_data -> execute();

    $comment_result = $comment_data -> get_result();
    
    $comments = [];

    while( $all_comments = $comment_result -> fetch_assoc()){
       $comments[] = $all_comments;
    }
 
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>comments</title>
    <link rel="stylesheet" href="./css/style.css">
    <link rel="stylesheet" href="./css/comment_menage.css">
</head>

<body>
    <div class="dashboard">
        <?php require("./common/leftbar.php") ?>

        <div class="comment-container">
            <h2>Comment Manage</h2>
            <table>
                <thead>
                    <tr>
                        <th>Id</th>
                        <th>Name</th>
                        <th>Email</th>
                        <th>Comment</th>
                        <th>Post</th>
                        <th colspan="2">Action</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                        
                         foreach($comments as $comment){

                            echo "
                            <tr>
                                <td>{$comment['comment_id']}</td>
                                <td>{$comment['reader_name']}</td>
                                <td>{$comment['reader_email']}</td>
                                <td> {$comment['comment']} </td>
                                 <td> {$comment['title']} </td>
                                <td><a href='./script/comment_delete.php?id={$comment['comment_id']}'>Delete</a></td>
                                <td><a href='./script/comment_approve.php?id={$comment['comment_id']}'>Approve</a></td>
                            </tr>
                        ";

                         }
                    
                    
                    ?>
                </tbody>
            </table>
        </div>

    </div>




    <script src="./script/sidetoggle.js"></script>
</body>

</html>