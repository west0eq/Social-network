<?php
session_start();
require_once("../application/db.php");

if(isset($_GET['id'])){
    $user_id = $_GET['id'];

    $sql_delete_posts = "delete from posts where user_id = ?";
    $stmt_delete_posts = $connection->prepare($sql_delete_posts);
    $stmt_delete_posts->bind_param("i", $user_id);

    if($stmt_delete_posts ->execute()){
        $sql_delete_messages = "delete from messages where sender_id = ? OR receiver_id = ?";
        $stmt_delete_messages = $connection->prepare($sql_delete_messages);
        $stmt_delete_messages->bind_param("ii", $user_id, $user_id);

        if($stmt_delete_messages->execute()){
            $sql_delete_user = "delete from users where id = ?";
            $stmt_delete_user = $connection->prepare($sql_delete_user);
            $stmt_delete_user->bind_param("i", $user_id);

            if($stmt_delete_user->execute()){
                header("Location: allusers.php");
                exit();
            }else{
                echo "Ошибка при удалении пользователя " . $connection->error;
            }
            $stmt_delete_user->close();
        }else{
            echo "Ошибка при удалении сообщений пользователя " . $connection->error;
        }
        $stmt_delete_messages->close();
    }else{
        echo "Ошибка при удалении постов пользователя " . $connection->error;
    }
    $stmt_delete_posts->close();

}else{
    echo "Идентификатор пользователя не распознан";
}
$connection->close();