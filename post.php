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

            <!-- First Blog Post -->
            <?php

            if (isset($_GET['p_id'])) {
                $get_post_id = $_GET['p_id'];
            }
            $query = "SELECT * FROM posts WHERE post_id='{$get_post_id}'";

            $results = mysqli_query($conn, $query);
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

            <?php } ?>

            <!-- Blog Comments -->
            <!-- Comments Form -->

            <?php

            if (isset($_POST['create_comment'])) {
                $get_post_id = $_GET['p_id'];
                $comment_author = $_POST['comment_author'];
                $comment_email = $_POST['comment_email'];
                $comment_content = $_POST['comment_content'];

                $query = "INSERT INTO comments(
                        comment_post_id, 
                        comment_author, 
                        comment_email, 
                        comment_content, 
                        comment_status, 
                        comment_date) 
                        VALUES(
                            $get_post_id,
                            '{$comment_author}',
                            '{$comment_email}',
                            '{$comment_content}',
                            'unapproved',
                            now())";
                $results_create_comment = mysqli_query($conn, $query);
                if (!$results_create_comment) {
                    die("Query Failed " . mysqli_error($conn));
                }

                $query_increment_commentField = "UPDATE posts SET post_comment_count = post_comment_count + 1 WHERE post_id = $get_post_id";
                $update_comment_count = mysqli_query($conn, $query_increment_commentField);
            }

            ?>

            <div class="well">
                <h4>Deixe um comentário</h4>
                <form action="" method="post" role="form">
                    <div class="form-group">
                        <label for="comment_author">Digite seu nome: </label>
                        <input type="text" name="comment_author" id="comment_author" class="form-control">
                    </div>
                    <div class="form-group">
                        <label for="comment_email">Digite seu email: </label>
                        <input type="email" name="comment_email" id="comment_email" class="form-control">
                    </div>
                    <div class="form-group">
                        <label for="comment_content">Digite seu comentário: </label>
                        <textarea class="form-control" name="comment_content" rows="3"></textarea>
                    </div>
                    <button type="submit" name="create_comment" class="btn btn-primary">Enviar</button>
                </form>
            </div>

            <hr>

            <!-- Posted Comments -->
            <h2 class="h2">Comentários </h2>

            <?php

            $query_comments = "SELECT * FROM comments 
            WHERE comment_post_id = {$get_post_id} 
            AND comment_status = 'approved' 
            ORDER BY comment_id DESC";

            $select_comment_query = mysqli_query($conn, $query_comments);
            if (!$select_comment_query) {
                die("Query Failed " . mysqli_error($conn));
            }

            while ($rows = mysqli_fetch_array($select_comment_query)) {
                $comment_date = $rows['comment_date'];
                $comment_content = $rows['comment_content'];
                $comment_author = $rows['comment_author'];

            ?>

                <!-- Comment -->
                <div class="media">
                    <a class="pull-left" href="#">
                        <img class="media-object" src="http://placehold.it/64x64" alt="">
                    </a>
                    <div class="media-body">
                        <h4 class="media-heading"><?php echo $comment_author; ?>
                            <small><?php echo $comment_date; ?></small>
                        </h4>
                        <?php echo $comment_content; ?>
                    </div>
                </div>
                <!-- Comment -->

            <?php } ?>


        </div>

        <!-- Blog Sidebar Widgets Column -->
        <?php include "includes/sidebar.php"; ?>

    </div>
    <!-- /.row -->
    <?php include "includes/footer.php"; ?>
    <hr>