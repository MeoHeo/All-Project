<!DOCTYPE html>
<html>
<head>
	<title>Admin panel</title>
	 <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.6.3/css/font-awesome.min.css">
	<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
	<link rel="stylesheet" type="text/css" href="header_admin_css.css">
	<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script>
	<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
	<script src="adminpagejs.js"></script>
</head>
<body>
	<div class="container-fluid">
		<?php include "header_admin.html"; ?>
		<div class="content">
			<?php include "menu_admin.html"; ?>	
			<div class="manage_member" style="width: 85%;float: left;padding: 10px 50px;">
				<h3 style="text-align: center;">Danh sách các thành viên</h3>
				<div>
					<form class="form-inline">
						<div class="form-group">
							<label>Tìm kiếm thành viên</label>
							<input type="text" class="form-control" placeholder="Nhập email, số điện thoại...">
							<button type="submit" class="btn">Tìm kiếm</button>
						</div>
						<div class="form-group" style="float: right;">
							<label >Sắp xếp theo</label>
							<select class="form-control">
								<option>Thứ tự anphabe</option>
								<option>Thời gian đăng ký</option>
							</select>
						</div>	
					</form>
				</div>
				
			</div>
			<div style="clear: both;"></div>
		</div>
		<?php include "footer.html"; ?>
	</div>
</body>
</html>