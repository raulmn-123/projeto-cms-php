<form action="" method="post">

    <?php
    if (isset($_GET['edit'])) {
        $cat_id = $_GET['edit'];
        $query = "SELECT * FROM categories WHERE cat_id = '{$cat_id}'";
        $results = mysqli_query($conn, $query);

        while ($rows = mysqli_fetch_assoc($results)) {
            $cat_id = $rows['cat_id'];
            $cat_title = $rows['cat_title'];
        }
    ?>

        <div class="form-group">
            <label for="cat_title">Digite o título da categoria: </label>
            <input value="<?php if (isset($cat_title)) {
                                echo $cat_title;
                            } ?>" type="text" class="form-control" name="cat_title" id="cat_title">
        </div>
        <div class="form-group">
            <input class="btn btn-primary" type="submit" value="Edit Category" name="update">
        </div>

    <?php } ?>

    <?php
    if (isset($_POST['update'])) {
        $edit_cat_title = $_POST['cat_title'];
        $query = "UPDATE categories SET cat_title = '{$edit_cat_title}' WHERE cat_id = '{$cat_id}'";
        $edit_results = mysqli_query($conn, $query);
        if (!$edit_results) {
            die("Query failed " . mysqli_error($conn));
        }
        header("Location: categories.php");
    }
    ?>

</form>