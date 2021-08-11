<table class="table table-bordered table-hover">
    <thead>
        <tr>
            <th>Post ID</th>
            <th>Author</th>
            <th>Title</th>
            <th>Category</th>
            <th>Status</th>
            <th>Image</th>
            <th>Tags</th>
            <th>Comments</th>
            <th>Date</th>
            <th>Edit</th>
            <th>Delete</th>
        </tr>
    </thead>
    <tbody>

        <?php

        $query_posts = "SELECT * FROM posts";

        $results_posts = mysqli_query($conn, $query_posts);
        while ($rows = mysqli_fetch_assoc($results_posts)) {

            $post_id = $rows['post_id'];
            $post_title = $rows['post_title'];
            $post_author = $rows['post_author'];
            $post_date = $rows['post_date'];
            $post_content = $rows['post_content'];
            $post_image = $rows['post_image'];
            $post_status = $rows['post_status'];
            $post_tags = $rows['post_tags'];
            $post_comment_count = $rows['post_comment_count'];
            $post_date = $rows['post_date'];
            $post_category_id = $rows['post_category_id'];

        ?>
            <tr>
                <td><?php echo $post_id ?></td>
                <td><?php echo $post_author ?></td>
                <td><?php echo $post_title ?></td>

                <?php
                $query = "SELECT * FROM categories WHERE cat_id = '{$post_category_id}'";
                $results = mysqli_query($conn, $query);

                while ($rows = mysqli_fetch_assoc($results)) {
                    $cat_id = $rows['cat_id'];
                    $cat_title = $rows['cat_title'];

                    echo "<td>$cat_title</td>";
                }


                ?>

                <td><?php echo $post_status ?></td>
                <td><img width="250" src="../images/<?php echo $post_image; ?>" alt=""></td>
                <td><?php echo $post_tags ?></td>
                <td><?php echo $post_comment_count; ?></td>
                <td><?php echo $post_date ?></td>
                <td><?php echo "<a href='post.php?source=edit_post&p_id=$post_id'>Edit</a>"; ?></td>
                <td><?php echo "<a href='post.php?delete=$post_id'>Delete</a>"; ?></td>
            </tr>
        <?php } ?>
    </tbody>

</table>

<?php

if (isset($_GET['delete'])) {
    $post_id = $_GET['delete'];
    $query = "DELETE FROM posts WHERE post_id = '{$post_id}'";
    $results = mysqli_query($conn, $query);

    if (!$results) {
        die("Query failed" . mysqli_error($conn));
    }
    $query_decrement_commentField = "UPDATE posts SET post_comment_count = post_comment_count - 1 WHERE post_id = $get_post_id";
    $update_comment_count = mysqli_query($conn, $query_decrement_commentField);
    header("Location: post.php");
}

?>