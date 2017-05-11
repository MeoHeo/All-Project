<?php  

	if(isset($_POST['update'])){
		$user_id = $_GET['userid'];
		include "./admin/connectdatabase.php";
		$update_username = $_POST['name_input'];
		$update_name = $_POST['full_name_input'];
		$update_email = $_POST['full_email_input'];
		$update_phone = $_POST['full_phone_input'];


		$sql = "UPDATE user SET Username = '$update_username', Avatar='user_trung2.jpg', Name = '$update_name', Email = '$update_email',Phone = '$update_phone' WHERE User_id = '$user_id'";
		
		if ($conn->query($sql)) {
			header('Location: ./trangcanhan.php?userid='.$user_id);
		}
	}
?>