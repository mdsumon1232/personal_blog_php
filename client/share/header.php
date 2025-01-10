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



?>



<header class="header">
    <div class="container">
        <div class="logo">My Blog</div>
        <div class="search-bar" id="search-bar">
            <form action="">
                <input type="text" placeholder="search">
                <input type="submit" value="search">
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