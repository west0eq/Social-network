<?php
session_start();
require_once("../application/db.php");

$sql = "select * from users where id != 0";

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
    <title>Все пользователи</title>
    <link rel="stylesheet" href="../css/menu.css">
    <link rel="stylesheet" href="../css/tools.css">
</head>
<body>
   <?php include("../menu.php");?>
   
   <h1>Все пользователи</h1>
    <?php if($result->num_rows>0):  ?>
   <table>
        <tr>
            <th>ID</th>
            <th>Имя пользователя</th>
            <th>Email</th>
            <th>Возраст</th>
            <th>Дата создания аккаунта</th>
            <th>Действия</th>
        </tr>
        <?php while($row=$result->fetch_assoc()):?>
            <tr>
                <td><?php echo $row['id'];?></td>
                <td><?php echo htmlspecialchars($row['us_name']);?></td>
                <td><?php echo htmlspecialchars($row['email']);?></td>
                <td><?php echo htmlspecialchars($row['age']);?></td>
                <td><?php echo htmlspecialchars($row['created']);?></td>
                <td><a href="delete_user.php?id=<?php echo $row['id'];?>">Удалить</a></td>
            </tr>
        <?php endwhile; ?>
    </table>
        <?php else: ?>
            <p>Пользователей нет </p>
            <?php endif; ?>
</body>
</html>