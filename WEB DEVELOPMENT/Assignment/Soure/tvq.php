<?php
  include './includes/session.php';
 ?>
<!DOCTYPE html>
<html lang="en">
  <head>
    <title>Xem ti vi trực tuyến</title>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.6.3/css/font-awesome.min.css">
    <link rel="stylesheet" href="http://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script>
    <script src="http://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
    <link rel="stylesheet" type="text/css" href="./public/css/style_q.css"/>
    <script src="./public/javascript/javascript.js"></script>
    <link rel="stylesheet" type="text/css" href="style.css">
    
  </head>


  <body>
  <!-- ===============================header============================== -->
    

<!-- ===============================ND============================== -->
    <div class="container-fluid">
    	<!-- 
    	===============================ND============================== -->
    <?php include './includes/header.php'; ?>
    <?php include './includes/nav.html'; ?>
		<div style="clear: both;"></div>
    <?php include './includes/formloginsignup.php'; ?>

      	<div class="row cover">
      		<!-- ===============================col8============================== -->
        	<iframe id="ifYoutube" height="425px" width="100%" src="http://m.xemtvhd.com/vtv1.php" frameborder="1" allowfullscreen></iframe>
      	</div>
      	<!-- ===============================ND============================== -->
	    <h3>Danh sách kênh:</h3>
	    <!-- ===============================ND==============================-->
	    <div class="row">
	       	<ul class="chanel">
	       		<li><a href="##" title="Watch BBC One"><img onclick="document.getElementById('ifYoutube').setAttribute('src','http://m.xemtvhd.com/vtv1.php')" src="./libraries/chanels/vtv1.png" alt="Watch BBC One"></a></li>
	       		<li><a href="##" title="Watch BBC One"><img onclick="document.getElementById('ifYoutube').setAttribute('src','http://m.xemtvhd.com/vtv4.php')" src="./libraries/chanels/vtv4.png" alt="Watch BBC One"></a></li>
	       		<li><a href="##" title="Watch BBC One"><img onclick="document.getElementById('ifYoutube').setAttribute('src','http://m.xemtvhd.com/vtv5.php')" src="./libraries/chanels/vtv5.png" alt="Watch BBC One"></a></li>
	       		<li><a href="##" title="Watch BBC One"><img onclick="document.getElementById('ifYoutube').setAttribute('src','http://m.xemtvhd.com/vtv6.php')" src="./libraries/chanels/vtv6.png" alt="Watch BBC One"></a></li>
	       		<li><a href="##" title="Watch BBC One"><img onclick="document.getElementById('ifYoutube').setAttribute('src','http://m.xemtvhd.com/vtv9.php')" src="./libraries/chanels/vtv9.png" alt="Watch BBC One"></a></li>
	       	</ul>
	       	<div class="spacer"></div>
	       	<ul class="chanel">
	       		<li><a href="##" title="Watch BBC One"><img height="1000px" onclick="document.getElementById('ifYoutube').setAttribute('src','http://m.xemtvhd.com/vtc1.php')" src="./libraries/chanels/vtc1.png" alt="Watch BBC One"></a></li>
	       		<li><a href="##" title="Watch BBC One"><img onclick="document.getElementById('ifYoutube').setAttribute('src','http://m.xemtvhd.com/vtc2.php')" src="./libraries/chanels/vtc2.png" alt="Watch BBC One"></a></li>
	       		<li><a href="##" title="Watch BBC One"><img onclick="document.getElementById('ifYoutube').setAttribute('src','http://m.xemtvhd.com/vtc3.php')" src="./libraries/chanels/vtc3.png" alt="Watch BBC One"></a></li>
	       		<li><a href="##" title="Watch BBC One"><img onclick="document.getElementById('ifYoutube').setAttribute('src','http://m.xemtvhd.com/vtc4.php')" src="./libraries/chanels/vtc4.png" alt="Watch BBC One"></a></li>
	       		<li><a href="##" title="Watch BBC One"><img onclick="document.getElementById('ifYoutube').setAttribute('src','http://m.xemtvhd.com/vtc5.php')" src="./libraries/chanels/vtc5.png" alt="Watch BBC One"></a></li>
	       		<li><a href="##" title="Watch BBC One"><img onclick="document.getElementById('ifYoutube').setAttribute('src','http://m.xemtvhd.com/vtc6.php')" src="./libraries/chanels/vtc6.png" alt="Watch BBC One"></a></li>
	       		<li><a href="##" title="Watch BBC One"><img onclick="document.getElementById('ifYoutube').setAttribute('src','http://m.xemtvhd.com/vtc8.php')" src="./libraries/chanels/vtc8.png" alt="Watch BBC One"></a></li>
	       		<li><a href="##" title="Watch BBC One"><img onclick="document.getElementById('ifYoutube').setAttribute('src','http://m.xemtvhd.com/vtc9.php')" src="./libraries/chanels/vtc9.png" alt="Watch BBC One"></a></li>
	       		<li><a href="##" title="Watch BBC One"><img onclick="document.getElementById('ifYoutube').setAttribute('src','http://m.xemtvhd.com/vtc10.php')" src="./libraries/chanels/vtc10.png" alt="Watch BBC One"></a></li>
	       		<li><a href="##" title="Watch BBC One"><img onclick="document.getElementById('ifYoutube').setAttribute('src','http://m.xemtvhd.com/vtc11.php')" src="./libraries/chanels/vtc11.png" alt="Watch BBC One"></a></li>
	       		<li><a href="##" title="Watch BBC One"><img onclick="document.getElementById('ifYoutube').setAttribute('src','http://m.xemtvhd.com/vtc14.php')" src="./libraries/chanels/vtc14.png" alt="Watch BBC One"></a></li>
	       		<li><a href="##" title="Watch BBC One"><img onclick="document.getElementById('ifYoutube').setAttribute('src','http://m.xemtvhd.com/vtc16.php')" src="./libraries/chanels/vtc16.png" alt="Watch BBC One"></a></li>
	       	</ul>
	    </div>


	<!-- ===============================Footer==================================== -->
      <a id="back-to-top" href="#" class="btn btn-primary btn-lg back-to-top" role="button" data-toggle="tooltip" data-placement="left">
            <span class="glyphicon glyphicon-chevron-up"></span>
        </a>
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
</body>
</html>

