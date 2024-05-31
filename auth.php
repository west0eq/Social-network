<?php
include ("application/users.php");
?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="css/menu.css">
    <link rel="stylesheet" href="css/log.css">
    <title>Авторизация</title>
</head>
<body>
    <?php
    include("menu.php")
    ?>

    <div class="container">
        <form class="reg" method="post" action="auth.php">
            <h3>Авторизация пользователя</h3>
                
            <div class="mb-3">
                    <label for="exampleInputEmail1" class="form-label">Адрес электронной почты</label>
                    <p></p>
                    <input name="email" type="email" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp">
                    <div id="emailHelp" class="form-text">Мы никогда никому не передадим вашу электронную почту.</div>
            </div>
               
            <p></p>
<!-- Password -->
  <div class="mb-3">
    <label for="exampleInputPassword1" class="form-label">Пароль</label>
    <p></p>
    <input name="password" type="password" class="form-control" id="exampleInputPassword1">
  </div>

  <button name="button-log" type="submit" class="btn-primary">Отправить</button>
  <a href="registration.php">Зарегистрироваться</a>
  <div class="form-text1">Если еще не регистрировались</div>


        </form>
    </div>
</body>
</html>