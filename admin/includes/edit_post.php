<?php

if (isset($_GET['p_id'])) {
    $get_post_id = $_GET['p_id'];

    $query = "SELECT * FROM posts WHERE post_id = $get_post_id";

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
    }
}

if (isset($_POST['update_post'])) {


    $post_author = $_POST['post_author'];
    $post_title = $_POST['post_title'];
    $post_category_id = $_POST['post_category'];
    $post_status = $_POST['post_status'];
    $post_image = $_FILES['image']['name'];
    $post_image_tmp = $_FILES['image']['tmp_name'];
    $post_content = $_POST['post_content'];
    $post_tags = $_POST['post_tags'];

    move_uploaded_file($post_image_tmp, "../images/$post_image");

    if(empty($post_image))
    {
        $query = "SELECT * FROM posts WHERE post_id = $get_post_id";
        $select_image = mysqli_query($conn, $query);
        while($rows = mysqli_fetch_assoc($select_image))
        {
            $post_image = $rows['post_image'];
        }
    }

    $query = "UPDATE posts SET "; // -> You need whitespace after SET
    $query .="post_title = '{$post_title}', ";
    $query .="post_category_id = {$post_category_id}, "; // -> Quotes are not needed with int values
    $query .="post_date = now(), ";
    $query .="post_author = '{$post_author}', ";
    $query .="post_status = '{$post_status}', ";
    $query .="post_tags = '{$post_tags}', ";
    $query .="post_content = '{$post_content}', ";
    $query .="post_image = '{$post_image}' ";
    $query .="WHERE post_id = {$post_id} ";

    $update_post = mysqli_query($conn, $query);
    if (!$update_post) {
        die("Query failed." . mysqli_error($conn));
    }
}
?>
<form action="" method="post" enctype="multipart/form-data">
    <div class="form-group">
        <label for="title">Post title
            <input type="text" value="<?php echo $post_title; ?>" class="form-control" name="post_title" id="">
        </label>
    </div>
    <div class="form-group">
        <label for="post_category">Post Category: </label>
        <select name="post_category" id="post_category">
            <?php
            $query = "SELECT * FROM categories";
            $results = mysqli_query($conn, $query);
            while ($rows = mysqli_fetch_assoc($results)) {
                $cat_id = $rows['cat_id'];
                $cat_title = $rows['cat_title'];
                echo "<option value='{$cat_id}'>{$cat_title}</option>";
            }

            ?>
        </select>
    </div>
    <div class="form-group">
        <label for="post_author">Post Author
            <input type="text" value="<?php echo $post_author; ?>" class="form-control" name="post_author" id="">
        </label>
    </div>
    <div class="form-group">
        <label for="post_author">Post Status
            <input type="text" value="<?php echo $post_status; ?>" class="form-control" name="post_status" id="">
        </label>
    </div>
    <div class="form-group">
        <label for="image">Post Image<br>
            <img  width="250" src="../images/<?php echo $post_image; ?>" alt="">
            <input type="file" name="image" id="">
        </label>
    </div>
    <div class="form-group">
        <label for="post_tags">Post Tags
            <input type="text" value="<?php echo $post_tags; ?>" class="form-control" name="post_tags" id="">
        </label>
    </div>
    <div class="form-group">
        <label for="post_content">Post Content
            <textarea value="" class="form-control" id="" cols="30" name="post_content" rows="10">
            <?php echo $post_content; ?>
        </textarea>
        </label>
    </div>
    <div class="form-group">
        <input type="submit" value="Update Post" name="update_post" class="btn btn-primary">
    </div>
</form>