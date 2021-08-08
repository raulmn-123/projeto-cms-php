<?php include "includes/header.php"; ?>

<!-- Navigation -->
<?php include "includes/navigation.php"; ?>

<!-- Page Content -->
<div class="container">

    <div class="row">

        <!-- Blog Entries Column -->
        <div class="col-md-8">

            <h1 class="page-header">
                Page Heading
                <small>Secondary Text</small>
            </h1>


            <?php

            if (isset($_POST['submit'])) {
                $search = $_POST['search'];

                $query = "SELECT * FROM posts WHERE post_tags LIKE '%$search%'";
                $results = mysqli_query($conn, $query);

                if (!$results) {
                    die("Query Failed " . mysqli_error($conn));
                }
                $count = mysqli_num_rows($results);
                if ($count == 0) {
                    echo "<h1>No results</h1>";
                } else {

                    while ($rows = mysqli_fetch_assoc($results)) {

                        $post_title = $rows['post_title'];
                        $post_author = $rows['post_author'];
                        $post_date = $rows['post_date'];
                        $post_content = $rows['post_content'];
                        $post_image = $rows['post_image'];
            ?>

                        <h2>
                            <a href="#"><?php echo $post_title; ?></a>
                        </h2>
                        <p class="lead">
                            by <a href="index.php"><?php echo $post_author; ?></a>
                        </p>
                        <p><span class="glyphicon glyphicon-time"></span> <?php echo $post_date; ?></p>
                        <hr>
                        <img class="img-responsive" src="images/<?php echo $post_image; ?>" alt="">
                        <hr>
                        <p><?php echo $post_content; ?></p>
                        <a class="btn btn-primary" href="#">Read More <span class="glyphicon glyphicon-chevron-right"></span></a>

                        <hr>

            <?php }
                }
            }
            ?>


        </div>

        <!-- Blog Sidebar Widgets Column -->
        <?php include "includes/sidebar.php"; ?>

    </div>
    <!-- /.row -->
    <?php include "includes/footer.php" ?>