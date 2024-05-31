<?php
session_start();
require_once("../application/db.php");


if(isset($_GET['id'])){
    $comment_id = $_GET['id'];

    $sql = "delete from comments where id = $comment_id";

    if($connection->query($sql) === TRUE){
            header("Location: allcomments.php");
            exit();
        }else{
            echo "Ошибка при удалении комментария: " . $connection->error;
        }
    }else{
        echo "Ошибка с передачей параметра id";
    }