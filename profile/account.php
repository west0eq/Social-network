<?php
session_start();
$user_id = $_SESSION['id'];
ob_start();
include("upload-posts.php");
$output = ob_get_clean();

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Профиль</title>
    <link rel="stylesheet" href="../css/menu.css">
    <link rel="stylesheet" href="../css/profile-styles.css">
</head>
<body>
    
    <header>
        <h1>Личный кабинет</h1>
    <form action="logout.php" method="post">
        <button type="submit" name="logoutButton">Выйти из учетной записи</button>
    </form>
    </header>

<?php
include ("../menu.php");
?>

<section id="profile-info">
    <h2>Информация о пользователе</h2>
    <!-- Картинка -->
    <div id="profile-picture-container">
        <img id="profile-picture" src="avatars/placeholder.png" alt="avatars/placeholder.png">
    </div>

<!-- Имя пользователя -->
<p>ФИО: <span class="info" id="user-name"><?php echo isset($_SESSION['login']) ? $_SESSION['login'] : '';?></span></p>
<!-- Возраст -->
<p>Возраст: <span class="info" id="user-age"><?php echo isset($_SESSION['age']) ? $_SESSION['age'] : '';?></span></p>
<!-- Дата создания -->
<p>Дата создания аккаунта: <span class="info" id="account-creation-date"></span></p>
<!-- Email -->
<p>Email: <span class="info" id="user-email"></span></p>
<!-- О себе -->
<p>Лор: <span class="info" id="user-info"></span></p>

<h3>Панель управления</h3>
<button onclick="document.location='editer_profile.php'" id="edit-profile">Редактировать профиль</button>
<button onclick="document.location='http://localhost/SocialS/AdminChat/AdminChat.php'" id="admin-chat">Написать администратору</button>
<!-- Кнопки для картинки профиля -->
<button id="update-picture">Обновить картинку профиля</button>
<button id="delete-picture">Удалить картинку профиля</button>

<button id="story_order" onclick="document.location='http://localhost/SocialS/shop/history_order.php'">История заказов</button>


<input type="file" id="file-input" accept="image/*" style="display: none">

<button onclick="document.location='http://localhost/SocialS/posts/createpost.php'" id="create-post">Создать пост</button>

<?php
if(isset($_SESSION['admin']) && $_SESSION['admin'] == 1){
    echo '<button onclick="document.location=\'http://localhost/SocialS/AdminTools/allusers.php\'">Все пользователи</button>';

    echo '<button onclick="document.location=\'http://localhost/SocialS/AdminTools/allposts.php\'">Все посты</button>';

    echo '<button onclick="document.location=\'http://localhost/SocialS/AdminTools/allcomments.php\'">Все комментарии</button>';
}
?>
</section>

<!-- Посты -->
<section id="user-posts">
<h2>Мои посты</h2>
<?php echo $output; ?>
</section>

<script>
 document.addEventListener("DOMContentLoaded", function(){
    var posts = document.querySelectorAll('.post-block');

    posts.forEach(function(post){
        post.addEventListener('mouseenter', function(){
            this.style.backgroundColor = '#50576b';
        });

        post.addEventListener('mouseleave', function(){
            this.style.backgroundColor = '';

        });
    });
 });
</script>

<script src="../js/profile.js" defer></script>
<!-- *** -->
<script src="../js/picture.js" defer></script>
<!-- *** -->


</body>
</html>



