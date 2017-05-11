<?php
  include './includes/session.php';
 ?> 

<!DOCTYPE html>
<html lang="zxx">
<head>
    <meta charset="UTF-8" name="viewport" content="width=device-width, initial-scale=1">
    <title>Phim mới nhất | phim hành động | phim bộ | phim lẻ </title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.6.3/css/font-awesome.min.css">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
    <link rel="stylesheet" type="text/css" href="./public/css/styles.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script>
    <script src="./public/javascript/javascript.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
</head>
<body>
    <div class="container-fluid">
    <?php include './includes/header.php'; ?>
    <?php include './includes/nav.html'; ?>
    <?php include './includes/formloginsignup.php'; ?>  
        <div class="phim-de-cu" style="padding: 0 30px;">
            <div id="myCarousel" class="carousel slide" data-ride="carousel">
                <!-- Indicators -->
                <ol class="carousel-indicators">
                     <li data-target="#myCarousel" data-slide-to="0" class="active"></li>
                     <li data-target="#myCarousel" data-slide-to="1"></li>
                     <li data-target="#myCarousel" data-slide-to="2"></li>
                     <li data-target="#myCarousel" data-slide-to="3"></li>
                </ol>
                <!-- Wrapper for slides -->
                <div class="carousel-inner" role="listbox">
                    <div class="item active">
                         <img src="./libraries/posterfilms/anhdecu1.jpg" alt="Chania" width="300" height="175">
                    </div>

                    <div class="item">
                         <img src="./libraries/posterfilms/anhdecu2.jpg" alt="Chania" width="300" height="175">
                    </div>
                
                    <div class="item">
                         <img src="./libraries/posterfilms/anhdecu3.jpg" alt="Flower" width="300" height="175">
                    </div>

                    <div class="item">
                         <img src="./libraries/posterfilms/anhdecu4.jpg" alt="Flower" width="300" height="175">
                    </div>
                </div>

                <!-- Left and right controls -->
                <a class="left carousel-control" href="#myCarousel" role="button" data-slide="prev">
                     <span class="glyphicon glyphicon-chevron-left" aria-hidden="true"></span>
                     <span class="sr-only">Previous</span>
                </a>
                <a class="right carousel-control" href="#myCarousel" role="button" data-slide="next">
                     <span class="glyphicon glyphicon-chevron-right" aria-hidden="true"></span>
                     <span class="sr-only">Next</span>
                </a>
            </div>
        </div>
        <div class="tim-kiem-nang-cao" style="padding: 30px 30px 10px;">
            <?php include './includes/searchadvandbar.html'; ?>
        </div>      
        <div class="row">
            <div class="col-lg-8">
                <section class="phim-moi-nhat" style="padding-left:30px;">
                    <div class="title">
                        <a href="./danhsachphim.php?namphathanh=2016"><h2 style="display: inline-block;color: red">MỚI NHẤT</h2></a>
                    </div>
                    <div class="content">
                        <?php 
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
                            $sql = "SELECT * FROM phimchieurap ORDER BY ngaycapnhat DESC LIMIT 12";

                            $result = $conn->query($sql);
                            if ($result->num_rows > 0) {
                                while($row = $result->fetch_assoc()) {
                                    $ten_phim = $row["Tenphim"];
                                    $hinh_anh = $row["Image"];
                                    $luotxem = $row["Luotxem"];
                                    $phim_id = $row["Phimchieurap_id"];
                                    echo "<div class='item_small'>
                                             <a href='./chitietphim.php?phimid=".$phim_id."' style='position: relative;display: block;overflow:hidden; height: 100%'>
                                              <img src='./libraries/posterfilms".$hinh_anh."' width='300' height='185'>
                                                <span class='overlay'></span>
                                             <div class='decsription-hover'>
                                              <div class='title'>".
                                                      $ten_phim
                                                ."</div>
                                                <span class='rating'>".$luotxem." lượt xem</span>
                                                </div>
                                                <div class='decsription'>
                                                 <div class='title'>".
                                                        $ten_phim
                                                ."</div>
                                                <span class='rating'>".$luotxem." lượt xem</span><br/>
                                                </div>
                                            </a>
                                        </div>";
                                }
                            }
                            $conn->close();
                        ?>
                    </div>
                    <div class="loading" style="text-align: center; padding: 10px;">
                        <a href="./danhsachphim.php?hinhthuc=phimchieurap" title="Xem thêm">
                            <span class="glyphicon glyphicon-chevron-down" style="color: red; font-size: 1.4em;"></span>
                        </a>
                    </div>
                </section>
                <section class="phim-chieu-rap" style="padding-left:30px;">
                    <div class="title">
                        <a href="#"><h2 style="display: inline-block;color: red">PHIM BỘ</h2></a>
                    </div>
                    <div class="content">
                        <?php 
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
                            $sql = "SELECT * FROM phimchieurap ORDER BY ngaycapnhat DESC LIMIT 12";

                            $result = $conn->query($sql);
                            if ($result->num_rows > 0) {
                                while($row = $result->fetch_assoc()) {
                                    $ten_phim = $row["Tenphim"];
                                    $hinh_anh = $row["Image"];
                                    $luotxem = $row["Luotxem"];
                                    $phim_id = $row["Phimchieurap_id"];
                                    echo "<div class='item_small'>
                                             <a href='./chitietphim.php?phimid=".$phim_id."' style='position: relative;display: block;overflow:hidden; height: 100%'>
                                              <img src='./libraries/posterfilms".$hinh_anh."' width='300' height='185'>
                                                <span class='overlay'></span>
                                             <div class='decsription-hover'>
                                              <div class='title'>".
                                                      $ten_phim
                                                ."</div>
                                                <span class='rating'>".$luotxem." lượt xem</span>
                                                </div>
                                                <div class='decsription'>
                                                 <div class='title'>".
                                                        $ten_phim
                                                ."</div>
                                                <span class='rating'>".$luotxem." lượt xem</span><br/>
                                                </div>
                                            </a>
                                        </div>";
                                }
                            }
                            $conn->close();
                        ?>
                    </div>
                    <div class="loading" style="text-align: center; padding: 10px;">
                        <a href="./danhsachphim.php?hinhthuc=phimchieurap" title="Xem thêm">
                            <span class="glyphicon glyphicon-chevron-down" style="color: red; font-size: 1.4em;"></span>
                        </a>
                    </div>
                </section>
                <section class="phim-le" style="padding-left:30px;">
                    <div class="title">
                        <a href="./danhsachphim.php?hinhthuc=phimle"><h2 style="display: inline-block;color: red">PHIM LẺ</h2></a>
                    </div>
                    <div class="content">
                        <?php 
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
                            $sql = "SELECT * FROM phimle ORDER BY ngaycapnhat DESC LIMIT 12";

                            $result = $conn->query($sql);
                            if ($result->num_rows > 0) {
                                while($row = $result->fetch_assoc()) {
                                    $ten_phim = $row["Tenphim"];
                                    $hinh_anh = $row["Image"];
                                    $luotxem = $row["Luotxem"];
                                    $phim_id = $row["Phimle_id"];
                                    echo "<div class='item_small'>
                                             <a href='./chitietphim.php?phimid=".$phim_id."' style='position: relative;display: block;overflow:hidden; height: 100%'>
                                              <img src='./libraries/posterfilms".$hinh_anh."' width='300' height='185'>
                                                <span class='overlay'></span>
                                             <div class='decsription-hover'>
                                              <div class='title'>".
                                                      $ten_phim
                                                ."</div>
                                                <span class='rating'>".$luotxem." lượt xem</span>
                                                </div>
                                                <div class='decsription'>
                                                 <div class='title'>".
                                                        $ten_phim
                                                ."</div>
                                                <span class='rating'>".$luotxem." lượt xem</span><br/>
                                                </div>
                                            </a>
                                        </div>";
                                }
                            }
                            $conn->close();
                        ?>
                    </div>
                    <div class="loading" style="text-align: center; padding: 10px;">
                        <a href="./danhsachphim.php?hinhthuc=phimle" title="Xem thêm">
                            <span class="glyphicon glyphicon-chevron-down" style="color: red; font-size: 1.4em;"></span>
                        </a>
                    </div>
                </section>
                <section class="phim-chieu-rap" style="padding-left:30px;">
                    <div class="title">
                        <a href="#"><h2 style="display: inline-block;color: red">PHIM CHIẾU RẠP</h2></a>
                    </div>
                    <div class="content">
                        <?php 
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
                            $sql = "SELECT * FROM phimchieurap ORDER BY ngaycapnhat DESC LIMIT 12";

                            $result = $conn->query($sql);
                            if ($result->num_rows > 0) {
                                while($row = $result->fetch_assoc()) {
                                    $ten_phim = $row["Tenphim"];
                                    $hinh_anh = $row["Image"];
                                    $luotxem = $row["Luotxem"];
                                    $phim_id = $row["Phimchieurap_id"];
                                    echo "<div class='item_small'>
                                             <a href='./chitietphim.php?phimid=".$phim_id."' style='position: relative;display: block;overflow:hidden; height: 100%'>
                                              <img src='./libraries/posterfilms".$hinh_anh."' width='300' height='185'>
                                                <span class='overlay'></span>
                                             <div class='decsription-hover'>
                                              <div class='title'>".
                                                      $ten_phim
                                                ."</div>
                                                <span class='rating'>".$luotxem." lượt xem</span>
                                                </div>
                                                <div class='decsription'>
                                                 <div class='title'>".
                                                        $ten_phim
                                                ."</div>
                                                <span class='rating'>".$luotxem." lượt xem</span><br/>
                                                </div>
                                            </a>
                                        </div>";
                                }
                            }
                            $conn->close();
                        ?>
                    </div>
                    <div class="loading" style="text-align: center; padding: 10px;">
                        <a href="./danhsachphim.php?hinhthuc=phimchieurap" title="Xem thêm">
                            <span class="glyphicon glyphicon-chevron-down" style="color: red; font-size: 1.4em;"></span>
                        </a>
                    </div>
                </section>
            </div>
            <div class="col-lg-4">
                <?php include './includes/blockphimhot.php'; ?>
            </div>
        </div>
        <?php include './includes/footer.html';?>
    </div>
    <script>
         var text = "<option>Ngày</option>";
         for (var i = 1; i < 32; i++) {
            text = text + "<option>" + i + "</option>";
         }    
         document.getElementById("date").innerHTML = text;
    </script>
    <script>
         var text = "<option>Tháng</option>";
         for (var i = 1; i < 13; i++) {
            text = text + "<option>" + i + "</option>";
         }    
         document.getElementById("month").innerHTML = text;
    </script>
    <script>
         var text = "<option>Năm</option>";
         for (var i = 2016; i > 1910; i--) {
            text = text + "<option>" + i + "</option>";
         }    
         document.getElementById("year").innerHTML = text;
    </script>
</body>
</html>
