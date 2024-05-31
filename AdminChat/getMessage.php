<?php
session_start();
require_once '../application/db.php';

if($_SERVER['REQUEST_METHOD'] === 'POST'){
    global $connection;

    if(isset($_SESSION['id'])){
        $senderId = $_SESSION['id'];
    }else{
        echo "Error: Неавторизованный доступ";
        exit;
    }

//Доп условие на админа
if(($_SESSION['admin']) == 1){
    $senderId = 0;
}




    $receiverId = $_POST['receiver_id'];

    $stmt = $connection->prepare("select messages.message_text, messages.timestamp, sender.us_name as sender_name from messages JOIN users as sender on
    messages.sender_id = sender.id where(messages.sender_id = ? and messages.receiver_id = ?) or (messages.sender_id = ? and messages.receiver_id = ?)
    order by messages.timestamp");

    if(!$stmt){
        echo "Error  SQL query: " . $connection->error;
        exit;
    }

    $stmt->bind_param("iiii", $senderId, $receiverId, $receiverId, $senderId);

    $stmt->execute();

    if($stmt->error){
        echo "Error executing sql query: " . $stmt->error;
        exit;
    }

    $result = $stmt->get_result();
    $messages = [];

    while($row = $result->fetch_assoc()){
        $messages[] = $row;
    }

    foreach ($messages as $message){
        $senderName = isset($message['sender_name']) ? $message['sender_name'] : 'Unknown user';
        echo "$senderName: {$message['message_text']} ({$message['timestamp']})\n";
    }
$stmt->close();
}