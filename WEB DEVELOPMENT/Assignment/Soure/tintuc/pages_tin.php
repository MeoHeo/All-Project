<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<title>Tin Tức</title>
	<meta name="viewport" content="width=device-width, initial-scale=1">
  	<link href="stylenews/style.css" rel="stylesheet" type="text/css"> 
  	<link rel="stylesheet" href="bootstrap/css/bootstrap.min.css">
  	<link rel="stylesheet" href="font-awesome/css/font-awesome.min.css">
  	<link rel="stylesheet" href="https://lipis.github.io/bootstrap-social/">
  	<link rel="icon" type="image/png" href="hinhnews/movie-icon-27.png"/>
  	<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.0/jquery.min.js"></script> 
  	<script src="bootstrap/js/bootstrap.min.js"></script>
	<script>
	$(document).ready(function(){
     $(window).scroll(function () {
            if ($(this).scrollTop() > 50) {
                $('#back-to-top').fadeIn();
            } else {
                $('#back-to-top').fadeOut();
            }
        });
        $('#back-to-top').click(function () {
            $('#back-to-top').tooltip('hide');
            $('body,html').animate({
                scrollTop: 0
            }, 800);
            return false;
        });
        
        $('#back-to-top').tooltip('show');
});
	</script>
</head>
<body >
<!-- <nav class="navbar navbar-inverse navbar-fixed-top" style="height: 100px;background-color: white;"  > -->
          <div class="container-fluid" style="height: 100px;">
          <?php include 'header.html'; ?>

          </div>


<div id="contain" class="container-fluid"  >

  <div class="col-sm-3 hidden-xs" style="margin-top: -45px"> 
     <div id="nar1" class=" col-sm-3 navbar ">
     
        <div id="catehead" >
          <h3 id="chuyenmuc" style="text-shadow: 0 0 3px #FF0000;">Chuyên mục</h3>
        </div>
        <div class="nav nav-sidebar ">
	      <div class="list-group">
		  <div><a id="lista1" class="list-group-item"  href="ass2.php"><i class="fa fa-home fa-fw" aria-hidden="true"></i>&nbsp; Tin tức Anime</a></div>
		  <div><a id="lista2" class="list-group-item" href="#"><i class="fa fa-book fa-fw" aria-hidden="true"></i>&nbsp; Lịch chiếu rạp</a></div>
		  <div><a id="lista3" class="list-group-item" href="#"><i class="fa fa-pencil fa-fw" aria-hidden="true"></i>&nbsp; Tin truyền hình</a></div>
		  <div><a id="lista4" class="list-group-item" href="#"><i class="fa fa-cog fa-fw" aria-hidden="true"></i>&nbsp; Tin giải trí</a></div>
			</div>
	     </div>
			<div  >
          <h3 id="tinnoibat" style="text-shadow: 0 0 3px #7FFF00;">Tin nổi bật </h3>
        </div>
         <div class="hovereffect" style="margin:15px 0 0 0; max-height: 200px;">
            <img  src="hinhnews/small1.jpg"  alt="">
            <div class="overlay">
           <h3>Hội ngộ bất ngờ giữa One Piece và Dragon Ball Z</h3>
           <a class="info" href="#">Click</a>
        	</div>
          </div>
          <div class="hovereffect" style="margin:15px 0 0 0; max-height: 200px;">
            <img  src="hinhnews/small2.jpg"  alt="">
            <div class="overlay">
           <h3>quá khứ của Thiết Sát Long Nhân Gajeel Redfox</h3>
           <a class="info" href="#">Click</a>
        	</div>
          </div>
          <div class="hovereffect" style="margin:15px 0 0 0; max-height: 200px;">
            <img  src="hinhnews/small3.jpg"  alt="">
            <div class="overlay">
           <h3 style="font-size: 14px;">The Red Turle có giành chiến thắng giải Oscar năm nay?</h3>
           <a class="info" href="#">Click</a>
        	</div>
          </div>
          <div class="hovereffect" style="margin:15px 0 0 0; max-height: 200px;">
            <img  src="hinhnews/small4.jpg"  alt="">
            <div class="overlay">
           <h3>Vua Hải Tặc Gold D. Roger</h3>
           <a class="info" href="#">Click</a>
        	</div>
          </div>
      </div>
   </div>
  <div id="test" class="col-sm-1 visible-xs" > 
     <div id="nar2" class="navbar-fixed-top navbar-absolute ">
      <div id="category" class="col-sm-2" style="width: 10px;padding: 0;">
        <div class="nav nav-sidebar ">
	      <div class="list-group">
		  <a class="list-group-item" href="#" ><i class="fa fa-home fa-fw" aria-hidden="true" style="margin-left: -5px;"></i></a>
		  <a class="list-group-item" href="#"><i class="fa fa-book fa-fw" aria-hidden="true" style="margin-left: -5px;"></i></a>
		  <a class="list-group-item" href="#"><i class="fa fa-pencil fa-fw" aria-hidden="true" style="margin-left: -5px;"></i></a>
		  <a class="list-group-item" href="#"><i class="fa fa-cog fa-fw" aria-hidden="true" style="margin-left: -5px;"></i></a>
			</div>
	     </div>

      </div>
      </div>
  </div>
