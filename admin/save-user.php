<?php
include 'config.php';
if (isset($_FILES['fileToUpload'])) {
    $errors = array();
    $file_name = $_FILES['fileToUpload']['name'];
    $file_size = $_FILES['fileToUpload']['size'];
    $file_tmp = $_FILES['fileToUpload']['tmp_name'];
    $file_type = $_FILES['fileToUpload']['type'];
    $exp = explode('.', $file_name);
    $end = end($exp);
    echo $file_ext = strtolower($end);
    $extensions = array("jpeg", "jpg", "png");

    if (in_array($file_ext, $extensions) === false) {
        $errors[] = "This extension file not allowed, Please choose a JPG or PNG file.";
    }
    if ($file_size > 2097152) {
        $errors[] = "File size must be 2mb or lower.";
    }
    echo $img_name = time() . "-" . $file_name;
    $target = "author-images/" . time() . "-" . $file_name;
    if (empty($errors) == true) {
        move_uploaded_file($file_tmp, $target);
    } else {
        print_r($errors);
        die();
    }
} else {
    echo "picture not found!!!";
    die();
}


$fname = mysqli_real_escape_string($conn, $_POST['fname']);
$lname = mysqli_real_escape_string($conn, $_POST['lname']);
$user = mysqli_real_escape_string($conn, $_POST['user']);
$userdesc = mysqli_real_escape_string($conn, $_POST['userdesc']);
$password = mysqli_real_escape_string($conn, md5($_POST['password']));
$role = mysqli_real_escape_string($conn, $_POST['role']);

$sql = "SELECT username FROM user WHERE username = '{$user}'";
$result = mysqli_query($conn, $sql) or die("Query Failed!!!");

if (mysqli_num_rows($result) > 0) {
    echo "<p style='color:red;text-align:center;margin:10px 0;'>Username already availabe!!!</p>";
} else {
    echo $sql1 = "INSERT INTO user (first_name,last_name,username,password,role,user_description,user_img)
VALUES('{$fname}','{$lname}','{$user}','{$password}','{$role}','{$userdesc}','{$img_name}')";
    if (mysqli_query($conn, $sql1)) {
        header("Location: {$hostname}/admin/users.php");
    }
}
