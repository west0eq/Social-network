<input class="menu-icon" type="checkbox" id="menu-icon" name="menu-icon"/>
<label for="menu-icon"></label>

<nav class="nav">

    <ul>
        <li><a href="../index.php">Главная</a></li>
        <?php
        if (isset($_SESSION['id'])){
            echo '<li><a href="http://localhost/SocialS/profile/account.php">Личный кабинет</a></li>';
        }else{
            echo '<li><a href="http://localhost/SocialS/auth.php">Личный кабинет</a></li>';
        }
        
        if (isset($_SESSION['id'])){
            echo  '<li><a href="http://localhost/SocialS/chat/chat.php">Чат</a></li>';
        }else{
            echo '<li><a href="http://localhost/SocialS/auth.php">Чат</a></li>';
        }
        ?>
    
        <li><a href="http://localhost/SocialS/posts/posts.php">Новости</a></li>
        <?php

        if (isset($_SESSION['id'])){
            echo  '<li><a href="http://localhost/SocialS/shop/shop.php">Магазин</a></li>';
        }else{
            echo '<li><a href="http://localhost/SocialS/auth.php">Магазин</a></li>';
        }
        ?>
        <li><a href="http://localhost/SocialS/games/games.php">Мини-игры</a></li>
    </ul>






</nav>