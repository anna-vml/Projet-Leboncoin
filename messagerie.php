<?php
session_start();
require_once 'config/database.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {

    $sender_id = $_SESSION['user_id'];
    $receiver_id = $_POST['receiver_id'];
    $message = trim($_POST['message']);

    if (!empty($message)) {

        $stmt = $pdo->prepare("
            INSERT INTO messages(sender_id, receiver_id, message)
            VALUES (?, ?, ?)
        ");

        $stmt->execute([
            $sender_id,
            $receiver_id,
            $message
        ]);
    }

    header("Location: conversation.php?user=" . $receiver_id);
    exit;
}
?>ézaQ  ²'
