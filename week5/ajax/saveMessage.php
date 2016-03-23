<?php
    spl_autoload_register(function ($class_name) {
        include '../classes/' .$class_name . '.class.php';
    });

    $response ='';

    if(!empty($_POST['message'])) {
        try {
            $message = new Message();
            $message->setText($_POST['message']);
            $message->setUser($_POST['user']);
            $message->Create();
            $response->text = $message->getText();
            $response->user = $message->getUser();
        } catch (Exception $e) {
            return $e->getMessage();
        }

        header('Content-type: application/json');
        echo json_encode($response);
    }