<?php 

$conn = new mysqli('localhost', 'root', '', 'cms', '3306');

if($conn->connect_error){
    echo "Error to connected in MYSQL : ".$conn->connect_errno;
}
