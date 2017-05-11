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
			<table width="1000" border="1" align="center" > 
					<tr>
						<td colspan="10" align="center" ><h1>Quản lý tin tức</h1></td>
					</tr>
					
					<tr>
						<th>STT</th>
						<th>Ngày Đăng</th>
						<th>Tác giả</th>
						<th>Tựa đề</th>
						<th>Image</th>
						<th>Nội dung</th>
						<th>Xóa tin</th>
						<th>Sửa tin</th>
					</tr>
				<?php 

				$servername = "localhost";
						$username = "root";
						$password = "";
						$dbname = "phim";
						$conn = new mysqli($servername, $username, $password, $dbname);
						mysqli_set_charset($conn,'utf8');

						$query = "select * from tinphim order by 1 DESC"; 

						$run = $conn->query($query);

						while($row = $run->fetch_assoc()){

						$post_id = $row['id_phim']; 
						$post_title = $row['tin_title'];
						$post_date = $row['tin_ngay'];
						$post_author = $row['tin_tacgia'];
						$post_image = $row['tin_image'];
						$post_content= substr($row['tin_noidung'],0,200);
				?>
				<tr align="center">
						<td><?php echo $post_id; ?></td>
						<td><?php echo $post_date; ?></td>
						<td><?php echo $post_author; ?></td>
						<td><?php echo $post_title; ?></td>
						<td><img src="../libraries/hinhnews/<?php echo $post_image; ?>" width="100" height="100"></td>
						<td><?php echo $post_content; ?></td>
						<td><a href="xoatin.php?del=<?php echo $post_id; ?>" onclick="return confirm('Bạn chắc chắn muốn xóa?');">Delete</a></td>
						<td><a href="edit_tin.php?edit=<?php echo $post_id; ?>">Edit</a></td>
					</tr>
				<?php } ?>

				</table>

				<?php  ?>
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