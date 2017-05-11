<?php
	session_start();
	if(isset($_POST['Reset']))
	{
		// remove all session variables
		session_unset();
		// destroy the session 
		session_destroy();  
	}
	if(!isset($_SESSION['userName']) || !isset($_SESSION['password']))
	{
		header('Location:login.php');
	}
?>
<!DOCTYPE html>
<html lang="en">
<head>
	<title>Lab11</title>
	<meta charset="utf-8" >
	<link rel="stylesheet" type="text/css" href = "style.css"/>
</head>

<body>
	<div>
			<h1>Infomation</h1>
			<?php
				echo "User name: ".$_SESSION['userName'];
				echo " Password: ".$_SESSION['password']; 
			?> 
	</div>
</body>
</html>