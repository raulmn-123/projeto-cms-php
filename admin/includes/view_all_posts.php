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
        </tr>
    </thead>
    <tbody>

        <?php

        $query = "SELECT * FROM posts";

        $results = mysqli_query($conn, $query);
        while ($rows = mysqli_fetch_assoc($results)) {

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

        ?>
            <tr>
                <td><?php echo $post_id ?></td>
                <td><?php echo $post_author ?></td>
                <td><?php echo $post_title ?></td>
                <td>the category of the post</td>
                <td><?php echo $post_status ?></td>
                <td><img  width="250" src="../images/<?php echo $post_image; ?>" alt=""></td>
                <td><?php echo $post_tags ?></td>
                <td>the comments of the post</td>
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
}

?>