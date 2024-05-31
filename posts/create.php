<?php
session_start();
include_once '../application/db.php';

if($_SERVER["REQUEST_METHOD"] == "POST"){
    $title = mysqli_real_escape_string($connection,$_POST['title']);
    $content = mysqli_real_escape_string($connection,$_POST['content']);
    $image_url = '';
    $user_id = $_SESSION['id'];

    if(isset($_FILES['image'])&& $_FILES['image']['error'] == 0){
        $upload_dir = 'uploads/';
        $upload_file = $upload_dir . basename($_FILES['image']['name']);
        if(move_uploaded_file($_FILES['image']['tmp_name'], $upload_file)){
            $image_url = $upload_file;

        }else{
            echo "Error loading file";
        }
    }

    $sql = "insert into posts(title, content, image_url, user_id) values('$title', '$content', '$image_url', '$user_id')";


    if($connection->query($sql) === TRUE){
        echo "Новый пост успешно создан";
        header("Location: http://localhost/SocialS/posts/posts.php");
    }else{
        echo "Error: " . $sql . "<br>" . $connection->error;
    }

}
$connection->close();