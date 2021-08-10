<div class="col-md-4">
    <?php


    ?>


    <!-- Blog Search Well -->
    <form method="post" action="search.php">
        <div class="well">
            <h4>Blog Search</h4>
            <div class="input-group">

                <input type="text" name="search" class="form-control">
                <span class="input-group-btn">
                    <button class="btn btn-default" name="submit" type="submit">
                        <span class="glyphicon glyphicon-search"></span>
                    </button>
                </span>

            </div>
            <!-- /.input-group -->
        </div>
    </form>



    <!-- Blog Categories Well -->
    <div class="well">
        <h4>Blog Categories</h4>
        <div class="row">
            <?php
            $query = "SELECT * FROM categories";

            $results = mysqli_query($conn, $query);


            ?>
            <div class="col-lg-6">
                <ul class="list-unstyled">
                    <?php
                    while ($rows = mysqli_fetch_assoc($results)) {

                        $cat_title = $rows['cat_title'];
                        $cat_id = $rows['cat_id'];
                        echo "<li><a href='category.php?cat_id=$cat_id'>{$cat_title}</a></li>";
                    }
                    ?>
                </ul>
            </div>
        </div>
        <!-- /.row -->
    </div>

    <!-- Side Widget Well -->
    <?php include "widget.php"; ?>

</div>