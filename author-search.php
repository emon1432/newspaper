<?php include 'header.php'; ?>
<div id="main-content">
    <div class="container">
        <div class="row">
            <div class="col-md-8">
                <!-- post-container -->
                <div class="post-container">

                    <?php
                    include "config.php";
                    if (isset($_GET['author-search'])) {
                        $search_term = mysqli_real_escape_string($conn, $_GET['author-search']);
                        echo "<h2 class='page-heading'>Search : {$search_term}</h2>";
                    } else {
                        $search_term = null;
                        echo "<h2 class='page-heading'>All Authors</h2>";
                    }

                    // if (isset($_GET['author-search'])) {
                    //     $search_term = mysqli_real_escape_string($conn, $_GET['author-search']);
                    // }

                    $limit = 3;
                    if (isset($_GET['page'])) {
                        $page = $_GET['page'];
                    } else {
                        $page = 1;
                    }
                    // session_start();
                    $offset = ($page - 1) * $limit;

                    $sql = "SELECT * FROM user
                            WHERE first_name LIKE '%{$search_term}%' OR last_name LIKE '%{$search_term}%' OR username LIKE '%{$search_term}%'
                            LIMIT {$offset},{$limit}";

                    $result = mysqli_query($conn, $sql) or die("Query Failed!!!");
                    if (mysqli_num_rows($result) > 0) {
                        while ($row = mysqli_fetch_assoc($result)) {

                    ?>
                            <div class="post-content">
                                <div class="row">
                                    <div class="col-md-4">
                                        <a class="post-img" href=""><img style="height: 100%; width: 100%; object-fit:cover;" src="admin/author-images/<?php echo $row['user_img']; ?>" alt="" /></a>
                                    </div>
                                    <div class="col-md-8">
                                        <div class="inner-content clearfix">
                                            <div class="post-information">
                                                <span>
                                                    <h3><?php echo $row['first_name'] . " " . $row['last_name']; ?></h3>
                                                </span>
                                                <br>
                                                <span>
                                                    <p><?php echo $row['user_description']; ?></p>
                                                </span>
                                            </div>
                                            <a class='read-more pull-right' href='author.php?a_id=<?php echo $row['user_id']; ?>'>See all post</a>
                                        </div>
                                    </div>
                                </div>
                            </div>
                    <?php
                        }
                    } else {
                        echo "<h2>NO RECORD FOUND</h2>";
                    }

                    $sql1 = "SELECT * FROM user
                            WHERE first_name LIKE '%{$search_term}%' OR last_name LIKE '%{$search_term}%' OR username LIKE '%{$search_term}%'";
                    $result1 = mysqli_query($conn, $sql1) or die("Query Failed!!!");


                    if (mysqli_num_rows($result1) > 0) {
                        $total_records = mysqli_num_rows($result1);

                        $total_page = ceil($total_records / $limit);
                        echo '<ul class="pagination admin-pagination">';
                        if ($page > 1) {
                            echo '<li><a href="author-search.php?page=' . ($page - 1) . '">Prev</a></li>';
                        }
                        for ($i = 1; $i <= $total_page; $i++) {
                            if ($i == $page) {
                                $active = 'active';
                            } else {
                                $active = '';
                            }
                            echo '<li class="' . $active . '"><a href="author-search.php?page=' . $i . '">' . $i . '</a></li>';
                        }
                        if ($total_page > $page) {
                            echo '<li><a href="author-search.php?page=' . ($page + 1) . '">Next</a></li>';
                        }
                        echo '</ul>';
                    }
                    ?>
                </div>
                <!-- /post-container -->
            </div>
            <?php include 'sidebar.php'; ?>
        </div>
    </div>
</div>
<?php include 'footer.php'; ?>