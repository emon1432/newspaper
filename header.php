<?php

include 'config.php';
$page = basename($_SERVER['PHP_SELF']);
function sql_query_run($conn, $sql_title)
{
    $result_title = mysqli_query($conn, $sql_title) or die("Title Query Failed!!!");
    return $row_title = mysqli_fetch_assoc($result_title);
}
switch ($page) {
    case "single.php":
        if (isset($_GET['id'])) {
            $sql_title = "SELECT * FROM post WHERE post_id = {$_GET['id']}";
            $page_title = sql_query_run($conn, $sql_title)['title'];
        }
        break;
    case "category.php":
        if (isset($_GET['cat_id'])) {
            $sql_title = "SELECT * FROM category WHERE category_id = {$_GET['cat_id']}";
            $page_title = sql_query_run($conn, $sql_title)['category_name'];
        }
        break;
    case "author.php":
        if (isset($_GET['a_id'])) {
            $sql_title = "SELECT * FROM user WHERE user_id = {$_GET['a_id']}";
            $page_title = sql_query_run($conn, $sql_title)['first_name'] . " " . sql_query_run($conn, $sql_title)['last_name'];
        }
        break;
    case "search.php":
        if (isset($_GET['search'])) {
            $sql_title = "SELECT * FROM user WHERE user_id = {$_GET['a_id']}";
            $page_title = $_GET['search'];
        }
        break;
    default:
        $page_title = "Programmer World";
        break;
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <!-- The above 3 meta tags *must* come first in the head; any other head content must come *after* these tags -->
    <title><?php echo $page_title; ?></title>
    <!-- Bootstrap -->
    <link rel="stylesheet" href="css/bootstrap.min.css" />
    <!-- Font Awesome Icon -->
    <link rel="stylesheet" href="css/font-awesome.css">
    <!-- Custom stlylesheet -->
    <link rel="stylesheet" href="css/style.css">
</head>

<body>
    <!-- HEADER -->
    <div id="header">
        <!-- container -->
        <div class="container">
            <!-- row -->
            <div class="row">
                <!-- LOGO -->
                <div class=" col-md-offset-4 col-md-4">
                    <?php
                    include 'config.php';

                    $sql = "SELECT * FROM settings";
                    $result = mysqli_query($conn, $sql) or die("Query Failed!!!");
                    if (mysqli_num_rows($result) > 0) {
                        while ($row = mysqli_fetch_assoc($result)) {
                            // if ($row['logo'] == "") {
                                if(true){
                                echo '<a style="color:white;" href="index.php"><h1>' . $row['websitename'] . '</h1></a>';
                            } else {
                                echo '<a href="index.php" id="logo"><img src="admin/images/' . $row['logo'] . '"></a>';
                            }
                        }
                    }

                    ?>
                </div>
                <!-- /LOGO -->
            </div>
        </div>
    </div>
    <!-- /HEADER -->
    <!-- Menu Bar -->
    <div id="menu-bar">
        <div class="container">
            <div class="row">
                <div class="col-md-12">
                    <?php
                    include "config.php";
                    if (isset($_GET['cat_id'])) {
                        $cat_id = $_GET['cat_id'];
                    }
                    $sql = "SELECT * FROM category WHERE post > 0";
                    $result = mysqli_query($conn, $sql) or die("Query Failed!!!");
                    if (mysqli_num_rows($result) > 0) {
                        $active = '';
                    ?>
                        <ul class='menu'>
                            <li><a href='<?php echo $hostname; ?>'>Home</a></li>
                            <?php while ($row = mysqli_fetch_assoc($result)) {
                                if (isset($_GET['cat_id'])) {
                                    if ($row['category_id'] == $cat_id) {
                                        $active = 'active';
                                    } else {
                                        $active = '';
                                    }
                                }
                                echo "<li><a class='{$active}' href='category.php?cat_id={$row['category_id']}'>{$row['category_name']}</a></li>";
                            } ?>
                        </ul>
                    <?php } ?>
                </div>
            </div>
        </div>
    </div>
    <!-- /Menu Bar -->