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
				<table class="table"> 
				    <div style="padding: 20px 10px">
				    	<a href="./insertfilmchieurap.php"><button class="btn btn-success"><span style="padding-right: 10px" class="glyphicon glyphicon-film"></span>Thêm phim chiếu rạp mới</button></a>
				    </div>				
					<tr>
						<th></th>
						<th>Tên phim</th>
						<th>Quốc gia</th>
						<th>Thể loại</th>
						<th>Năm phát hành</th>
						<th>Ngôn ngữ</th>
						<th></th>
						<th></th>
					</tr>
					<?php 
						$convert_theloai = array("","Phim hành động", "Phim viễn tưởng", "Phim võ thuật","Phim tâm lý", "Phim tài liệu", "Phim cổ trang","Phim kinh dị", "Phim hoạt hình", "Phim hài hước","Phim tình cảm-lãng mạn");
					    $convert_quocgia = array("","Việt Nam", "Hồng Kông", "Mỹ","Đài Loan", "Hàn Quốc", "Nhật Bản","Ấn Độ", "Thái Lan", "Nước khác");
					    $convert_ngonngu = array("","Tiếng việt", "Lồng tiếng", "Thuyết minh","ViệtSub");

							include './connectdatabase.php';
							$num_rec_per_page=5;
				            if (isset($_GET["page"])) { $page  = $_GET["page"]; } else { $page=1; }; 
				            $start_from = ($page-1) * $num_rec_per_page; 
							$sql = "SELECT * FROM phimchieurap ORDER BY 1 DESC" . " LIMIT $start_from, $num_rec_per_page"; 
							$result = $conn->query($sql);
							while($row = $result->fetch_assoc()){

							$phim_id = $row['Phimchieurap_id'];
							$tenphim = $row['Tenphim'];
							$quocgia = $row['Quocgia'];
							$theloai = $row['Theloai'];
							$namphathanh = $row['Namphathanh'];
							$ngonngu = $row['Ngonngu'];
							$hinhanh = $row['Image'];
					?>
							<tr>
								<td style="vertical-align: middle;"><img src="../libraries/posterfilms/<?php echo $hinhanh; ?>" width="50" height="50" class="img-circle"></td>
								<td style="vertical-align: middle;font-weight: bold;"><?php echo $tenphim; ?></td>
								<td style="vertical-align: middle;"><?php echo $convert_quocgia[$quocgia]; ?></td>
								<td style="vertical-align: middle;"><?php echo $convert_theloai[$theloai]; ?></td>
								<td style="vertical-align: middle;"><?php echo $namphathanh; ?></td>
								<td style="vertical-align: middle;"><?php echo $convert_ngonngu[$ngonngu]; ?></td>
							    <td style="vertical-align: middle;"><a title="Xóa phim" href="deletefilmchieurap.php?del=<?php echo $phim_id; ?>" onclick="return confirm('Bạn chắc chắn muốn xóa phim <?php echo $tenphim; ?>?');"><button type="button" class="btn btn-danger">
						          <span class="glyphicon glyphicon-remove-sign"></span>
						        </button></a></td>
								<td style="vertical-align: middle;"><a title="Chỉnh sửa phim" href="editfilmchieurap.php?edit=<?php echo $phim_id; ?>"><button type="button" class="btn btn-success">
						          <span class="glyphicon glyphicon-edit"></span>
						        </button></a></td>
							</tr>
					<?php }?>
					</table>
					<?php
						include './connectdatabase.php';
						$sql = "SELECT * FROM phimchieurap ORDER BY 1 DESC";
						$result = $conn->query($sql);
						$total_records = $result->num_rows;
						$total_pages = ceil($total_records / $num_rec_per_page); 
						echo "<br>";
                        echo "<ul class='pagination'>";

                        echo "<li><a href='./filmchieurap.php?".$_SERVER['QUERY_STRING']."&page=1'>".'<span class="glyphicon glyphicon-fast-backward"></span>'."</a></li> "; // Goto 1st page  

                        for ($i=1; $i<=$total_pages; $i++) { 
                            echo "<li><a href='./filmchieurap.php?".$_SERVER['QUERY_STRING']."&page=".$i."'>".$i."</a></li> "; 
                        }; 
                        echo "<li><a href='./filmchieurap.php?".$_SERVER['QUERY_STRING']."&page=$total_pages'>".'<span class="glyphicon glyphicon-fast-forward">'."</a></li> "; // Goto last page
                        echo "</ul>";
					?>
			</div>
		</div>
	</div>
<script src="../public/javascript/adminjs.js"></script>
</body>
</html>