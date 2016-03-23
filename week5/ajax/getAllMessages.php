<?php
    spl_autoload_register(function ($class_name) {
        include '../classes/' .$class_name . '.class.php';
    });

    $message = new Message();
    $result = $message->GetAllMessages();
    $result = $result->fetchAll(PDO::FETCH_ASSOC);

    header('Content-type: application/json');
    echo json_encode($result);
