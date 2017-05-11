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
				<?php 

					if (isset($_POST['insert'])) {
						include './connectdatabase.php';
						$insert_name = $_POST['name'];
						$insert_email = $_POST['email'];
						$insert_phone = $_POST['phone'];
						$insert_password = $_POST['password'];
						$insert_username = $_POST['username'];
						$insert_phone = $_POST['phone'];

						$sql = "INSERT INTO user(Username, Password, Name, Email, Phone, Avatar, Roleadmin) VALUES ('$insert_username','$insert_password','$insert_name','$insert_email','$insert_phone','avatar-defaut.jpg',0)";
						if ($conn->query($sql)) {
							header('Location: member.php');
						}
					}
				?>
				<form class="form-horizontal" method="post" action="insertmember.php">
						<div style="text-align: center;padding: 20px 0 30px;font-weight: bold;font-size: 2em">
							Hồ sơ thành viên
						</div>
						<div class="form-group">
						    <label class="control-label col-sm-3">Tên tài khoản:</label>
						    <div class="col-sm-6">
						      <input type="text" class="form-control" name="username"  required>
						    </div>
						</div>
						<div class="form-group">
						    <label class="control-label col-sm-3">Mật khẩu:</label>
						    <div class="col-sm-6">
						      <input type="password" class="form-control" name="password" required>
						    </div>
						</div>
						<div class="form-group">
						    <label class="control-label col-sm-3">Nhập lại mật khẩu:</label>
						    <div class="col-sm-6">
						      <input type="password" class="form-control" name="repassword" required>
						    </div>
						</div>
						<div class="form-group">
						    <label class="control-label col-sm-3">Họ và tên:</label>
						    <div class="col-sm-6">
						      <input type="text" class="form-control" name="name" required>
						    </div>
						</div>
						<div class="form-group">
						    <label class="control-label col-sm-3">Email:</label>
						    <div class="col-sm-6"> 
						      <input type="email" class="form-control" name="email"required>
						    </div>
						</div>
						<div class="form-group">
						    <label class="control-label col-sm-3">Số điện thoại:</label>
						    <div class="col-sm-6"> 
						      <input type="text" class="form-control" name="phone" required>
						    </div>
						</div>
						<div class="form-group" style="text-align: center;">
							<button type="submit" class="btn btn-success" name="insert">Tạo thành viên</button>
							<button type="reset" class="btn btn-danger" name="reset">Reset</button>
						</div>
				</form>
			</div>
		</div>
	</div>
<script src="../public/javascript/adminjs.js"></script>
</body>
</html>