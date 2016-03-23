<?php
	session_start();
	if(isset( $_SESSION['name'] ))
	{
		$currentUser = $_SESSION['name'];
	}
	else
	{
		// users needs to login first
		header("location: login.php");
	}

	include_once("classes/Message.class.php");
	$m = new Message();
	if( !empty($_POST) )
	{	
		try {
			$m = new Message();
			$m->setText($_POST['text']);
			$m->setUser($currentUser);
			$m->Create();
		} catch (Exception $e) {
			$error = $e->getMessage();
		}
	}
	$all_messages = $m->GetAllMessages();

?><!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<title>iMessage</title>
	<link rel="stylesheet" href="css/style.css">
	<script type="application/javascript" src="https://code.jquery.com/jquery-1.12.2.min.js"></script>
</head>
<body>
	<div class="chat">
		
		<section class="messages">
			<?php
				while( $message = $all_messages->fetch(PDO::FETCH_OBJ) )
				{
                    $theMessage = $message->text;
                    if(substr($theMessage, -4) == ".jpg" ||
                        substr($theMessage, -4) == ".png" ||
                        substr($theMessage, -4) == ".gif") {
                        $theMessage = "<img src=' " . $theMessage ." ' width='250'>";
                    }
					echo "<article>";
					if( $message->user === $currentUser )
					{
						echo "<article class='me'>"  . $message->user . ": " . $theMessage . "</article>";
					}
					else
					{
						echo "<article class='them'>" . $message->user . ": " . $theMessage . "</article>";
					}
					echo "</article>";
				}
			?>
		</section>

		<section class="newMessage">
			<form action="" method="post">
			<input type="text" class="imessage" id="iMessage" placeholder="iMessage" name="text">
			<button type="submit" value="Send" id="verzenden">Send</button>
			</form>
		</section>
	</div>

    <script type="application/javascript" src="js/scripts.js"></script>

</body>
</html>
