<?php
if (isset($_POST['create_user'])) {

    //$user_id = $_POST['user_id'];
    $user_username = $_POST['user_username'];
    $user_password = $_POST['user_password'];
    $user_firstname = $_POST['user_firstname'];
    $user_lastname = $_POST['user_lastname'];

    /* 
    $post_image = $_FILES['post_image']['name'];
    $post_image_tmp = $_FILES['post_image']['tmp_name'];
    */
    $user_email = $_POST['user_email'];
    $user_role = $_POST['user_role'];

    //$post_date = date('d-m-y');

    /* 
    move_uploaded_file($post_image_tmp, "../images/$post_image");
    */
    $query_users = "INSERT INTO users(user_firstname, user_lastname, user_role, user_username, user_email, user_password) ";
    $query_users .= "VALUES('{$user_firstname}', '{$user_lastname}', '{$user_role}','{$user_username}','{$user_email}', '{$user_password}') ";

    $create_user = mysqli_query($conn, $query_users);
    if (!$create_user) {
        die("Query Failed " . mysqli_error($conn));
    }
}

?>

<form action="" method="post" enctype="multipart/form-data">
    <div class="form-group">
        <label for="username">Username
            <input type="text" class="form-control" name="user_username" id="username">
        </label>
    </div>
    <div class="form-group">
        <label for="role">User role: </label>
        <select name="user_role" id="role">
            <option value="admin">Admin</option>
            <option value="subscriber">Subscriber</option>
        </select>
    </div>
    <div class="form-group">
        <label for="firstname">FirstName
            <input type="text" class="form-control" name="user_firstname" id="firstname">
        </label>
    </div>
    <div class="form-group">
        <label for="lastname">Lastname
            <input type="text" class="form-control" name="user_lastname" id="lastname">
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
            <input type="email" class="form-control" name="user_email" id="email">
        </label>
    </div>
    <div class="form-group">
        <label for="password">Password
            <input type="password" class="form-control" name="user_password" id="password">
        </label>
    </div>
    <div class="form-group">
        <input type="submit" value="Add User" name="create_user" class="btn btn-primary">
    </div>

</form>