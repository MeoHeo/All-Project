<?php
	session_start();
	if (!isset($_SESSION['admin'])) {
		header('Location:../index.php');
	}
	$name = $_SESSION['admin_name'];
	include 'connectdatabase.php';
	$sql = "SELECT Name,Avatar FROM user WHERE username = '$name'";
    $result = $conn->query($sql);
	$row = $result->fetch_assoc();
	$ten = $row['Name'];
	$avatar = $row['Avatar'];
 ?>
<!DOCTYPE html>
<html lang="zxx">
<head>
	<title>Adminstrator</title>
	<meta charset="UTF-8" name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.6.3/css/font-awesome.min.css">
	<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
	<link rel="stylesheet" type="text/css" href="../public/css/adminpage.css">
	<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script>
	<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
</head>
<body>
	<div class="container-fluid">
		<div class="row header">
			<div>Admin</div>
			<div style="float: right;"><a style="color: white" href="../logout.php"><span class="glyphicon glyphicon-log-out"></span></a><span style="margin-left: 20px" class="glyphicon glyphicon-cog"></span><span style="margin-left: 20px" class="glyphicon glyphicon-search"></span></div>
		</div>
		<div class="row body">
			<div class="menu col-sm-2" style="padding:0">
				<div class="row profile-admin">
					<div class="avatar-admin col-sm-4">
						<img src="../libraries/avatars/<?php echo $avatar;?>" width="50" height="50" class="img-circle">
					</div>
					<div class="info-admin col-sm-8">
						<p class="name-admin"><?php echo $ten;?></p>
						<p>Adminstrator</p>
					</div>
				</div>
				<ul class="menu-item">
					<a href="./adminpage.php"><li>
						<span class="glyphicon glyphicon-home"></span>
						<div>Trang chủ</div>
					</li></a>
					<a href="./member.php"><li>
						<span class="glyphicon glyphicon-user"></span>
						<div>Thành viên</div>
					</li></a>
					<li id="phim-item" style="cursor: pointer;">
						<span class="glyphicon glyphicon-film"></span>
						<div id="item-phim">Phim</div>
					</li>
					<div style="display: none;background-color: #cccccc" id="phim-item-hide">
						<a href="./filmle.php"><li>
						<div id="item-phim">Phim lẻ</div>
						</li></a>
						<a href="./filmbo.php"><li>
							<div id="item-phim">Phim bộ</div>
						</li></a>
						<a href="./filmchieurap.php"><li>
							<div id="item-phim">Phim chiếu rạp</div>
						</li></a>
					</div>	
					<a href="./view_tin.php"><li>
						<span class="glyphicon glyphicon-book"></span>
						<div>Tin tức</div>
					</li></a>
				</ul>
			</div>
			<div class="content col-sm-10">
			<h3 style="text-align: center;">Chỉnh tin tức</h3>
			
				<?php 
					$servername = "localhost";
						$username = "root";
						$password = "";
						$dbname = "phim";
						$conn = new mysqli($servername, $username, $password, $dbname);
						mysqli_set_charset($conn,'utf8');


					if(isset($_GET['edit'])){
						
						$edit_id = $_GET['edit'];
						
						$edit_query = "select * from tinphim where id_phim='$edit_id'";
						
						$run = $conn->query($edit_query);

						while($erow = $run->fetch_assoc()){
						

						$post_id = $erow['id_phim']; 
						$post_title = $erow['tin_title'];
						$post_date = $erow['tin_ngay'];
						$post_author = $erow['tin_tacgia'];
						$post_image = $erow['tin_image'];
						$post_content=$erow['tin_noidung'];
						}
					}
					?>

					<form method="post" action="edit_tin.php?edit_form=<?php echo $edit_id; ?>" enctype="multipart/form-data">
						
						<table width="800" align="center" border="1">
							
					
							<tr>
								<td align="right"><strong>Tiêu đề:</strong></td>
								<td><input type="text" name="title" size="100" value="<?php echo $post_title; ?>"></td>
							</tr>
							
							<tr>
								<td align="right">Tác giả:</td>
								<td><input type="text" name="author" size="100"value="<?php echo $post_author; ?>"></td>
							</tr>
							
							<tr>
								<td align="right">Ảnh:</td>
								<td>
								<input type='file' name='image'> 
								<img src='../libraries/hinhnews/<?php echo $post_image;?>' width='100' height='100'></td>
							</tr>
							
							<tr>
								<td align="right">Nội dung:</td>
								<td><textarea name="content" cols="101" rows="15"><?php echo $post_content; ?></textarea></td>
							</tr>
							
							<tr>
								<td align="center" colspan="6"><input type="submit" name="update" value="Đăng tin"></td>
							</tr>		
						</table>

					</form>
					<?php
						
						if(isset($_POST['update'])){
						
						$update_id = $_GET['edit_form'];
						$post_title1 = $_POST['title'];
						  $post_date1 = date('d-m-y');
						  $post_author1 = $_POST['author'];
						  $post_content1 = $_POST['content'];
						  $post_image1= $_FILES['image']['name'];
						  $image_tmp= $_FILES['image']['temp_name'];
						
						if($post_title1=='' or $post_author1=='' or $post_content1==''){
						
						echo "<script>alert('Vui lòng nhập đủ thông tin')</script>";
						exit();
						}

						else {
						
						 move_uploaded_file($image_tmp,"../libraries/hinhnews/$post_image1");
							
							$update_query = "update tinphim set tin_title='$post_title1',tin_ngay='$post_date1',tin_tacgia='$post_author1',tin_image='$post_image1',tin_noidung='$post_content1' where id_phim='$update_id'";
							
							if($conn->query($update_query)){
							
							/*echo "<script>alert('Cập nhật thành công')</script>";*/
							
							echo "<script>window.open('view_tin.php','_self')</script>";
							
							}
						
						}
						}



					?>
			</div>
		</div>
	</div>
<script type="text/javascript">
	$('doncument').ready(function(){
		$('#phim-item').click(function(){
			$('#phim-item-hide').slideToggle();
		});
	});
</script>
</body>
</html>