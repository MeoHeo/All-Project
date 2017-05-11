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
    <script src="../public/javascript/javascript.js"></script>
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

    <div class="container-fluid" style="height: 100px;">
    <?php include 'header.html'; ?>
    </div>


<div id="contain" class="container-fluid"  >

  <div class="col-sm-3 hidden-xs" > 
     <div id="nar1" class=" col-sm-3 navbar " style="margin-top: -35px;">
     
        <div id="catehead" >
          <h3 id="chuyenmuc" style="text-shadow: 0 0 3px #FF0000;">Chuyên mục</h3>
        </div>
        <div class="nav nav-sidebar ">
	      <div class="list-group">
		  <div><a id="lista1" class="list-group-item"  href="#"><i class="fa fa-home fa-fw" aria-hidden="true"></i>&nbsp; Tin tức Anime</a></div>
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

						$query = "select * from tinphim order by 1 DESC"; 

						$run = $conn->query($query);

						while($row = $run->fetch_assoc()){

						$post_id = $row['id_phim']; 
						$post_title = $row['tin_title'];
						$post_date = $row['tin_ngay'];
						$post_author = $row['tin_tacgia'];
						$post_image = $row['tin_image'];
						$post_content =mb_substr($row['tin_noidung'],0,150,"UTF-8");



					?>
					<?php if($post_title !=='') {?>
			   <div class="item_small " >
			    <div class="col-sm-5 " style="background-color: white; padding: 0; margin: 10px; display: block;">
			   
			          <div class="hovereffect">
							<img  src="menuadmin/hinhnews/<?php echo $post_image; ?>"  alt="">
			            <div class="overlay">
			           <h3><?php echo $post_title; ?></h3>
			           <a class="info" href="pages_tin.php?id=<?php echo $post_id; ?>">xem</a>
			        	</div>
			        	</div>
			          <div class="titlenews" ><a style="text-decoration:none; " href="#"><?php echo $post_title; ?></a></div>	
			          <div class="news">
			          	<p align="justify">
			          	<?php
			          		while(substr($post_content, -1) != " ") { $post_content = substr($post_content, 0, strlen($post_content)-1); } 
			          		$post_content= $post_content." ...";

			          	 	echo $post_content; ?>
			          		
			          	</p>
			          </div>
			          <p align="right"><a href="pages_tin.php?id=<?php echo $post_id; ?>">Xem tiếp</a></p>

				  </div>
					 
        </div> 
				<?php } }?> 
     
    


<!-- ///////////////////////////////// -->
	<!-- 	<div style="text-align:left; ">
		      <ul class="pagination">
		        <li><a href="#" style="border-radius:15px 0px 0px 15px"><i class="fa fa-angle-double-left" aria-hidden="true"></i></a></li>
		        <li><a href="#">1</a></li>
		        <li><a class="active" href="#">2</a></li>
		        <li><a href="#">3</a></li>
		        <li><a href="#" style="border-radius:0px 15px 15px 0px"><i class="fa fa-angle-double-right" aria-hidden="true"></i></a></li>
		      </ul>
		</div>  -->
<!-- <div style="clear:both"></div>  -->
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