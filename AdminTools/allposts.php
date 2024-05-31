<?php
session_start();
require_once("../application/db.php");
$sql = "select posts.id, posts.title, users.us_name, posts.created_at from posts join users on posts.user_id = users.id";
$result = $connection->query($sql);

if(!$result){
    die("Ошибка выполнения запроса: " . $connection->error);
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Все посты</title>
    <link rel="stylesheet" href="../css/menu.css">
    <link rel="stylesheet" href="../css/tools.css">
</head>
<body>

<?php
include("../menu.php");
?>

<h1>Все посты</h1>
<?php 
if($result->num_rows>0):?>
    <table>
        <tr>
            <th>ID</th>
            <th>Заголовок</th>
            <th>Автор</th>
            <th>Дата создания</th>
            <th>Действия</th>
        </tr>
        <?php while($row = $result->fetch_assoc()): ?>
            <tr>
                <td><?php echo $row['id'];?></td>
                <td><?php echo htmlspecialchars($row['title']);?></td>
                <td><?php echo htmlspecialchars($row['us_name']);?></td>
                <td><?php echo $row['created_at'];?></td>
                <td>
                    <a href="http://localhost/SocialS/posts/post.php?id=<?php echo $row['id']; ?>">Просмотреть</a>
                    /
                    <a href="delete_post.php?id=<?php echo $row['id']; ?>">Удалить</a>    
                </td>
                
                
            </tr>
            <?php endwhile; ?>
    </table>
    <?php else: ?>
        <p>Посты отсутствуют</p>
        <?php endif;?>
</body>
</html>