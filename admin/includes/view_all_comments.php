<table class="table table-bordered table-hover">
    <thead>
        <tr>
            <th>Comment ID</th>
            <th>Author</th>
            <th>Comment</th>
            <th>Email</th>
            <th>Status</th>
            <th>In response to:</th>
            <th>Date</th>
            <th>Approve</th>
            <th>Unapprove</th>
            <th>Edit</th>
            <th>Delete</th>
        </tr>
    </thead>
    <tbody>

        <?php

        $query_comments = "SELECT * FROM comments";

        $results_comments = mysqli_query($conn, $query_comments);
        while ($rows = mysqli_fetch_assoc($results_comments)) {

            $comment_id = $rows['comment_id'];
            $comment_post_id = $rows['comment_post_id'];
            $comment_author = $rows['comment_author'];
            $comment_email = $rows['comment_email'];
            $comment_content = $rows['comment_content'];
            $comment_status = $rows['comment_status'];
            $comment_date = $rows['comment_date'];

        ?>
            <tr>
                <td><?php echo $comment_id ?></td>
                <td><?php echo $comment_author ?></td>
                <td><?php echo $comment_content ?></td>
                <td><?php echo $comment_email ?></td>
                <td><?php echo $comment_status ?></td>

                <?php

                $query_select_posts = "SELECT * FROM posts WHERE post_id = '{$comment_post_id}'";
                $results = mysqli_query($conn, $query_select_posts);

                while ($rows = mysqli_fetch_assoc($results)) {
                    $post_id = $rows['post_id'];
                    $post_title = $rows['post_title'];
                    echo "<td><a href='../post.php?p_id=$post_id'>$post_title</a></td>";
                }

                ?>
                <td><?php echo  $comment_date ?></td>
                <td><?php echo "<a href='comments.php?approve=$comment_id'>Approve</a>"; ?></td>
                <td><?php echo "<a href='comments.php?unapprove=$comment_id'>Unapprove</a>"; ?></td>
                <td><?php echo "<a href='comments.php?source=edit_post&p_id='>Edit</a>"; ?></td>
                <td><?php echo "<a href='comments.php?delete=$comment_id'>Delete</a>"; ?></td>
            </tr>
        <?php } ?>
    </tbody>

</table>

<?php

if (isset($_GET['delete'])) {

    $comment_id = $_GET['delete'];

    $query_delete = "DELETE FROM comments WHERE comment_id = {$comment_id}";

    $results_delete = mysqli_query($conn, $query_delete);

    header("Location: comments.php");
}

if (isset($_GET['unapprove'])) {

    $comment_id = $_GET['unapprove'];

    $query_unapprove = "UPDATE comments  SET comment_status = 'unapproved' WHERE comment_id = $comment_id";

    $results_unapprove = mysqli_query($conn, $query_unapprove);

    header("Location: comments.php");
}

if (isset($_GET['approve'])) {

    $comment_id = $_GET['approve'];

    $query_approve = "UPDATE comments  SET comment_status = 'approved' WHERE comment_id = $comment_id";

    $results_approve = mysqli_query($conn, $query_approve);

    header("Location: comments.php");
}

?>