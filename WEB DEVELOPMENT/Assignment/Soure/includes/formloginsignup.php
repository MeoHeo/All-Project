
<div class="modal fade" id="modal-signup" role="dialog">
 		    <div class="modal-dialog">    
   		   <!-- Modal content-->
  		  	    <div class="modal-content">
    	  		     <div class="modal-header">
      		   			 <button type="button" class="close" data-dismiss="modal">&times;</button>
       		  			 <h4 class="modal-title">Đăng ký</h4>
       		  		 </div>
       		 	    <form class="form-horizontal modal-body" method="post" action="<?php echo $_SERVER['REQUEST_URI']; ?>">
                        <div class="form-group">
                           <label class="control-label col-sm-4" for="user">Tài khoản:</label>
                                <div class="col-sm-8">
                                    <input type="text" class="form-control" name="signup_username" required>
                                </div>
                        </div>
                        <div style="color: red;font-style: italic;text-align: center;"><?php echo $err_username; ?></div>
                        <div class="form-group">
                             <label class="control-label col-sm-4" for="pwd">Mật khẩu:</label>
                                 <div class="col-sm-8">
                                    <input type="password" class="form-control" name="signup_password" required>
                                 </div>
                        </div>
                         <div class="form-group">
                             <label class="control-label col-sm-4" for="repwd">Xác nhận mật khẩu:</label>
                                 <div class="col-sm-8">
                                    <input type="password" class="form-control" name="signup_repassword" required>
                                 </div>
                        </div>
                        <div style="color: red;font-style: italic;text-align: center;"><?php echo $err_password; ?></div>
                         <div class="form-group">
                             <label class="control-label col-sm-4" for="name">Họ tên:</label>
                                 <div class="col-sm-8">
                                    <input type="text" class="form-control" name="signup_name" required>
                                 </div>
                        </div>
                        <div class="form-group">
                           <label class="control-label col-sm-4" for="email">Email:</label>
                                <div class="col-sm-8">
                                    <input type="email" class="form-control" name="signup_email" required>
                                </div>
                        </div>
                        <div style="color: red;font-style: italic;text-align: center;"><?php echo $err_email; ?></div>
                        <div class="form-group">
                           <label class="control-label col-sm-4" for="phone">Số điện thoại:</label>
                                <div class="col-sm-8"> 
                                    <input type="number" class="form-control" name="signup_phone" required>
                                </div>
                        </div>
                        <div class="form-group">
                             <div class="col-sm-offset-4 col-sm-8">
                                  <button type="submit" class="btn btn-default">Đăng ký</button>
                             </div>
                        </div>
                    </form>
       	     	    <div class="modal-footer">
        	 			 <button type="button" class="btn btn-default" data-dismiss="modal">Đóng</button>
       		  		 </div>
        		</div>
      		</div>
        </div> 
<div class="modal fade" id="modal-login" role="dialog">
 		    <div class="modal-dialog">  
   		   <!-- Modal content-->
  		  	    <div class="modal-content">
    	  		     <div class="modal-header">
      		   			 <button type="button" class="close" data-dismiss="modal">&times;</button>
       		  			 <h4 class="modal-title">Đăng nhập</h4>
       		  		 </div>
       		 	    <form class="form-horizontal modal-body" method="post" action="<?php echo $_SERVER['REQUEST_URI']; ?>">
                        <div class="form-group">
                           <label class="control-label col-sm-3">Tên tài khoản:</label>
                                <div class="col-sm-9">
                                    <input value="" type="text" class="form-control" name="login_username" placeholder="Nhập tên tài khoản">
                                </div>
                        </div>
                        <div class="form-group">
                             <label class="control-label col-sm-3">Mật khẩu:</label>
                                 <div class="col-sm-9">
                                    <input value="" type="password" class="form-control" name="login_password" placeholder="Nhập mật khẩu truy cập">
                                 </div>
                        </div>
                        <div id="err-login" style="color: red;font-style: italic;text-align: center;"><?php echo $errlogin; ?></div>
                        <div class="form-group">
                            <div class="col-sm-offset-3 col-sm-9">
                                 <div class="checkbox">
                                     <label><input type="checkbox">Ghi nhớ</label>
                                 </div>
                            </div>
                        </div>
                        <div class="form-group">
                             <div class="col-sm-offset-3 col-sm-9">
                                  <button type="submit" class="btn btn-default">Đăng nhập</button>
                             </div>
                        </div>
                        <div class="form-group">
                            <a href="#" class="col-sm-offset-3 col-sm-9">Quên mật khẩu</a>
                        </div>
                    </form>
       	     	    <div class="modal-footer">
        	 			 <button type="button" class="btn btn-default" data-dismiss="modal">Đóng</button>
       		  		 </div>
        		</div>
      		</div>
        </div> 
        <?php 
          if (isset($modalreshow)){
            echo $modalreshow;
          }
          $errlogin = "";
        ?>
        