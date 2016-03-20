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
        $activity->removeActivity();
        $response['status'] = 'verwijderd';
        $response['message'] = 'delete succesvol';
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
