<?php
session_start();
include ("db.php");

//Function session 

function setSession($id, $us_name, $admin, $age){
    $_SESSION['id'] = $id;
    $_SESSION['login'] = $us_name;
    $_SESSION['admin'] = $admin;
    $_SESSION['age'] = $age;
}

///Регистрация пользователя
if($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['button-reg'])){
    $us_name = $_POST['login'];
    $email   = $_POST['email'];
    $age     = $_POST['age'];
    $pass_first = $_POST['pass-first'];
    $pass_second = $_POST['pass-second'];

    if($pass_first !== $pass_second){
        echo "Пароли не совпадают";
    }else{
            $hashed_password = password_hash($pass_first, PASSWORD_DEFAULT);
        

            //Проверка на email
            $check_email_query = "select * from users where email = '$email'";
            $check_email_result = $connection->query($check_email_query);

            if($check_email_result->num_rows>0){
                echo "Пользователь с такой почтой уже существует";
            }else{
                $admin = 0;

                $stmt = $connection->prepare("insert into users (admin, us_name, email, age, password) values (?,?,?,?,?)");
                $stmt->bind_param("issss", $admin, $us_name, $email, $age, $hashed_password);

                if($stmt->execute()){
                    echo "Регистрация успешна. ";
                    setSession($connection->insert_id, $us_name, 0, $age);
                    header("Location: http://localhost/SocialS/profile/account.php");
                    exit();
                }else{
                    echo "Ошибка при регистрации " . $connection->error;
                }
                $stmt->close();
            }
    }
}
//Авторизация пользователя

if($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['button-log'])){

$email = $_POST['email'];
$password = $_POST['password'];

$stmt = $connection->prepare("select id, us_name, admin, age, password from users where email=?");
$stmt->bind_param("s", $email);
$stmt->execute();

$result = $stmt->get_result();

if($result->num_rows == 1){
    $row = $result->fetch_assoc();

    if(password_verify($password, $row['password'])){
        echo "Авторизация прошла успешно. Приветствуем, " . $row['us_name'];
       /* $ убрать */ setSession($row['id'], $row['us_name'], $row['admin'], $row['age']);
        header("Location: http://localhost/SocialS/profile/account.php");
        exit();
    }else{
        echo "Неверно введены данные";
    }

}else{
    echo "Пользователя с такой почтой не существует";
}

$stmt->close();
}

//Редактирование профиля
if($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['button-upd'])){
    $id = $_SESSION['id'];
    $us_name = $_POST['user-name'];
    $email = $_POST['user-email'];
    $age = $_POST['user-age'];
    $info = $_POST['user-info'];
    $pass_first = $_POST['pass-first'];
    $pass_second = $_POST['pass-second'];


    if($pass_first !== $pass_second){
        echo "Пароли не совпадают";
    }else{
        if(!empty($pass_first)){
            //Hash
            $hashed_password = password_hash($pass_first, PASSWORD_DEFAULT);
            $password_update = ", password = '$hashed_password'";
        }else{
            $password_update = "";
        }

        $check_email_query = "select * from users where email='$email' and id!=$id";
        $check_email_result = $connection->query($check_email_query);
        if($check_email_result && $check_email_result->num_rows>0){
            echo "Эта почта уже занята. Используйте другую!";
        }else{
            $info_escaped = mysqli_real_escape_string($connection, $info);
            $update_query = "update users set us_name = '$us_name', email='$email', age=$age $password_update, info='$info_escaped' where id=$id";
            if($connection->query($update_query) === TRUE){
                echo "Данные успешно изменены";
                $_SESSION['login'] = $us_name;
                $_SESSION['age'] = $age;

                header("Location: http://localhost/SocialS/profile/account.php");
                exit();
            }else{
                echo "Ошибка при обновлении данных" . $connection->error;
            }
        }
    }
}