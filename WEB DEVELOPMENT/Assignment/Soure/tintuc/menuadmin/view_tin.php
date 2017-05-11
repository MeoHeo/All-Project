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
				$conn = mysql_connect("localhost","root","");
				$db = mysql_select_db('tintuc',$conn);
				mysql_set_charset('utf8',$conn);

				$query = "select * from tinphim order by 1 DESC"; 

				$run = mysql_query($query);

				while($row=mysql_fetch_array($run)){

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
						<td><img src="hinhnews/<?php echo $post_image; ?>" width="100" height="100"></td>
						<td><?php echo $post_content; ?></td>
						<td><a href="xoatin.php?del=<?php echo $post_id; ?>" onclick="return confirm('Bạn chắc chắn muốn xóa?');">Delete</a></td>
						<td><a href="edit_tin.php?edit=<?php echo $post_id; ?>">Edit</a></td>
					</tr>
				<?php } ?>

				</table>

				<?php  ?>
								
			</div>
			<div style="clear: both;"></div>
		</div>
		<?php include "footer.html"; ?>
	</div>
</body>
</html>