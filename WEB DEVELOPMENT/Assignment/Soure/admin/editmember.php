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

					if (isset($_GET['edit'])) {
						include './connectdatabase.php';
						$edit_id = $_GET['edit'];

						$sql = "SELECT * FROM user WHERE user_id = $edit_id"; 

						$result = $conn->query($sql);

						while($row = $result->fetch_assoc()){
							$avatar = $row['Avatar'];
							$name = $row['Name'];
							$email = $row['Email'];
							$phone = $row['Phone'];
						}
					}
					else {
							$name = $email = $phone = "";
					}	
				?>
				<form class="form-horizontal" method="post" action="editmember.php?edit_form=<?php echo $edit_id; ?>" enctype="multipart/form-data">
						<div style="text-align: center;padding: 20px 0 30px">
							<img src="../libraries/avatars/<?php echo $avatar; ?>" width="150" height="150" class="img-circle">
						</div>
						<div class="form-group">
						    <label class="control-label col-sm-3">Họ và tên:</label>
						    <div class="col-sm-6">
						      <input type="text" class="form-control" name="name" value="<?php echo $name; ?>" required>
						    </div>
						</div>
						<div class="form-group">
						    <label class="control-label col-sm-3">Email:</label>
						    <div class="col-sm-6"> 
						      <input type="email" class="form-control" name="email" value="<?php echo $email; ?>" required>
						    </div>
						</div>
						<div class="form-group">
						    <label class="control-label col-sm-3">Số điện thoại:</label>
						    <div class="col-sm-6"> 
						      <input type="text" class="form-control" name="phone" value="<?php echo $phone; ?>" required>
						    </div>
						</div>
						<div class="form-group" style="text-align: center;">
							<button type="submit" class="btn btn-success" name="update">Cập nhật</button>
						</div>
				</form>
			</div>
		</div>
	</div>
<?php 
	if (isset($_POST['update'])) {
		$update_id = $_GET['edit_form'];
		$update_name = $_POST['name'];
		$update_email = $_POST['email'];
		$update_phone = $_POST['phone'];
		$sql = "UPDATE user SET Name = '$update_name', Email = '$update_email',Phone = '$update_phone' WHERE User_id = '$update_id'";
		include './connectdatabase.php';
		if ($conn->query($sql)) {
			header('Location: member.php');
		}

	}
?>
<script src="../public/javascript/adminjs.js"></script>
</body>
</html>