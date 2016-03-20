<?php
spl_autoload_register(function ($class_name) {
    include '../classes/' .$class_name . '.class.php';
});
$activity = new Activity();
if(!empty($_POST['id']))
{
    $activity->Id = $_POST['id'];
    try
    {
        $activity->addLike();
        $response['status'] = 'geliked';
        $response['id'] = $_POST['id'];
        $response['message'] = $activity->getLikes();
    }
    catch (Exception $e)
    {
        $feedback = $e->getMessage();
        $response['status'] = "error";
        $response['message'] = $feedback;
    }
    header('Content-type: application/json');
    echo json_encode($response);
}
