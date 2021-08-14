<?php

if (isset($_GET['u_id'])) {

    $get_user_id = $_GET['u_id'];

    $query = "SELECT * FROM users WHERE user_id = $get_user_id";

    $results = mysqli_query($conn, $query);

    while ($rows = mysqli_fetch_assoc($results)) {

        $user_id = $rows['user_id'];
        $user_username = $rows['user_username'];
        $user_password = $rows['user_password'];
        $user_firstname = $rows['user_firstname'];
        $user_lastname = $rows['user_lastname'];
        $user_email = $rows['user_email'];
        $user_role = $rows['user_role'];
    }
}


if (isset($_POST['edit_user'])) {

    $user_username = $_POST['user_username'];
    $user_role = $_POST['user_role'];
    $user_firstname = $_POST['user_firstname'];
    $user_lastname = $_POST['user_lastname'];
    //$post_image = $_FILES['image']['name'];
    //$post_image_tmp = $_FILES['image']['tmp_name'];
    $user_email = $_POST['user_email'];
    $user_password = $_POST['user_password'];

    //move_uploaded_file($post_image_tmp, "../images/$post_image");

    /*
    if(empty($post_image))
    {
        $query = "SELECT * FROM posts WHERE post_id = $get_post_id";
        $select_image = mysqli_query($conn, $query);
        while($rows = mysqli_fetch_assoc($select_image))
        {
            $post_image = $rows['post_image'];
        }
    }
    */

    $query_update_user = "UPDATE users SET "; // -> You need whitespace after SET
    $query_update_user .= "user_username = '{$user_username}', ";
    $query_update_user .= "user_role = '{$user_role}', ";
    $query_update_user .= "user_firstname = '{$user_firstname}', ";
    $query_update_user .= "user_lastname = '{$user_lastname}', ";
    $query_update_user .= "user_email = '{$user_email}', ";
    $query_update_user .= "user_password = '{$user_password}'";
    $query_update_user .= "WHERE user_id = {$get_user_id} ";

    $update_user = mysqli_query($conn, $query_update_user);

    if (!$update_user) {
        die("Query failed." . mysqli_error($conn));
    }
    header("Location: users.php");
}





?>

<form action="" method="post" enctype="multipart/form-data">
    <div class="form-group">
        <label for="username">Username
            <input type="text" class="form-control" value="<?php echo $user_username; ?>" name="user_username" id="username">
        </label>
    </div>
    <div class="form-group">
        <label for="role">User role: </label>
        <select name="user_role" id="role">
            <option><?php echo $user_role; ?></option>
            <?php
            if ($user_role == 'admin') {
                echo '<option value="subscriber">Subscriber</option>';
            } else {
                echo '<option value="admin">Admin</option>';
            }

            ?>


        </select>
    </div>
    <div class="form-group">
        <label for="firstname">FirstName
            <input type="text" value="<?php echo $user_firstname; ?>" class="form-control" name="user_firstname" id="firstname">
        </label>
    </div>
    <div class="form-group">
        <label for="lastname">Lastname
            <input type="text" class="form-control" value="<?php echo $user_lastname; ?>" name="user_lastname" id="lastname">
        </label>
    </div>
    <!-- 
    <div class="form-group">
        <label for="image">Post Image
            <input type="file" name="post_image" id="">
        </label>
    </div>
    -->
    <div class="form-group">
        <label for="email">Email
            <input type="email" class="form-control" value="<?php echo $user_email; ?>" name="user_email" id="email">
        </label>
    </div>
    <div class="form-group">
        <label for="password">Password
            <input type="password" class="form-control" value="<?php echo $user_password; ?>" name="user_password" id="password">
        </label>
    </div>
    <div class="form-group">
        <input type="submit" value="Update User" name="edit_user" class="btn btn-primary">
    </div>

</form>