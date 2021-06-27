<?php
include 'config.php'; 
if(empty($_FILES['new-image']['name'])){
    $file_name = $_POST['old_image'];
}else{
    unlink("upload/".$_POST['old_image']);
    $errors = array();
    $file_name = $_FILES['new-image']['name'];
    $file_size = $_FILES['new-image']['size'];
    $file_tmp = $_FILES['new-image']['tmp_name'];
    $file_type = $_FILES['new-image']['type'];
    $exp = explode('.',$file_name);
    $end = end($exp);
    $file_ext = strtolower($end);
    $extensions = array("jpeg","jpg","png");

    if(in_array($file_ext,$extensions) === false){
        $errors[] = "This extension file not allowed, Please choose a JPG or PNG file.";
    }
    if($file_size > 2097152){
        $errors[] = "File size must be 2mb or lower.";
    }
    $target = "upload/". time(). "-".$file_name;
    if(empty($errors)==true){
        move_uploaded_file($file_tmp,"upload/".$file_name);
    }
    else{
        print_r($errors);
        die();
    }
}
 $past_category = $_POST['past_cat_id'];
 $present_category = $_POST['category'];
if($past_category==$present_category){
    $sql = "UPDATE post SET title='{$_POST['post_title']}', description='{$_POST['postdesc']}',category={$_POST['category']},post_img='{$file_name}' 
    WHERE post_id={$_POST['post_id']}";
}else{
    $sql = "UPDATE post SET title='{$_POST['post_title']}', description='{$_POST['postdesc']}',category={$_POST['category']},post_img='{$file_name}' 
    WHERE post_id={$_POST['post_id']};";
    $sql .= "UPDATE category SET post = post + 1 WHERE category_id = {$present_category};";
    $sql .= "UPDATE category SET post = post - 1 WHERE category_id = {$past_category}";
}
$result =mysqli_multi_query($conn,$sql) or die("Query Failed!!!");
if($result){
    header("Location: {$hostname}/admin/post.php");
}
?>