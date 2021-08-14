<?php include "includes/admin_header.php"; ?>

<body>

    <?php

    if (isset($_SESSION['user_username'])) {

        $session_user_username = $_SESSION['user_username'];
        $query = "SELECT * FROM users WHERE user_username = '{$session_user_username}'";

        $select_profile_user = mysqli_query($conn, $query);
        while ($rows = mysqli_fetch_array($select_profile_user)) {
            $user_id = $rows['user_id'];
            $user_username = $rows['user_username'];
            $user_password = $rows['user_password'];
            $user_firstname = $rows['user_firstname'];
            $user_lastname = $rows['user_lastname'];
            $user_email = $rows['user_email'];
            $user_image = $rows['user_image'];
            $user_role = $rows['user_role'];
        }
    }

    ?>

    <?php

    if (isset($_POST['update_profile'])) {
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

        $query_update_profile = "UPDATE users SET "; // -> You need whitespace after SET
        $query_update_profile .= "user_role = '{$user_role}', ";
        $query_update_profile .= "user_firstname = '{$user_firstname}', ";
        $query_update_profile .= "user_lastname = '{$user_lastname}', ";
        $query_update_profile .= "user_email = '{$user_email}', ";
        $query_update_profile .= "user_password = '{$user_password}'";
        $query_update_profile .= "WHERE user_username = '{$session_user_username}' ";

        $update_profile = mysqli_query($conn, $query_update_profile);

        if (!$update_profile) {
            die("Query failed." . mysqli_error($conn));
        }
        header("Location: users.php");
    }

    ?>
    <div id="wrapper">
        <!-- Navigation -->
        <?php include "includes/admin_navigation.php"; ?>
        <div id="page-wrapper">
            <div class="container-fluid">
                <!-- Page Heading -->
                <div class="row">
                    <h1 class="page-header">
                        Wellcome to Admin
                        <small><?php echo $user_username; ?></small>
                    </h1>
                    <div class="col-md-12">
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
                                <input type="submit" value="Update Profile" name="update_profile" class="btn btn-primary">
                            </div>

                        </form>

                    </div>
                </div>
                <!-- /.row -->
            </div>
            <!-- /.container-fluid -->
        </div>
        <!-- /#page-wrapper -->
        <?php include "includes/admin_footer.php";  ?>