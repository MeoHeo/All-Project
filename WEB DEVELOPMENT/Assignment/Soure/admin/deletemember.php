<?php 
	include("connectdatabase.php"); 

	if(isset($_GET['del'])){

		$delete_id = $_GET['del'];
		
		$sql = "DELETE FROM user WHERE User_id = '$delete_id' ";
		
		if ($conn->query($sql)) {
			header('Location: member.php');
		}
	}
?>