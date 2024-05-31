<?php
session_start();

//Очистка сессии
session_unset();

//Закрытие сессии
session_destroy();

header("Location: http://localhost/SocialS/");
exit();
?>