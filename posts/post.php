<?php
include("../application/db.php");
session_start();
//Проверка получения id
$post_id = isset($_GET['id']) ? intval($_GET['id']) : 0;

//SQL Запрос

$sql_post = "select posts.title, posts.content, posts.image_url, posts.created_at, users.us_name 
from posts left join users on posts.user_id = users.id where posts.id = $post_id limit 1";

$result_post = $connection->query($sql_post);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Пост</title>

    <link rel="stylesheet" href="../css/menu.css">
    <link rel="stylesheet" href="../css/post.css">
    
</head>
<body>
<?php
include("../menu.php");    
?>
<?php
if($result_post->num_rows>0){
    while($row=$result_post->fetch_assoc()){
        echo '<div class="post-container">';
        echo '<h1>' .htmlspecialchars($row['title']) . '</h1>';

        if(!empty($row['us_name'])){
            echo '<p class="author-name">Автор: ' . htmlspecialchars($row["us_name"]) . '<p>';
        }
      
        if(!empty($row['image_url'])){
            echo '<img src="' . htmlspecialchars($row["image_url"]) . '" alt="Post Image">';
        }

        echo '<p>' . nl2br(htmlspecialchars($row["content"])) . '</p>';
        echo '<p class="post-time">Опубликовано: ' . $row["created_at"] . '</p>';
    
        echo '</div>';

    }
}else{
  echo "Пост не найден";
  echo "Ошибка запрос выполнения к базе данных: " . $connection->error;  
}

echo '<div class="comment-form-container">';
echo '<h3>Оставить комментарий</h3>';
echo '<form action="" method="post">';
echo '<input type="hidden" name="post_id" value="' . $post_id .'">';
echo '<label for"content">Комментарий:</label><br>';
echo '<textarea id="content" name="content" rows="4" required></textarea><br><br>';
echo '<button type="submit" name="submit_comment">Отправить комментарий</button>';
echo '</form>';
echo '</div>';




//Обработка отправки комментариев
if(isset($_POST['submit_comment'])){
    $author_name = isset($_SESSION['login'])? $connection->real_escape_string($_SESSION['login']): 'Неизвестный';
    $content = $connection->real_escape_string($_POST['content']);
    $sql_comment = "insert into comments (post_id, author_name, content) values ('$post_id', '$author_name', '$content')";

    if($connection->query($sql_comment) === TRUE){
        echo "<script>window.location.href = window.location.href;</script>";
        exit;
    }else{
        echo "<script> alert('Ошибка: ". $connection->error . "');</script>";
    }
}

$sql_comments = "select author_name, content, created_at from comments where post_id = $post_id order by created_at desc";
$result_comments = $connection->query($sql_comments);

if ($result_comments->num_rows >0 ){
    echo "<div class='comments-container'>";
    echo "<h3>Комментарии:</h3>";
    while($row = $result_comments->fetch_assoc()){
        echo "<div class ='comment'>";
        echo "<p><b>" . htmlspecialchars($row['author_name']). "</b> (" . $row['created_at'] . ")</p>";
        echo "<p>" . nl2br(htmlspecialchars($row['content'])) . "</p>";
        echo "</div>";
    }
    echo "</div>";
}else{
    echo "<p>Комментариев нет. Вы можете стать первым!</p>";
}
$connection->close();
?>




</body>
</html>