<?php
    session_start();
    $errlogin = $err_username = $err_password = $err_email = "";
    if (isset($_POST['login_username']) && isset($_POST['login_password'])) {

        $servername = "localhost";
        $username = "root";
        $password = "";
        $dbname = "phim";

        $login_username = $_POST['login_username'];
        $login_password = $_POST['login_password'];
        if ($login_username == "" AND $login_password == "") {
            $errlogin = "Bạn vui lòng điền đầy đủ tên tài khoản và mật khẩu"; 
            $modalreshow = "<script type='text/javascript'> 
                               $('#modal-login').modal();     
                                </script>"; 
        }
        else {

            // Create connection
              $conn = new mysqli($servername, $username, $password, $dbname);
              mysqli_set_charset($conn,'utf8');

              // Check connection
              if ($conn->connect_error) {
                  die("Connection failed: " . $conn->connect_error);
              } 
              $sql_admin = "SELECT * FROM user WHERE username = '$login_username' AND password = '$login_password' AND roleadmin = 1 ";
              $sql = "SELECT * FROM user WHERE username = '$login_username' AND password = '$login_password'";
              $result_admin = $conn->query($sql_admin);
              $count_admin = $result_admin->num_rows;

              $result = $conn->query($sql);
              $count = $result->num_rows;
              if ($count_admin == 1) {
                 $_SESSION['admin'] = true;
                 $_SESSION['admin_name'] = $login_username;
                 header('Location:./admin/adminpage.php');
              }
              elseif ($count == 1) { 
                $_SESSION['loggedin'] = true;
                $_SESSION['username'] = $login_username;
              }
              else {
                $errlogin = "Tên tài khoản hoặc mật khẩu không đúng ";  
                $modalreshow = "<script type='text/javascript'> 
                               $('#modal-login').modal();     
                                </script>";
              }
             $conn->close();

          }
        
    }
    if (isset($_POST['signup_username'])) {
        $servername = "localhost";
        $username = "root";
        $password = "";
        $dbname = "phim";
        $err_username = $err_password = $err_email = "";
        $err_sum = 0;

        $signup_username = $_POST['signup_username'];
        $signup_password = $_POST['signup_password'];
        $signup_repassword = $_POST['signup_repassword'];
        $signup_name = $_POST['signup_name'];
        $signup_email = $_POST['signup_email'];
        $signup_phone = $_POST['signup_phone'];

        $conn = new mysqli($servername, $username, $password, $dbname);
        mysqli_set_charset($conn,'utf8');

        // Check connection
        if ($conn->connect_error) {
             die("Connection failed: " . $conn->connect_error);
        } 
        $sql_check_username = "SELECT * FROM user WHERE username = '$signup_username'";
        $sql_check_email = "SELECT * FROM user WHERE username = '$signup_email'";
        $result_check_username = $conn->query($sql_check_username);
        $result_check_email = $conn->query($sql_check_email);
        if ($result_check_username->num_rows == 1) {
            $err_username = "Tên tài khoản đã được sử dụng!";
            $err_sum =1;
        }
        if ($result_check_email->num_rows == 1) {
            $err_email = "Địa chỉ email đã được sử dụng!";
            $err_sum =1;
        }
        if ($signup_password != $signup_repassword) {
            $err_password = "Mật khẩu không khớp!";
            $err_sum =1;
        }
        if ($err_sum == 0) {
            $sql_insert_user = "INSERT INTO user(Username, Password, Name, Email, Phone,Avatar, Roleadmin) VALUES ('$signup_username','$signup_password','$signup_name','$signup_email','$signup_phone','avatar-defaut.jpg',0)";
            $conn->query($sql_insert_user);
            echo "<script type='text/javascript'> 
                               alert('Đăng kí thành công!');
                                </script>";
        }
        else {
            $modalreshow = "<script type='text/javascript'> 
                               $('#modal-signup').modal();     
                                </script>";
        }
        $conn->close();
    }
 ?>