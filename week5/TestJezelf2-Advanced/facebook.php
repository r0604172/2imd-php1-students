<?php 
	//Eerst bouwen we onze applicatie uit zodat ze werkt, ook zonder JavaScript

	spl_autoload_register(function ($class_name) {
		include 'classes/' .$class_name . '.class.php';
	});
	$activity = new Activity();
	
	//controleer of er een update wordt verzonden
	if(!empty($_POST))
	{
        if($_POST['action'] === "nieuweActivity") {
            $activity->Text = $_POST['activitymessage'];
            try
            {
                $activity->Save();
            }
            catch (Exception $e)
            {
                $feedback = $e->getMessage();
            }
        }

        if($_POST['action']=== "removeActivity") {
            $activity->Id = $_POST['id'];
            
            try {
                $activity->removeActivity();
            } catch (Exception $e) {
                $feedback = $e->getMessage();
            }
        }
	}
	
	//altijd alle laatste activiteiten ophalen
	$recentActivities = $activity->GetRecentActivities();
	
?><!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
	<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
    <title>IMDBook</title>
    <link href="css/reset.css" rel="stylesheet" />
    <link href="css/style.css" rel="stylesheet" />
    <script type="text/javascript" src="https://code.jquery.com/jquery-2.2.1.min.js"></script>
    <script type="text/javascript" src="js/scripts.js"></script>
</head>
<body>
<div>
	<div class="errors"><?php if(isset($feedback)){ echo $feedback;} ?></div>
	
	<form method="post" action="">
		<div class="statusupdates">
            <h1>Christophe</h1>
            <input type="text" placeholder="What's on your mind?" id="activitymessage" name="activitymessage" />
            <input type="hidden" name="action" value="nieuweActivity" />
            <input id="btnSubmit" type="submit" value="Share" />

            <ul id="listupdates">
            <?php
                if(count($recentActivities) > 0)
                {
                    foreach($recentActivities as $key=>$singleActivity)
                    {
                        echo "<li id='". $singleActivity['pk_activity_id'] ."'><h2>Christophe </h2> ". $singleActivity['activity_description'] ."<br><form method='post' action=''><input type='hidden' name='action' value='removeActivity' /><input type='hidden' id='id' name='id' value='". $singleActivity['pk_activity_id'] ."' /><input type='image' src='img/soft_grey_action_delete.png' id='btnRemove". $singleActivity['pk_activity_id'] ."' class='btnRemove' /></form></li>";
                    }
                }
                else
                {
                    echo "<li>Waiting for first status update</li>";
                }
            ?>
            </ul>
		
		</div>
	</form>
	
</div>	
</body>
</html>