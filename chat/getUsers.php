<?php 

require_once '../application/db.php';

$sql = "select id,us_name as username from users where id !=0";
$result = $connection->query($sql);
$users = [];
if($result){
    while($row = $result->fetch_assoc()){
        $users[]=[
            'id' => $row['id'],
            'username'=>$row['username']
        ];
    }
    $result->free();

}else{
    echo "Error: " . $connection->error;
}

$connection->close();
echo json_encode($users);