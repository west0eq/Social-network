<?php
session_start();
require_once("../application/db.php");


if(isset($_GET['id'])){
    $post_id = $_GET['id'];

    $delete_comments_sql = "delete from comments where post_id = $post_id";

    if($connection->query($delete_comments_sql) === TRUE){
        $delete_post_sql = "delete from posts where id = $post_id";
        if($connection->query($delete_post_sql) === TRUE){
            header("Location: allposts.php");
            exit();
        }else{
            echo "Ошибка при удалении поста: " . $connection->error;
        }
    }else{
        echo "Ошибка при удалении комментариев: " . $connection->error;
    }
}else{
    echo "Ошибка с передачей параметра id";
}
