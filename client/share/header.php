<?php
      

    
    $category_data = $conn->prepare("SELECT * FROM category");

    $category_data -> execute();

    $category_result = $category_data -> get_result();

    $categories = [];

    if($category_result -> num_rows > 0){
      while($all_category = $category_result -> fetch_assoc()){
        $categories[] = $all_category;
      }
    }


    // --------------------search---------------------

  if(isset($_POST['search_submit'])){
    $search_content = $_POST['search'];

    header("location: http://localhost/personalBlog/client/search.php?keyword=$search_content");


  }



?>



<header class="header">
    <div class="container">
        <div class="logo"><a href="http://localhost/personalBlog/"> <img
                    src="http://localhost/personalBlog/admin/images/final-logo.png" alt=""> </a></div>
        <div class="search-bar" id="search-bar">
            <form action="index.php" method="POST">
                <input type="text" placeholder="search" name="search">
                <input type="submit" value="search" name="search_submit">
            </form>
        </div>
        <nav class="nav">
            <ul class="menu">
                <li><a href="http://localhost/personalBlog/">Home</a></li>
                <li><a href="http://localhost/personalBlog/client/about.php">About</a></li>
                <li><a href="#">category</a>
                    <div class=" <?php echo count($categories) > 0 ? 'submenu' : 'hidden'; ?>">
                        <ul>
                            <?php 
                            
                              foreach($categories as $category){
                                echo "<li><a href=''> {$category['category_name']} </a></li>";
                              }
                            
                            ?>
                        </ul>
                    </div>

                </li>
                <li><a href="http://localhost/personalBlog/client/contact.php">Contact</a></li>
            </ul>
        </nav>
        <button class="toggle-button" id="search-toggle">
            <i class="fa-solid fa-magnifying-glass" id="magnifying"></i>
        </button>
        <button class="toggle-button" id="toggle-button">
            <i class="fas fa-bars"></i>
        </button>
    </div>
</header>