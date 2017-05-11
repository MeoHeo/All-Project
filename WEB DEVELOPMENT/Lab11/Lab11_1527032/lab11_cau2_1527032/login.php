<?php
// Start the session
session_start();
?>
<!DOCTYPE html>
<html lang="en">
<head>
	<title>Lab11</title>
	<meta charset="utf-8" >
	<link rel="stylesheet" type="text/css" href = "style.css"/>
</head>

<body>
		<?php
			
			if(isset($_POST['Login']) || isset($_POST['Reset']))
			{
				$userName = $_POST['userName'];
				$password = $_POST['password'];
				$erroName = $erroPass = ""; 
				if(empty($userName))
				{
					$erroName = "User name is required";
				}
				if(empty($password) || isset($_POST['Reset']))
				{
					$erroPass = "Password is required";
				}
				if(!empty($userName) && !empty($password))
				{
					$_SESSION['userName'] = $userName;
					$_SESSION['password'] = $password;
				
					//echo "user: " . $_SESSION['userName'] . " password: " . $_SESSION['password'];
					header('Location: info.php');
				}
			}

			if(isset($_POST['Reset']))
			{
					// remove all session variables
				session_unset();
				// destroy the session 
				session_destroy();  
			}

		?>
	<div>
		<form method="POST" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>">
			<h1>Login</h1>
			User Name: <input type="text" name="userName"> <br>

			<p>
			<?php 
				if(isset($_POST['userName'])) echo $erroName;
			?><br>
			</p>

			Password: <input type="password" name="password"> <br>

			<p>
			<?php 
				if(isset($_POST['password'])) echo $erroPass;
			?><br>
			</p>

			<input type="submit" name="Login" value="Sign in" class="submit">
			<input type="submit" name="Reset" value="Reset" class="submit">
		</form>
	</div>
</body>
</html>