<!DOCTYPE html>
<html lang="en">
<head>
	<title>Lab06_Bai06</title>
	<meta charset="utf-8" >
	<link rel="stylesheet" type="text/css" href = "style.css"/>	
</head>

<body>
	<!-- ===========================PHP======================= -->
	<?php
		$firstName = $lastName = $email = $pwd = $bday = $gender = $country = $about = "";
		$count = 0;

		$errofirstName = $errolastName = $erroemail = $erropwd = $errobday = $errogender = $errocountry = $erroabout = "";
		//============================================
		 if(empty($_POST['firstName'])) {
		 	$errofirstName = "First name is required";
		 	$count++;
		 }
		 else {
		 	$firstName = test_input ($_POST['firstName']);
		 	if(strlen($firstName) < 2 || strlen($firstName) > 30) {
		 		$errofirstName= "First name must be from 2 to 30 characters.";
		 		$count++;
		 	}
		 }
		 //============================================
		 if(empty($_POST['lastName'])) {
		 	$errolastName= "Last name is required";
		 	$count++;
		 }
		 else {
		 	$lastName = test_input ($_POST['lastName']);
		 	if(strlen($lastName) < 2 || strlen($lastName) > 30) {
		 		$errolastName= "Last name must be from 2 to 30 characters.";
		 		$count++;
		 	}
		 }
		 //============================================
		 if(empty($_POST['email'])) {
		 	$erroemail= "email is required";
		 	$count++;
		 }
		 else {
		 	$email = test_input ($_POST['email']);
		 	if(!preg_match("/.+@.+[.].+/", $email)) {
		 		$erroemail= "Invalid email";
		 		$count++;
		 	}
		 }
		 //============================================
		 if(empty($_POST['pwd'])) {
		 	$erropwd= "Password is required";
		 	$count++;
		 }
		 else {
		 	$pwd = test_input($_POST['pwd']);
		 	if(strlen($pwd) < 2 || strlen($pwd) > 30) {
		 		$erropwd= "Password must be from 2 to 30 characters.";
		 		$count++;
		 	}
		 }
		 //============================================
		 if(empty($_POST['birthday'])) {
			$errobday = "Birthday is require";
		}
		//============================================
		 if(empty($_POST['about'])) {
		 	$erroabout= "About is required";
		 	$count++;
		 }
		 else {
		 	$about = test_input($_POST['about']);
		 	if (strlen($about) > 1000) {
		 		$erroabout= "The length of character is over 1000.";
		 		$count++;
		 	}
		 }
		 //============================================
		 if ($count == 0) {
		 	echo "<script>alert('Complete!')</script>";
		 }
		 //============================================
		 function test_input ($data) {
			$data = trim($data) ;
			$data = stripslashes($data);
			$data = htmlspecialchars($data);
			return $data;
		}
	?>
	<!-- ===========================Create Form======================= -->
	<h1>Member Register</h1>
	<form method="POST" onclick="test_input();" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>">
		First name: <br>
		<input type="text" name="firstName">*
		<?php 
			if (isset($_POST['firstName'])) echo $errofirstName;
		?>
		<br>
		
		Last name: <br>
		<input type="text" name="lastName">*
		<?php 
			if (isset($_POST['lastName'])) echo $errolastName;
		?>
		<br>

		Email:<br>
		<input type="email" name="email">*
		<?php 
			if (isset($_POST['email'])) echo $erroemail;
		?>
		<br>
		
		Password:<br>
  		<input type="password" name="pwd">*
  		<?php 
			if (isset($_POST['pwd'])) echo $erropwd;
		?>
  		<br>

  		Birthday:<br>
  		<input type="date" name="bday">*
  		<?php 
			if (isset($_POST['bday'])) echo $errobday;
		?>  		
  		<br>
  		<!-- ===========================gender======================= -->
  		Gender:<br>
  		<input type="radio" name="gender" value="male" checked> Male<br>
  		<input type="radio" name="gender" value="female"> Female<br>
  		<input type="radio" name="gender" value="other"> Other<br>
  		<?php 
			if (isset($_POST['gender'])) echo $errogender;
		?>
  		<!-- ===========================country======================= -->
  		Country:<br>
  		<select name="country">
		  <option value="Vietnam">Vietnam</option>
		  <option value="Australia">Australia</option>
		  <option value="United States,">United States,</option>
		  <option value="India">India</option>
		  <option value="Other">Other</option>
		</select>
		<?php 
			if (isset($_POST['country'])) echo $errocountry;
		?>
		<br>
		<!-- ===========================About======================= -->
		About:<br>
		<input type="textarea" name="about">*
		<?php 
			if (isset($_POST['about'])) echo $erroabout;
		?>
		<br>

		<input type="submit" name="submit" value="Submit">
		<input type="reset" name="reset" value="Reset">
	</form>
	
</body>
</html>

