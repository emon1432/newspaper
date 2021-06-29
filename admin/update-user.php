<?php include "header.php";
include 'config.php';
if ($_SESSION["user_role"] == '0') {
    header("Location: {$hostname}/admin/post.php");
}
if (isset($_POST['submit'])) {
    include 'config.php';

    if(empty($_FILES['new-image']['name'])){
        $proper_img = $_POST['old_image'];
    }else{
        unlink("author-images/".$_POST['old_image']);
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
        $img_name = time(). "-".$file_name;
        $target = "author-images/".$img_name;
        $proper_img = $img_name;
        if(empty($errors)==true){
            move_uploaded_file($file_tmp,$target);
        }
        else{
            print_r($errors);
            die();
        }
    }

    $userid = mysqli_real_escape_string($conn, $_POST['user_id']);
    $fname = mysqli_real_escape_string($conn, $_POST['f_name']);
    $lname = mysqli_real_escape_string($conn, $_POST['l_name']);
    $user = mysqli_real_escape_string($conn, $_POST['username']);
    $userdesc = mysqli_real_escape_string($conn, $_POST['userdesc']);
    // $password = mysqli_real_escape_string($conn, md5($_POST['password']));
    $role = mysqli_real_escape_string($conn, $_POST['role']);

    $sql = "UPDATE user SET first_name = '{$fname}', last_name = '{$lname}', username = '{$user}', role = '{$role}',user_description='{$userdesc}',user_img='{$proper_img}' WHERE user_id = {$userid}";
    $result = mysqli_query($conn, $sql) or die("Query Failed!!!");
    if (mysqli_query($conn, $sql)) {
        header("Location: {$hostname}/admin/users.php");
    }
}

?>
<div id="admin-content">
    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <h1 class="admin-heading">Modify User Details</h1>
            </div>
            <div class="col-md-offset-4 col-md-4">

                <?php
                include 'config.php';
                $user_id = $_GET['id'];
                $sql = "SELECT * FROM user WHERE user_id = {$user_id}";
                $result = mysqli_query($conn, $sql) or die("Query Failed!!!");
                if (mysqli_num_rows($result) > 0) {
                    while ($row = mysqli_fetch_assoc($result)) {
                ?>
                        <!-- Form Start -->
                        <form action="<?php $_SERVER['PHP_SELF']; ?>" method="POST" enctype="multipart/form-data">
                            <div class="form-group">
                                <input type="hidden" name="user_id" class="form-control" value="<?php echo $row['user_id']; ?>" placeholder="">
                            </div>
                            <div class="form-group">
                                <label>First Name</label>
                                <input type="text" name="f_name" class="form-control" value="<?php echo $row['first_name']; ?>" placeholder="" required>
                            </div>
                            <div class="form-group">
                                <label>Last Name</label>
                                <input type="text" name="l_name" class="form-control" value="<?php echo $row['last_name']; ?>" placeholder="" required>
                            </div>
                            <div class="form-group">
                                <label>User Name</label>
                                <input type="text" name="username" class="form-control" value="<?php echo $row['username']; ?>" placeholder="" required>
                            </div>
                            <div class="form-group">
                                <label for="exampleInputPassword1">About You</label>
                                <textarea name="userdesc" class="form-control" required rows="5">
                                <?php echo $row['user_description']; ?>
                                </textarea>
                            </div>
                            <div class="form-group">
                                <label>User Role</label>
                                <select class="form-control" name="role" value="">
                                    <?php
                                    if ($row['role'] == 1) {
                                        echo "<option value='0'>Normal User</option>
                                    <option value='1' selected>Admin</option>";
                                    } else {
                                        echo "<option value='0' selected>Normal User</option>
                                    <option value='1'>Admin</option>";
                                    }
                                    ?>
                                </select>
                            </div>
                            <div class="form-group">
                                <label for="">Your image</label>
                                <input type="file" name="new-image">
                                <img src="author-images/<?php echo $row['user_img']; ?>" height="150px">
                                <input type="hidden" name="old_image" value="<?php echo $row['user_img']; ?>">
                            </div>
                            <input type="submit" name="submit" class="btn btn-primary" value="Update" required />
                        </form>
                        <!-- /Form -->
                <?php
                    }
                }
                ?>
            </div>
        </div>
    </div>
</div>
<?php include "footer.php"; ?>