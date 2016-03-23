<?php
    session_start();
    $thisUser['name'] = $_SESSION['name'];

    header('Content-type: application/json');
    echo json_encode($thisUser);
