<?php 
$conn = mysql_connect("localhost","root","");

$db = mysql_select_db('tintuc',$conn);
mysql_set_charset('utf8',$conn);

if(isset($_GET['del'])){

	$delete_id = $_GET['del'];
	
	$delete_query = "delete from tinphim where id_phim='$delete_id' ";
	
	
	if(mysql_query($delete_query)){
	
	echo "<script>alert('Post Has been Deleted')</script>";
	echo "<script>window.open('view_tin.php','_self')</script>";
	
	}	

}

?>