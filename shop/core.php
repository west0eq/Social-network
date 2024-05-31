<?php
session_start();

$action = $_POST['action'];

switch($action){
    case 'init':
        init();
        break;

    case 'inputData':
        PutData();
        break;    
}

function init(){
    include '../application/db.php';
    $id_product = $_POST['id_product'];
    $id_product = substr($id_product, 0 , -1);

    $test_query = 'select id, name, price from merchndise where id in ('.$id_product.')';
    $result = mysqli_query($connection, $test_query);
    $out1 = array();
    while($row = mysqli_fetch_assoc($result)){
        $out1[$row["id"]] = $row;
    }

    echo json_encode($out1);
    mysqli_close($connection);
}

function PutData(){
    include '../application/db.php';
    $Data_order = $_POST['Data_Order'];

    $StrQuery="";
    $arrProd = explode(',', substr($Data_order['product'], 0,-1));
    $arrPrice = explode(',', substr($Data_order['price'], 0,-1));
    $arrCount = explode(',', substr($Data_order['count_product'], 0,-1));
    $arrSum = explode(',', substr($Data_order['summa'], 0,-1));

    $userId = $_SESSION["id"];


    $query = "select email from users where id = ?";
    $stmt = $connection->prepare($query);
    $stmt->bind_param("i", $userId);
    $stmt->execute();
    $stmt->bind_result($email);
    $stmt->fetch();
    $stmt->close();

    $Data_order["users"] = $email;

    for($i = 0; $i < count($arrProd); $i++){
        $StrQuery = 'insert into socials.order(`num_order`,`date_order`,`users`, `product`,`price`,`count_product`,`summa`,`paid`) values ('.$Data_order["num_order"].', "'.$Data_order["date_order"].'","'.$Data_order["users"].'", "'.$arrProd[$i].'", '.$arrPrice[$i].','.$arrCount[$i].', '.$arrSum[$i].',0);';

        $rez = mysqli_query($connection, $StrQuery);

    }

    mysqli_close($connection);
}