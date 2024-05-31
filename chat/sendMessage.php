<?php
require_once '../application/db.php';

if($_SERVER['REQUEST_METHOD'] === 'POST'){
    session_start();
    if(isset($_SESSION['id'])){
        $senderId = $_SESSION['id'];

    }else{
        echo json_encode(["status" => "error", "message" => "Error: User not auth"]);
        exit;
    }

    $receiverId = $_POST['receiver_id'];
    $messageText = $_POST['message'];


    $sql = "insert into messages (sender_id, receiver_id, message_text) values (?,?,?)";

    $stmt = $connection->prepare($sql);
    $stmt->bind_param("iis", $senderId, $receiverId, $messageText);

    if($stmt->execute()){
        echo json_encode(["status" => "success", "message" => "Message sent success"]);

    }else{
        echo json_encode(["status" => "error", "message" => "Error: " . $stmt->error]);
    }
    $stmt->close();
}