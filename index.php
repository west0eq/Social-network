<?php
session_start();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="css/style.css">
    <link rel="stylesheet" href="css/menu.css">
    <link rel="stylesheet" href="css/loader.css">
    <script src="js/loader.js"></script>
    <title>Главная</title>
</head>
<body>
    <?php
    include ("menu.php");
    include("application/loader.php");
    ?>
    <div class="section-center">
        <h1 class="mb-0">Социальная сеть</h1>
    </div>
</body>
</html>