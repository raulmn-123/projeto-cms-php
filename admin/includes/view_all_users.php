<table class="table table-bordered table-hover">
    <thead>
        <tr>
            <th>ID</th>
            <th>Username</th>
            <th>Firstname</th>
            <th>Lastname</th>
            <th>Email</th>
            <th>Role</th>
        </tr>
    </thead>
    <tbody>

        <?php

        $query_users = "SELECT * FROM users";

        $results_users = mysqli_query($conn, $query_users);
        while ($rows = mysqli_fetch_assoc($results_users)) {

            $user_id = $rows['user_id'];
            $user_username = $rows['user_username'];
            $user_password = $rows['user_password'];
            $user_firstname = $rows['user_firstname'];
            $user_lastname = $rows['user_lastname'];
            $user_email = $rows['user_email'];
            $user_image = $rows['user_image'];
            $user_role = $rows['user_role'];

        ?>
            <tr>
                <td><?php echo $user_id ?></td>
                <td><?php echo $user_username ?></td>
                <td><?php echo $user_firstname ?></td>
                <td><?php echo $user_lastname ?></td>
                <td><?php echo $user_email ?></td>

                <!-- 
                <?php
                /*
                $query_select_posts = "SELECT * FROM posts WHERE post_id = '{$comment_post_id}'";
                $results = mysqli_query($conn, $query_select_posts);

                while ($rows = mysqli_fetch_assoc($results)) {
                    $post_id = $rows['post_id'];
                    $post_title = $rows['post_title'];
                    echo "<td><a href='../post.php?p_id=$post_id'>$post_title</a></td>";
                }
                */

                ?>
                -->


                <td><?php echo  $user_role ?></td>
                <td><?php echo "<a href='users.php?change_admin=$user_id'>Admin</a>"; ?></td>
                <td><?php echo "<a href='users.php?change_sub=$user_id'>Subscriber</a>"; ?></td>
                <td><?php echo "<a href='users.php?source=edit_user&u_id=$user_id'>Edit</a>"; ?></td>
                <td><?php echo "<a href='users.php?delete=$user_id'>Delete</a>"; ?></td>
            </tr>
        <?php } ?>
    </tbody>

</table>

<?php

if (isset($_GET['delete'])) {

    $get_user_id = $_GET['delete'];

    $query_delete = "DELETE FROM users WHERE user_id = {$get_user_id}";

    $results_delete = mysqli_query($conn, $query_delete);

    header("Location: users.php");
}

if (isset($_GET['change_sub'])) {

    $get_user_id = $_GET['change_sub'];

    $query_sub = "UPDATE users  SET user_role = 'subscriber' WHERE user_id = {$get_user_id}";

    $results_unapprove = mysqli_query($conn, $query_sub);

    header("Location: users.php");
}

if (isset($_GET['change_admin'])) {

    $get_user_id = $_GET['change_admin'];

    $query_admin = "UPDATE users  SET user_role = 'admin' WHERE user_id = {$get_user_id}";

    $results_approve = mysqli_query($conn, $query_admin);

    header("Location: users.php");
}

?>