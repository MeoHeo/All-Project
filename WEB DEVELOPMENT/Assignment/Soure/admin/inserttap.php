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
	<script src="../public/javascript/adminjs.js"></script>
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
				<?php 

					if (isset($_POST['insert'])) {
						include './connectdatabase.php';
						$phim_id = $_GET['phim_id'];
						$insert_tap = $_POST['tap'];
						$insert_linkphim = $_POST['linkphim'];

						$sql = "INSERT INTO tapphim(Tap_id, Tap, Link) VALUES ('$phim_id','$insert_tap','$insert_linkphim')";
						if ($conn->query($sql)) {
							echo "<script>window.open('filmbo.php','_self')</script>";
						}
					}
					if (isset($_GET['insert'])) {
						include './connectdatabase.php';
						$phim_id = $_GET['insert'];
						$sql = "SELECT * FROM phimbo WHERE phimbo_id = $phim_id"; 

						$result = $conn->query($sql);

						while($row = $result->fetch_assoc()){
							$tenphim = $row['Tenphim'];
						}
					}
				?>
				<form style="width: 60%;margin-left: auto;margin-right: auto;" class="form-horizontal" method="post" action="inserttap.php?phim_id=<?php echo $phim_id; ?>" enctype="multipart/form-data">
						<div style="text-align: center;padding: 20px 0 30px;font-weight: bold;font-size: 2em">
							Thông tin phim
						</div>
						<div class="form-group">
						    <label>Tên phim:</label>
						    <div>
						      <input type="text" class="form-control" name="tenphim" required value="<?php echo $tenphim; ?>">
						    </div>
						</div>
						<div class="form-group">
						    <label>Tập:</label>
						    <div>
						      <input type="number" class="form-control" name="tap" required>
						    </div>
						</div>
						<div class="form-group">
						    <label>Đường dẫn phim</label>
						    <div>
						      <input type="text" class="form-control" name="linkphim" required>
						    </div>
						</div>
						<div class="form-group" style="text-align: center;">
							<button type="submit" class="btn btn-success" name="insert">Thêm tập mới</button>
							<button type="reset" class="btn btn-danger" name="reset">Reset</button>
						</div>
					</form>
			</div>
		</div>
	</div>
<script src="../public/javascript/adminjs.js"></script>
</body>
</html>