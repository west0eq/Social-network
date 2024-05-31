<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Змейка</title>
    
    <link rel="stylesheet" href="../../css/menu.css">
    <link rel="stylesheet" href="../../css/loader.css">
    <link rel="stylesheet" href="snake.css">
</head>
<body>
   <?php
    include ("../../menu.php");
    include("../../application/loader.php");
    ?> 
    
    <header><h1>Snake</h1></header>

    <canvas id="board"></canvas>
    <script src="snake.js"></script>
    <script src="../../js/loader.js"></script>
</body>
</html>