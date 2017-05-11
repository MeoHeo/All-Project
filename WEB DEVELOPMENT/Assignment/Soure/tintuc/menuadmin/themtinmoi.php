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
				
				<form method="post" action="themtinmoi.php" enctype="multipart/form-data">
				
				<table width="800" align="center" border="1">
					
					<tr>
						<td align="center" colspan="6"><h1>Thêm tin mới</h1></td>
					</tr>
					
					<tr>
						<td align="right">Tựa đề:</td>
						<td><input type="text" name="title" size="100"></td>
					</tr>
					
					<tr>
						<td align="right">Tác giả:</td>
						<td><input type="text" name="tacgia" size="100"></td>
					</tr>

					<tr>
						<td align="right">Ảnh:</td>
						<td><input type="file" name="image"></td>
					</tr>
					
					<tr>
						<td align="right">Nội dung:</td>
						<td><textarea name="noidung" cols="101" rows="15"></textarea></td>
					</tr>
					
					<tr>
						<td align="center" colspan="6"><input type="submit" name="submit" value="Đăng tin"></td>
					</tr>

				
				</table>
			</form>
			<?php 
			$conn = mysql_connect("localhost","root","");
			$db = mysql_select_db('tintuc',$conn);
			mysql_set_charset('utf8',$conn);
			if(isset($_POST['submit'])){

				  $post_title = $_POST['title'];
				  $post_date = date('d-m-y');
				  $post_author = $_POST['tacgia'];
				  $post_content = $_POST['noidung'];
				  $post_image= $_FILES['image']['name'];
				  $image_tmp= $_FILES['image']['tmp_name'];
				
				if($post_title=='' or $post_author=='' or $post_content=='' ){
				
				echo "<script>alert('Vui lòng điền đầy đủ')</script>";
				exit();
				}

				else {
				
				move_uploaded_file($image_tmp,"hinhnews/$post_image");
				
				$insert_query = "insert into tinphim (tin_title,tin_ngay,tin_tacgia,tin_noidung,tin_image) values ('$post_title','$post_date','$post_author','$post_content','$post_image')";
				
				if(mysql_query($insert_query)){
				
				echo "<script>alert('Đăng tin thành công')</script>";
				echo "<script>window.open('view_tin.php','_self')</script>";
				
				}

			}

			}

			?>

			<?php ?>
				
			</div>
			<div style="clear: both;"></div>
		</div>
		<?php include "footer.html"; ?>
	</div>
</body>
</html>