       <header>
			<div class="header">
				<div class="header-logo col-xs-2" style="text-align: center;">
					<a class="logo" href="./index.php" title="Xem phim mới nhất tại BKPHIM.NET" style="text-decoration: none;">
						<span><span style="font-size: 1.8em">BKPHIM</span>.NET</span>
					</a>
				</div>
				<div class="header-search col-xs-7">
					<form action="./danhsachphim.php" method="get">
						<div class="form-group form-inline" style="margin-left: 10%;">
							<input type="text" class="form-control" name="search" placeholder="Nhập tên phim">
							<button type="submit" class="btn btn-info ">
						      <span class="glyphicon glyphicon-search"></span>
						    </button>
						</div>
					</form>
				</div>
				<div class="header-user col-xs-3">
					<ul id="not-login">
      					<li style="color: blue; cursor: pointer;" id="sign-up"><span class="glyphicon glyphicon-user"></span> Sign Up</li>
     					 <li style="color: blue; cursor: pointer;" id="log-in"><span class="glyphicon glyphicon-log-in"></span> Log in</li>
    				</ul>
    				<div style="display: none; float: right;" id="loggedin"><a id= 'trangcanhan' href="#"><span id="avatar"><img src="" class="img-circle" alt="Cinque Terre" width="50" height="50"><span id="name"></span></span></a><a id="log-out" style="padding-left: 15px" href="./logout.php"><span>Log out</span></a></div>
				</div>
			</div>
		</header>
		<div style="clear: both;"></div>
		<?php 
			if (isset($_SESSION['loggedin'])) {
				if ($_SESSION['loggedin'] == true) {
					$username_loggedin = $_SESSION['username'];
					$servername = "localhost";
				      $username = "root";
				      $password = "";
				      $dbname = "phim";

				      // Create connection
				      $conn = new mysqli($servername, $username, $password, $dbname);
				      mysqli_set_charset($conn,'utf8');

				      // Check connection
				      if ($conn->connect_error) {
				          die("Connection failed: " . $conn->connect_error);
				      } 
				      $sql_login = "SELECT * FROM user WHERE username = '$username_loggedin'";

				      $result_login = $conn->query($sql_login);
				      $row_login = $result_login->fetch_assoc();
       				  $avatar = $row_login['Avatar'];
       				  $name = $row_login['Name'];
       				  $userid = $row_login['User_id'];
		          	echo "<script type='text/javascript'> 
		                             $('#not-login').css('display', 'none');
		                             $('#loggedin').css('display', 'block'); 
		                             $('#loggedin img').attr('src', './libraries/avatars/$avatar');
		                             $('#loggedin span#name').text('$name');
		                             $('#loggedin a#trangcanhan').attr('href', './trangcanhan.php?userid=$userid');
		                              </script>";
		        }  
			}	
			else {
				echo "<script type='text/javascript'> 
		                             $('#not-login').css('display', 'block');
		                             $('#loggedin').css('display', 'none');
		                              </script>";
			}	
      ?>