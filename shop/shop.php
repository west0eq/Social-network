<?php
session_start();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Магазин</title>
    <link rel="stylesheet" href="../css/menu.css">
    <link rel="stylesheet" href="../css/shop.css">
</head>
<body>
    <?php
    include("../menu.php");
    ?>

<header>
    <h1>Магазин</h1>
</header>

<div class="assortment">
    <div class="zagolovok-shop">
        <a class="korzina" href="cart.php">Моя корзина</a>
    </div>

    <div class="products">
        <table class="table_shop">
                <tr>
                    <th colspan="2">Товар</th>
                    <th>Цена</th>
                    <th>Действие</th>
                </tr>
                <?php
                    include '../application/db.php';

                    $product_query = "select id, name, price, picture from merchndise";
                    $result = mysqli_query($connection, $product_query);
                    for($data = []; $row = mysqli_fetch_assoc($result); $data[] = $row);
                    $result='';
                    foreach($data as $elem){
                        $result .='<tr>';
                        $result .='<td><img style="width: 150px;" src="data:image/jpg;base64,'.$elem['picture'].'"; /></td>';
                        $result .='<td>'.$elem['name'].'</td>';
                        $result .='<td>'.$elem['price'].'</td>';
                        $result .='<td><button class= "add-to-cart" type="submit" onclick= "func(this.id)" id='.$elem['id'].'>Добавить в корзину</button></td>';
                        $result .='</tr>';
                    }
                    echo $result;
                    mysqli_close($connection);
                ?>
        </table>
    </div>
</div>
<script src="../js/jquery-3.7.1.min.js"></script>
<script src="../js/script.js"></script>
</body>
</html>
