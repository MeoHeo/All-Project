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
						$insert_tenphim = $_POST['tenphim'];
						$insert_quocgia = $_POST['quocgia'];
						$insert_theloai = $_POST['theloai'];
						$insert_ngonngu = $_POST['ngonngu'];
						$insert_namphathanh = $_POST['namphathanh'];
						$insert_linkphim = $_POST['linkphim'];
						$insert_thongtinphim = $_POST['thongtinphim'];
						$insert_image = $_POST['image'];

						$sql = "INSERT INTO phimchieurap(Phimchieurap_id, Tenphim, Quocgia, Thongtinphim, Ngaycapnhat, Theloai, Namphathanh,Ngonngu,Image,Link) VALUES (Phimchieurap_id,'$insert_tenphim','$insert_quocgia','$insert_thongtinphim','2016-11-30','$insert_theloai','$insert_namphathanh','$insert_ngonngu','$insert_image','$insert_linkphim')";
						if ($conn->query($sql)) {
							echo "<script>window.open('filmchieurap.php','_self')</script>";
						}
					}
				?>
				<form style="width: 60%;margin-left: auto;margin-right: auto;" class="form-horizontal" method="post" action="insertfilmchieurap.php" enctype="multipart/form-data">
						<div style="text-align: center;padding: 20px 0 30px;font-weight: bold;font-size: 2em">
							Thông tin phim
						</div>
						<div class="form-group">
						    <label>Tên phim:</label>
						    <div>
						      <input type="text" class="form-control" name="tenphim" required>
						    </div>
						</div>
						<div class="form-group">
						    <label>Quốc gia</label>
			              	 <select class="form-control" name="quocgia">
			                    <option value=1>Việt Nam</option>
			                    <option value=2>Hông Kông</option>
			                    <option value=3>Mỹ</option>
			                    <option value=4>Đài Loan</option>
			                    <option value=5>Hàn Quốc</option>
			                    <option value=6>Nhật Bản</option>
			                    <option value=7>Ấn Độ</option>
			                    <option value=8>Thái Lan</option>
			                    <option value=9>Nước khác</option>
			               	 </select>
						</div>
						<div class="form-group">
						    <label>Thể loại</label>
			              	 <select class="form-control" name="theloai">
			                    <option value=1>Phim hành động</option>
			                    <option value=2>Phim viễn tưởng</option>
			                    <option value=3>Phim võ thuật</option>
			                    <option value=4>Phim tâm lý</option>
			                    <option value=5>Phim tài liệu</option>
			                    <option value=6>Phim cổ trang</option>
			                    <option value=7>Phim kinh dị</option>
			                    <option value=8>Phim hoạt hình</option>
			                    <option value=9>Phim hài hước</option>
			                    <option value=10>Phim tình cảm-lãng mạn</option>              
			              	 </select>
						</div>
						<div class="form-group">
						      <label>Ngôn ngữ</label>
				               <select class="form-control" name="ngonngu">
				                    <option value=1>Tiếng việt</option>
				                    <option value=2>Lồng tiếng</option>
				                    <option value=3>Thuyết minh</option>
				                    <option value=4>ViệtSub</option>
				               </select>
						</div>
						<div class="form-group">
						    <label>Năm phát hành</label>
						    <div>
						      <input type="number" class="form-control" name="namphathanh" required>
						    </div>
						</div>
						<div class="form-group">
						    <label>Chọn poster phim</label>
						    <div>
						      <input type="text" class="form-control" name="image" required>
						    </div>
						</div>
						<div class="form-group">
						    <label>Đường dẫn phim</label>
						    <div>
						      <input type="text" class="form-control" name="linkphim" required>
						    </div>
						</div>
						<div>
							<textarea class="form-group" name="thongtinphim" cols="95" rows="8">
							</textarea>
						</div>
						<div class="form-group" style="text-align: center;">
							<button type="submit" class="btn btn-success" name="insert">Thêm phim</button>
							<button type="reset" class="btn btn-danger" name="reset">Reset</button>
						</div>
					</form>
			</div>
		</div>
	</div>
<script src="../public/javascript/adminjs.js"></script>
</body>
</html>