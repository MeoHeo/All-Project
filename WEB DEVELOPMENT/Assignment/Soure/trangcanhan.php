<?php
  include './includes/session.php';
 ?> 

<!DOCTYPE html>
<html lang="zxx">
    <meta charset="UTF-8" name="viewport" content="width=device-width, initial-scale=1">
    <title>Phim mới nhất | phim hành động | phim bộ | phim lẻ </title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.6.3/css/font-awesome.min.css">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
    <link rel="stylesheet" type="text/css" href="style.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script>
    <script src="javascript.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
</head>
<body>
    <div class="container-fluid">
    <?php include './includes/header.php'; ?>
    <?php include './includes/nav.html'; ?>
    <?php include './includes/formloginsignup.php'; ?>  
        <div class="row">
            <div class="col-lg-8">
                <section class="phim-moi-nhat" style="padding-left:30px;">
                    <div class="content">
                        <?php 
                            if (isset($_GET['userid'])) {
                                $userid = $_GET['userid'];
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
                                $sql = "SELECT * FROM user WHERE username = '$username_loggedin'";

                                $result = $conn->query($sql);
                                $row = $result->fetch_assoc();
                                $avatar = $row['Avatar'];
                                $name = $row['Username'];
                                $userid = $row['User_id'];
                                $full_name = $row['Name'];
                                $email = $row['Email'];
                                $phone = $row['Phone'];
                                $pass = $row['Password'];
                                echo "<br>";
                                echo "<form action='update_user_info.php?userid=$userid' method='post'>";
                                echo "<table class='table' style='width:100%''>
                                          <tr class='info'>
                                            <th>Mã người dùng </th>
                                            <td name='userid'>$userid</td>
                                          </tr>
                                          <tr>
                                            <th> <br><br>Ảnh đại diên</th>
                                            <td>
                                                <img src='./libraries/avatars/$avatar' class='img-circle' alt='Cinque Terre' width='100' height='100'> 
                                                 <input name='avatar' type='file'>
                                                

                                            </td>
                                          </tr>
                                          <tr class='info'>
                                            <th>Tên đăng nhập</th>
                                            <td><input class='form-control' type='text' name='name_input' value='$name'></td>
                                          </tr>
                                          <tr>
                                            <th>Tên người dùng</th>
                                            <td><input class='form-control' type='text' name='full_name_input' value='$full_name'></td>
                                          </tr>
                                          <tr class='info'>
                                            <th>Mật khẩu hiện tại</th>
                                            <td><input class='form-control' type='password' name='pass_input' value=''></td>
                                          </tr>
                                          <tr>
                                            <th>Mật khẩu mới</th>
                                            <td><input class='form-control' type='password' name='pass_input' value=''></td>
                                          </tr>
                                          <tr class='info'>
                                            <th>Nhập lại mật khẩu mới</th>
                                            <td><input class='form-control' type='password' name='pass_input' value=''></td>
                                          </tr>
                                          <tr>
                                            <th>Email</th>
                                            <td><input class='form-control' type='text' name='full_email_input' value='$email'></td>
                                          </tr>
                                          <tr class='info'>
                                            <th>Số điện thoại</th>
                                            <td><input class='form-control' type='text' name='full_phone_input' value='$phone'></td>
                                          </tr>
                                      </table>
                                      <input class='btn btn-warning' type='submit' name='update' value='Submit' style='float:right'>";
                                echo "</form>";
                                echo "<br>";
                                echo "<br>";
                                $conn->close();
                            }
                        ?>
                    </div>
                </section>
            </div>
        </div>
        <?php include './includes/footer.html';?>
    </div>
</body>
</html>
