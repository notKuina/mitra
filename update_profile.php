<?php
include 'configuration.php';
session_start();
$user_id= $_SESSION['user_id'];

if(isset($_POST['update_profile'])){
    $update_name= mysqli_real_escape_string($conn, $_POST['update_name']);
    $update_bio= mysqli_real_escape_string($conn, $_POST['update_bio']);
    mysqli_query($conn, "UPDATE 'user_form' SET name='$update_name', email='$update_email' WHERE id='user_id'")
    or die('query failed');

        $confirm_pass= mysqli_real_escape_string($conn, md5($_POST['confirm_pass']));
        if(!empty($confirm_pass)){
            if($confirm_pass != $old_pass){
                $message[]= ' password matched!';
            }else{
                    $message[] = 're-enter your password';
                }
            }
                $update_image= $_FILES['update_image']['name'];
                $update_image_size= $_FILES['update_image']['size'];
                $update_image_tmp_size= $_FILES['update_image']['tmp_name'];
                $update_image_folder= 'uploaded_img/'.$image;

            if(!empty(update_image)){
                if($update_images_size> 2000000){
                    $message[]= 'image is too large';
                }
                else{
                    $image_update_query= mysqli_query($conn, "UPDATE 'user_form' SET image='$update_image' WHERE id='user_id'")
                    or die('query failed');
                if($image_update_query){
                    move_uploaded_file( $update_image_tmp_size, $update_image_folder);
                }
                    $message[]= 'image updated succesfully!';
                }
            }


            }


?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>update_profile</title>
    <link href="mitra.css" rel="stylesheet">
</head>
<body>
    <div class="update_profile">
    <?php
    $select= mysqli_query($conn, "SELECT * FROM  userinfo WHERE id='$user_id'")
    or die('query failed');
    if(mysqli_num_rows($select)> 0){
        $fetch= mysqli_fetch_assoc($select);
    }
    if($fetch['image']== ''){
        echo '<img src="images/default-avatar.png">';
    }
else{
    echo'<img src="uploaded_img/'.$fetch['image'].'">';
}
    ?>
    <form action="" method="post" enctype="multipart/form-data">
        <?php
        if($fetch['image']== ''){
            echo '<img src="images/default-avatar.png">';
        }
    else{
        echo'<img src="uploaded_img/'.$fetch['image'].'">';
    }
        ?>
        <div class="flex">
            <div class="inputBox">
                <span>Username:</span>
                <input type="text" name="update_name" value="<?php echo $fetch['name'] ?>" class="box">
                <span>Bio:</span>
                <input type="text" name="update_bio" value="<?php echo $fetch['bio'] ?>" class="box">
                <span>Change picture:</span>
                <input type="file" name="update_image" accept="image/jpg, image/jpeg, image/png" class="box">
            </div>
            <div class="inputBox">
                <span>confirm password:</span>
                <input type="password" name="confirm_pass" placeholder="confirm new password" class="box">

            </div>
        </div>
        <input type="submit" value="update profile" name="update_profile" class="btn">
        <a href="index.html" class="delete-btn">go back</a>
    </form>

    </div>
</body>
</html>