<!--   ///////////////////////////////// -->
  <div class="col-sm-9 " style="margin-top: -45px">
				<?php 
					$servername = "localhost";
						$username = "root";
						$password = "";
						$dbname = "phim";
						$conn = new mysqli($servername, $username, $password, $dbname);
						mysqli_set_charset($conn,'utf8');

					if(isset($_GET['id'])){

					$page_id = $_GET['id'];

					$select_query = "select * from tinphim where id_phim='$page_id'";

					$run = $conn->query($select_query);

						while($row = $run->fetch_assoc()){

						$post_id = $row['id_phim']; 
						$post_title = $row['tin_title'];
						$post_date = $row['tin_ngay'];
						$post_author = $row['tin_tacgia'];
						$post_image = $row['tin_image'];
						$post_content =$row['tin_noidung'];



				?>

				<div class="titlenews" style="text-align: center;">
				<?php echo $post_title; ?> <br />
				</div>
				<div>
				<div><p align="left" style="float: left;">Published on:&nbsp;&nbsp;<b><?php echo $post_date; ?></b></p></div>

				<div><p align="right" style="float: right;">Posted by:&nbsp;&nbsp;<b><?php echo $post_author; ?></b></p></div>
				<div style="clear: both;"></div>
				</div>
				<div>
				<center><img src="menuadmin/hinhnews/<?php echo $post_image; ?>" width="500" height="300" /></center></div>

				<p align="justify"><?php echo $post_content; ?></p>


				<?php } }?>
				</div>

<!-- //////////////////////////////////////////////  -->
	</div> 
	<div style="clear:both"></div>
	<footer>
          <ul class="list-inline feekback">
            <li><a><small>Trợ giúp</small></a></li>
            <li><a><small>Phản hồi</small></a></li>
            <li><a><small>Giới thiệu</small></a></li>
          </ul>
            <ul class="list-inline copyright">
                <li><a href="#">
                    <span class="fa-stack fa-lg icon-facebook">
                      <i class="fa fa-square fa-stack-2x"></i>
                      <i class="fa fa-facebook fa-stack-1x"></i>
                    </span>
                    </a></li>
                <li><a href="#">
                    <span class="fa-stack fa-lg icon-twitter">
                      <i class="fa fa-square fa-stack-2x"></i>
                      <i class="fa fa-twitter fa-stack-1x"></i>
                    </span>
                </a></li>
            </ul>
            <small>Copyright © 2016 BKPHIM.NET</small>            
        </footer>
</div>


<a id="back-to-top" href="#" class="btn btn-primary btn-lg back-to-top" role="button" data-toggle="tooltip" data-placement="left"><span class="glyphicon glyphicon-chevron-up"></span></a>

  </div>
</body>
</html>