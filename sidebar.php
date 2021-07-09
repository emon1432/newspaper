<div id="sidebar" class="col-md-4">

    <!-- search box -->
    <div class="search-box-container">
        <h4>Search Post</h4>
        <form class="search-post" action="search.php" method="GET">
            <div class="input-group">
                <input type="text" name="search" class="form-control" placeholder="Title or Category" required>
                <span class="input-group-btn">
                    <button type="submit" class="btn btn-danger">Search</button>
                </span>
            </div>
        </form>
    </div>
    <!-- /search box -->

    <!-- recent posts box -->
    <div class="recent-post-container" style="margin-bottom: 30px;">
        <h4>Recent Posts</h4>
        <?php
        include "config.php";

        $limit = 3;


        $sql = "SELECT * FROM post
            LEFT JOIN category ON post.category = category.category_id
            ORDER BY post_date ASC LIMIT {$limit}";

        $result = mysqli_query($conn, $sql) or die("Query Failed!!!");
        if (mysqli_num_rows($result) > 0) {
            while ($row = mysqli_fetch_assoc($result)) {
        ?>
                <div class="recent-post">
                    <a class="post-img" href="single.php?cat_id=<?php echo $row['category']; ?>&id=<?php echo $row['post_id']; ?>"><img src="admin/upload/<?php echo $row['post_img']; ?>" alt="" /></a>
                    <div class="post-content">
                        <h5><a href="single.php?cat_id=<?php echo $row['category']; ?>&id=<?php echo $row['post_id']; ?>"><?php echo $row['title']; ?></a></h5>
                        <span>
                            <i class="fa fa-tags" aria-hidden="true"></i>
                            <a href='category.php?cat_id=<?php echo $row['category']; ?>'><?php echo $row['category_name']; ?></a>
                        </span>
                        <span>
                            <i class="fa fa-calendar" aria-hidden="true"></i>
                            <?php echo $row['post_date']; ?>
                        </span>
                        <a class="read-more" href='single.php?cat_id=<?php echo $row['category']; ?>&id=<?php echo $row['post_id']; ?>'>read more</a>
                    </div>
                </div>
        <?php
            }
        }
        ?>

    </div>
    <!-- /recent posts box -->
    <!-- Authors List  -->
    <div class="search-box-container">
        <h4>Search Authors</h4>
        <form class="search-post" action="author-search.php" method="GET">
            <div class="input-group">
                <input type="text" name="author-search" class="form-control" placeholder="Author Name" required>
                <span class="input-group-btn">
                    <button type="submit" class="btn btn-danger">Search</button>
                </span>
            </div>
        </form>
        <input type="hidden" name="author-search" class="form-control">
        <a href="author-search.php"><button style="display: block;margin-left: auto;margin-right: auto; margin-top:20px; color:#1e90ff" class="btn "><b>See all authors</b></button></a>
    </div>
    <!-- /Authors List  -->
</div>