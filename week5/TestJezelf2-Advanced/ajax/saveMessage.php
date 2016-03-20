<?php
spl_autoload_register(function ($class_name) {
    include '../classes/' .$class_name . '.class.php';
});
$activity = new Activity();

//controleer of er een update wordt verzonden
if(!empty($_POST['message']))
{
    $activity->Text = $_POST['message'];
    try
    {
        $id = $activity->Save();
        $response['id'] = $id;
        $response['status'] = 'succes';
        $response['message'] = 'Update succesvol';
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