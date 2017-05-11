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
				<h3 style="text-align: center;">Chỉnh tin tức</h3>
				<!-- <div>
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
				</div> -->
				<?php 
					$conn = mysql_connect("localhost","root","");

					$db = mysql_select_db('tintuc',$conn);
					mysql_set_charset('utf8',$conn);

					if(isset($_GET['edit'])){
						
						$edit_id = $_GET['edit'];
						
						$edit_query = "select * from tinphim where id_phim='$edit_id'";
						
						$run_edit = mysql_query($edit_query); 
						
						while ($erow=mysql_fetch_array($run_edit)){
						

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
								<input type="file" name="image"> 
								<img src="hinhnews/<?php echo $post_image;?>" width="100" height="100"></td>
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
						  $image_tmp= $_FILES['image']['tmp_name'];
						
						if($post_title1=='' or $post_author1=='' or $post_content1==''){
						
						echo "<script>alert('Vui lòng nhập đủ thông tin')</script>";
						exit();
						}

						else {
						
						 move_uploaded_file($image_tmp,"hinhnews/$post_image1");
							
							$update_query = "update tinphim set tin_title='$post_title1',tin_ngay='$post_date1',tin_tacgia='$post_author1',tin_image='$post_image1',tin_noidung='$post_content1' where id_phim='$update_id'";
							
							if(mysql_query($update_query)){
							
							echo "<script>alert('Cập nhật thành công')</script>";
							
							echo "<script>window.open('view_tin.php','_self')</script>";
							
							}
						
						}
						}



					?>
			</div>
			<div style="clear: both;"></div>
		</div>
		<?php include "footer.html"; ?>
	</div>
</body>
</html>