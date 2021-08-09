<?php


function insert_categories()
{
    global $conn;

    if (isset($_POST['submit'])) {
        $cat_title = $_POST['cat_title'];
        if (empty($cat_title)) {
            echo "This field should not be empty. <br>";
        }
        $query = "INSERT INTO categories(cat_title) VALUE('{$cat_title}')";

        $results = mysqli_query($conn, $query);

        if (!$results) {
            die("Query Failed " . mysqli_error($conn));
        }
    }
}

function find_all_categories()
{
    global $conn;
    $query = "SELECT * FROM categories";

    $results = mysqli_query($conn, $query);
    while ($rows = mysqli_fetch_assoc($results)) {

        $cat_id = $rows['cat_id'];
        $cat_title = $rows['cat_title'];
        echo "<tr>
                <td>$cat_id</td>
                <td>$cat_title</td>
                <td><a href='categories.php?delete={$cat_id}'>Delete</a></td>
                <td><a href='categories.php?edit={$cat_id}'>Edit</a></td>
            </tr>";
    }
}

function delete_categorie()
{
    if (isset($_GET['delete'])) {
        global $conn;
        $deleted_cat_id = $_GET['delete'];
        $query = "DELETE FROM categories WHERE cat_id = '{$deleted_cat_id}'";
        $delete_results = mysqli_query($conn, $query);
        header("Location: categories.php");
    }
}
