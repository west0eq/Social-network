<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Мини-игры</title>
    <link rel="stylesheet" href="../css/menu.css">
    <link rel="stylesheet" href="../css/loader.css">
    <link rel="stylesheet" href="../css/games-list.css">
    <script src="../js/loader.js"></script>
</head>
<body>
    <header>Меню</header>
<?php
    include ("../menu.php");
    include("../application/loader.php");
    ?> 

    <div class="container">
        <table class="game-list">
            <tr>
                <th>Игра</th>
                <th>Описание</th>                
            </tr>
            <tr>
                <td><a href="x-o/x-o.php">Крестики-нолики</a></td>
                <td>Крестики-нолики - классическая древняя игра 15 века</td>
            </tr>

            <tr>
                <td><a href="x-o(bot)/x-o.php">Крестики-нолики c низшим интеллектом</a></td>
                <td>Крестики-нолики - классическая древняя игра 15 века, игра с ботом!!</td>
            </tr>

            <tr>
                <td><a href="x-o(hardbot)/x-o.php">Крестики-нолики c высшим интеллектом</a></td>
                <td>Крестики-нолики - классическая древняя игра 15 века, игра с ботом!!</td>
            </tr>

            <tr>
                <td><a href="snake/snake.php">Змейка</a></td>
                <td>Змейка, старая классика!!</td>
            </tr>

            <tr>
                <td><a href="breakout/breakout.php">Breakout</a></td>
                <td>Секретно</td>
            </tr>
        </table>
    </div>
</body>
</html>