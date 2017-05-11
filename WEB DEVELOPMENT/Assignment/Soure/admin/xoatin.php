<?php 
$servername = "localhost";
			$username = "root";
			$password = "";
			$dbname = "phim";
			$conn = new mysqli($servername, $username, $password, $dbname);
			mysqli_set_charset($conn,'utf8');

if(isset($_GET['del'])){

	$delete_id = $_GET['del'];
	
	$delete_query = "delete from tinphim where id_phim='$delete_id' ";
	
	
	if($conn->query($delete_query)){
	
	echo "<script>alert('Tin đã được xóa')</script>";
	echo "<script>window.open('view_tin.php','_self')</script>";
	
	}	

}

?>