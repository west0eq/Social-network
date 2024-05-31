<?php
session_start();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Заказы</title>
    <link rel="stylesheet" href="../css/menu.css">
    <link rel="stylesheet" href="../css/history_order.css">
</head>
<body>
    <?php
    include("../menu.php");
    ?>

    <header>
        <h1>История заказов</h1>
    </header>

<table class="table_shop">
    <?php
    include '../application/db.php';
    $userId = $_SESSION["id"];

    $query = "select email from users where id = ?";
    $stmt  =$connection->prepare($query);
    $stmt->bind_param("i", $userId);
    $stmt->execute();
    $stmt->bind_result($email);
    $stmt->fetch();
    $stmt->close();


    $test_query = "select num_order, date_order, paid from `order` where users = '".$email."' group by num_order, date_order, paid";

    $result = mysqli_query($connection, $test_query);

    for($data = []; $row=mysqli_fetch_assoc($result); $data[] = $row);
    $result = '';
    foreach($data as $elem){
        $result .='<tr>';
        $result .='<td><img style="width: 150px;" src="http://localhost/SocialS/shop/img/cart.png" alt=""></td>';

        $result .='<td><a href="http://localhost/SocialS/shop/content_order.php?OrderNum='.$elem['num_order'].'">Заказ №' .$elem['num_order'].' от ' .$elem['date_order'].'</a></td>';

        if($elem['paid'] == 0){
            $result .='<td>Не оплачено</td>';
            $result .='<td><img style="width:100px;" src="http://localhost/SocialS/shop/img/notpaid.jpg" alt=""></td>';
        }
        else{
            $result .='<td>Оплачено</td>';
            $result .='<td><img style="width:100px;" src="http://localhost/SocialS/shop/img/paid.png" alt=""></td>';
            
        }
        $result .='</tr>';
    }

    echo $result;
    mysqli_close($connection);
?>
</table>
</body>
</html>