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
    <title>Регистрация</title>
</head>
<body>
    <?php
    include("menu.php")
    ?>

    <div class="container">
<!-- Начало формы -->
        <form class="reg" method="post" action="registration.php">
            <h3>Регистрация пользователя</h3>
                
            <div class="mb-3">
                    <label for="exampleInputEmail1" class="form-label">ФИО</label>
                    <p></p>
                    <input name="login" type="text" class="form-control" id="formGroupExampleInput" placeholder="Введите свое ФИО">       
            </div>

            <div class="mb-3">
                    <label for="exampleInputEmail1" class="form-label">Адрес электронной почты</label>
                    <p></p>
                    <input name="email" type="email" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp">
                    <div id="emailHelp" class="form-text">Мы никогда никому не передадим вашу электронную почту.</div>
            </div>

            <div class="mb-3">
                    <label for="exampleInputEmail1" class="form-label">Возраст</label>
                    <p></p>
                    <input type="text" name="age" class="form-control" id="formGroupExampleInput">
                    
            </div>
               
            <p></p>
        <!-- Password -->
            <div class="mb-3">
                    <label for="exampleInputPassword1" class="form-label">Пароль</label>
                    <p></p>
                    <input type="password" name="pass-first" class="form-control" id="exampleInputPassword1">
            </div>

            <div class="mb-3">
                    <label for="exampleInputPassword1" class="form-label">Повторите свой пароль</label>
                    <p></p>
                    <input type="password" name="pass-second" class="form-control" id="exampleInputPassword2">
            </div>

            <button name="button-reg" type="submit" class="btn-primary">Отправить</button>
            <a href="auth.php">Авторизоваться</a>
            <div class="form-text1">Если уже регистрировались</div>


        </form>

        <!-- Конец формы -->
    </div>
</body>
</html>