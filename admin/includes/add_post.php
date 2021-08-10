<?php
if (isset($_POST['create_post'])) {
    $post_title = $_POST['post_title'];
    $post_author = $_POST['post_author'];
    $post_category_id = $_POST['post_category'];
    $post_status = $_POST['post_status'];

    $post_image = $_FILES['post_image']['name'];
    $post_image_tmp = $_FILES['post_image']['tmp_name'];

    $post_tags = $_POST['post_tags'];
    $post_content = $_POST['post_content'];
    $post_date = date('d-m-y');
    $post_comment_count = 4;

    move_uploaded_file($post_image_tmp, "../images/$post_image");

    $query = "INSERT INTO 
    posts(
        post_category_id, 
        post_title, 
        post_author, 
        post_date, 
        post_image, 
        post_content, 
        post_tags, 
        post_comment_count, 
        post_status)
        VALUES(
            '{$post_category_id}',
            '{$post_title}',
            '{$post_author}',
            now(),
            '{$post_image}',
            '{$post_content}',
            '{$post_tags}',
            '{$post_comment_count}',
            '{$post_status}')";

    $create_post = mysqli_query($conn, $query);
    if (!$create_post) {
        die("Query Failed " . mysqli_error($conn));
    }
}

?>

<form action="" method="post" enctype="multipart/form-data">
    <div class="form-group">
        <label for="title">Post title
            <input type="text" class="form-control" name="post_title" id="">
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
            <input type="text" class="form-control" name="post_author" id="">
        </label>
    </div>
    <div class="form-group">
        <label for="post_author">Post Status
            <input type="text" class="form-control" name="post_status" id="">
        </label>
    </div>
    <div class="form-group">
        <label for="image">Post Image
            <input type="file" name="post_image" id="">
        </label>
    </div>
    <div class="form-group">
        <label for="post_tags">Post Tags
            <input type="text" class="form-control" name="post_tags" id="">
        </label>
    </div>
    <div class="form-group">
        <label for="post_content">Post Content
            <textarea class="form-control" id="" cols="30" name="post_content" rows="10">
    </textarea>
        </label>
    </div>
    <div class="form-group">
        <input type="submit" value="Publish Post" name="create_post" class="btn btn-primary">
    </div>

</form>