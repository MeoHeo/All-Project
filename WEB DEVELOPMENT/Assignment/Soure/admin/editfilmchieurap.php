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

						$sql = "SELECT * FROM phimchieurap WHERE phimchieurap_id = $edit_id"; 

						$result = $conn->query($sql);

						while($row = $result->fetch_assoc()){
							$phim_id = $row['Phimchieurap_id'];
							$tenphim = $row['Tenphim'];
							$quocgia = $row['Quocgia'];
							$theloai = $row['Theloai'];
							$namphathanh = $row['Namphathanh'];
							$ngonngu = $row['Ngonngu'];
							$hinhanh = $row['Image'];
							$linkphim = $row['Link'];
							$thongtinphim = $row['Thongtinphim'];
						}
					}
					else {
							$tenphim=$quocgia=$theloai=$namphathanh=$ngonngu=$hinhanh=$thongtinphim=$linkphim= "";
					}	
				?>
				<div class="col-sm-5">
					<form style="width: 100%;margin-left: auto;margin-right: auto;padding-top: 10px" class="form-horizontal" method="post" action="editfilmchieurap.php?edit_form=<?php echo $edit_id; ?>" enctype="multipart/form-data">
						<div class="form-group">
						    <label>Tên phim:</label>
						    <div>
						      <input type="text" class="form-control" name="tenphim" value="<?php echo $tenphim; ?>" required>
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
						      <input type="number" class="form-control" name="namphathanh" required value="<?php echo $namphathanh; ?>">
						    </div>
						</div>
						<div class="form-group">
						    <label>Đường dẫn phim</label>
						    <div>
						      <input type="text" class="form-control" name="linkphim" required value="<?php echo $linkphim; ?>">
						    </div>
						</div>
						<div>
							<textarea class="form-group" name="thongtinphim" cols="75" rows="8">
								<?php echo $thongtinphim; ?>
							</textarea>
						</div>
						<div class="form-group" style="text-align: center;">
							<button type="submit" class="btn btn-success" name="update">Cập nhật</button>
						</div>
				</form>
				</div>
				<div class="col-sm-6">
					<div style="text-align: center;padding: 20px 0 30px">
							<img src="../libraries/posterfilms/<?php echo $hinhanh; ?>" width="400" height="500">
					</div>
				</div>
			</div>
		</div>
	</div>
<?php 
	if (isset($_POST['update'])) {
		$update_id = $_GET['edit_form'];
		$update_tenphim = $_POST['tenphim'];
		$update_quocgia = $_POST['quocgia'];
		$update_theloai = $_POST['theloai'];
		$update_ngonngu = $_POST['ngonngu'];
		$update_namphathanh = $_POST['namphathanh'];
		$update_linkphim = $_POST['linkphim'];
		$update_thongtinphim = $_POST['thongtinphim'];
		
		$sql = "UPDATE phimchieurap SET Tenphim = '$update_tenphim', Quocgia = $update_quocgia, Thongtinphim = '$update_thongtinphim',Theloai=$update_theloai,Namphathanh=$update_namphathanh,Ngonngu=$update_ngonngu,Link='$update_linkphim' WHERE Phimchieurap_id = '$update_id'";
		include './connectdatabase.php';
		if ($conn->query($sql)) {
			echo "<script>window.open('filmchieurap.php','_self')</script>";
		}
	}
?>
<script src="../public/javascript/adminjs.js"></script>
</body>
</html>