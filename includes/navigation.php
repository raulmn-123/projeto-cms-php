<?php include "db.php"; ?>
<nav class="navbar navbar-inverse navbar-fixed-top" role="navigation">
    <div class="container">
        <!-- Brand and toggle get grouped for better mobile display -->
        <div class="navbar-header">
            <button type="button" class="navbar-toggle" data-toggle="collapse" data-target="#bs-example-navbar-collapse-1">
                <span class="sr-only">Toggle navigation</span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
            </button>
            <a class="navbar-brand" href="index.php">CMS Project</a>
        </div>
        <!-- Collect the nav links, forms, and other content for toggling -->
        <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
            <ul class="nav navbar-nav">

        <?php 

            $query = "SELECT * FROM categories";

            $results = mysqli_query($conn, $query);
            
            while($rows = mysqli_fetch_assoc($results)){
                
                $cat_title = $rows['cat_title'];
                $cat_id = $rows['cat_id'];

                echo "<li><a href='category.php?cat_id=$cat_id'>{$cat_title}</a></li>";
            }

        ?>
            <li><a href="admin">Admin</a></li>
            </ul>
        </div>
        <!-- /.navbar-collapse -->
    </div>
    <!-- /.container -->
</nav>