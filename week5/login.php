<?php
	session_start();
	if( !empty( $_POST ) )
	{
		$_SESSION['name'] = $_POST['name'];
		header('location: imessage.php');
	}
?><!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<title></title>
</head>
<body>
	
	<form action="" method="post">
		<label for="name">Je naam?</label>		
		<input type="text" name="name" id="name">
	</form>

</body>
</html>
