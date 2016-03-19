<?php
    spl_autoload_register(function ($class_name) {
        include 'classes/' .$class_name . '.class.php';
    });
	if(!empty($_POST['username']))
	{
		try 
		{
			$user = new User();
			$user->Username = $_POST['username'];

			if($user->UsernameAvailable()) {
				$user->Create(); //INSERT USER INTO TABLE
				$feedback = "Thanks for signing up!";
			} else {
				$feedback = "Username already taken";
			}
		} 
		catch (Exception $e) 
		{
			$feedback = $e->getMessage();
		}
		
	}
?><!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
	<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
	<link rel="stylesheet" href="css/reset.css" media="screen" />
	<link rel="stylesheet" href="css/style.css" media="screen" />
	<title>Signup checks</title>
	<script type="text/javascript" src="https://code.jquery.com/jquery-1.12.2.min.js"></script>
	<script type="application/javascript" src="js/scripts.js"></script>
</head>
<body>
<?php if (isset($feedback)): ?>
<div class="feedback">
	<?php echo $feedback; ?>
</div>
<?php endif;?>

<div>

	<div class="signupForm">
		<form action="" method="post">
		<div>
			<label for="username">Username</label>
			
			<div id="signupZone">
				<input class="text" type="text" id="username" name="username" />
				<div class="usernameFeedback"><img id="loadingImage" src="images/loading.gif" /><span>checking</span></div>
			</div>
			
			<br />
			
			<input class="submit" type="submit" value="Create my account" id="btnSubmit" />
		</div>
		</form>
	</div>

</div>
</body>
</html>