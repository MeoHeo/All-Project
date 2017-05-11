<?php
  include './includes/session.php';
 ?>

<!DOCTYPE html>
<html lang="zxx">
    <meta charset="UTF-8" name="viewport" content="width=device-width, initial-scale=1">
	<title>Phim mới nhất | phim hành động | phim bộ | phim lẻ </title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.6.3/css/font-awesome.min.css">
	<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
	<link rel="stylesheet" type="text/css" href="./public/css/style.css">
	<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script>
	<script src="./public/javascript/javascript.js"></script>
	<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
</head> 
<body>
	<div class="container-fluid">
    <?php include './includes/header.php'; ?>
    <?php include './includes/nav.html'; ?>
    <?php include './includes/formloginsignup.php'; ?>
        <div class="tim-kiem-nang-cao" style="padding: 30px 30px 10px;">
            <?php include './includes/searchadvandbar.html'; ?>
        </div>	
        <?php 
            $convert_theloai = array("","HÀNH ĐỘNG", "VIỄN TƯỞNG", "VÕ THUẬT","TÂM LÝ", "TÀI LIỆU", "CỔ TRANG","KINH DỊ", "HOẠT HÌNH", "HÀI HƯỚC","TÌNH CẢM-LÃNG MẠN");
            $convert_quocgia = array("","VIỆT NAM", "HỒNG KÔNG", "MỸ","ĐÀI LOAN", "HÀN QUỐC", "NHẬT BẢN","ẤN ĐỘ", "THÁI LAN", "NƯỚC KHÁC");
            $convert_ngonngu = array("","TIẾNG VIỆT", "LỒNG TIẾNG", "THUYẾT MINH","VIỆTSUB");
            $path="PHIM ";

            $sql_phimle = "SELECT Tenphim, Image, Luotxem, Phimle_id FROM phimle WHERE 1";
            $sql_phimchieurap = "SELECT Tenphim, Image, Luotxem, Phimchieurap_id FROM phimchieurap WHERE 1";
            $sql_phimbo = "SELECT Tenphim, Image, Luotxem, Phimbo_id FROM phimbo WHERE 1";

            if (isset($_GET['hinhthuc'])) {
                $hinhthuc = $_GET['hinhthuc'];
                if ($hinhthuc != "0") {
                    $sql = "SELECT * FROM ".$hinhthuc." WHERE 1";
                    if ($hinhthuc == 'phimle') {
                        $path = $path." / PHIM LẺ ";
                    }
                    elseif ($hinhthuc == 'phimbo') {
                        $path = $path." / PHIM BỘ ";
                    }
                    else {
                        $path = $path." / PHIM CHIẾU RẠP ";
                    }
                }
                else {
                    $sql_phimle = "SELECT Tenphim, Image, Luotxem, Phimle_id FROM phimle WHERE 1";
                    $sql_phimchieurap = "SELECT Tenphim, Image, Luotxem, Phimchieurap_id FROM phimchieurap WHERE 1";
                    $sql_phimbo = "SELECT Tenphim, Image, Luotxem, Phimbo_id FROM phimbo WHERE 1";
                }
            }
            if (isset($_GET['ngonngu'])) {
                $ngonngu = $_GET['ngonngu'];
                if ($ngonngu != "0") {
                     if (isset($sql)) {
                         $sql = $sql." AND ngonngu=".$ngonngu;
                     }
                     else {
                        $sql_phimle = $sql_phimle." AND ngonngu=".$ngonngu;
                        $sql_phimbo = $sql_phimbo." AND ngonngu=".$ngonngu;
                        $sql_phimchieurap = $sql_phimchieurap." AND ngonngu=".$ngonngu;
                     }
                     $path = $path." / ".$convert_ngonngu[$ngonngu];
                }
            }
            if (isset($_GET['theloai'])) {
                $theloai = $_GET['theloai'];
                if ($theloai != "0") {
                     if (isset($sql)) {
                         $sql = $sql." AND theloai=".$theloai;
                     }
                     else {
                        $sql_phimle = $sql_phimle." AND theloai=".$theloai;
                        $sql_phimbo = $sql_phimbo." AND theloai=".$theloai;
                        $sql_phimchieurap = $sql_phimchieurap." AND theloai=".$theloai;
                     }
                     $path = $path." / ".$convert_theloai[$theloai];
                }
            }
            if (isset($_GET['quocgia'])) {
                $quocgia = $_GET['quocgia'];
                if ($quocgia != "0") {
                     if (isset($sql)) {
                         $sql = $sql." AND quocgia=".$quocgia;
                     }
                     else {
                        $sql_phimle = $sql_phimle." AND quocgia=".$quocgia;
                        $sql_phimbo = $sql_phimbo." AND quocgia=".$quocgia;
                        $sql_phimchieurap = $sql_phimchieurap." AND quocgia=".$quocgia;
                     }
                    $path = $path." / ".$convert_quocgia[$quocgia];
                }
            }
            if (isset($_GET['namphathanh'])) {
                $namphathanh = $_GET['namphathanh'];
                if ($namphathanh != "0") {
                     if (isset($sql)) {
                         $sql = $sql." AND namphathanh=".$namphathanh;
                     }
                     else {
                        $sql_phimle = $sql_phimle." AND namphathanh=".$namphathanh;
                        $sql_phimbo = $sql_phimbo." AND quocgia=".$namphathanh;
                        $sql_phimchieurap = $sql_phimchieurap." AND namphathanh=".$namphathanh;
                     }
                    $path = $path." / ".$namphathanh;
                }
            }
            if (isset($_GET['search'])) {
                $search = $_GET['search'];
                $sql_phimle = "SELECT Tenphim, Image, Luotxem, Phimle_id FROM phimle WHERE tenphim LIKE '%".$search."%'";
                $sql_phimchieurap = "SELECT Tenphim, Image, Luotxem, Phimchieurap_id FROM phimchieurap WHERE tenphim LIKE '%".$search."%'";
                $sql_phimbo = "SELECT Tenphim, Image, Luotxem, Phimbo_id FROM phimbo WHERE tenphim LIKE '%".$search."%'";
                $path = "TÌM KIẾM   ".$search;
            }   
        ?>	
        <div class="row">
            <div class="col-lg-8">
                <section class="phim-moi-nhat" style="padding-left:30px;">
                    <div class="title">
                        <h3 style="display: inline-block;color: red"><?php echo $path; ?></h3>
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

                              if (isset($sql)) {
                                    $num_rec_per_page=12;
                                    if (isset($_GET["page"])) { $page  = $_GET["page"]; } else { $page=1; }; 
                                    $start_from = ($page-1) * $num_rec_per_page; 
                                    $sql_current = $sql . " LIMIT $start_from, $num_rec_per_page";
                                    $result_current = $conn->query($sql_current);
                                    if ($result_current->num_rows > 0) {
                                        while($row = $result_current->fetch_assoc()) {
                                            $ten_phim = $row["Tenphim"];
                                            $hinh_anh = $row["Image"];
                                            $luotxem = $row["Luotxem"];
                                            if ($hinhthuc == "phimle") {
                                                $phim_id = $row["Phimle_id"];
                                            }
                                            elseif ($hinhthuc == "phimbo") {
                                                $phim_id = $row["Phimbo_id"];
                                            }
                                            else {
                                                $phim_id = $row["Phimchieurap_id"];
                                            }
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

                                    $result = $conn->query($sql);
                                    $total_records = $result->num_rows;
                                    $total_pages = ceil($total_records / $num_rec_per_page); 
                                    echo "<br>";
                                    echo "<ul class='pagination'>";

                                    echo "<li><a href='./danhsachphim.php?".$_SERVER['QUERY_STRING']."&page=1'>".'<span class="glyphicon glyphicon-fast-backward"></span>'."</a></li> "; // Goto 1st page  

                                    for ($i=1; $i<=$total_pages; $i++) { 
                                        echo "<li><a href='./danhsachphim.php?".$_SERVER['QUERY_STRING']."&page=".$i."'>".$i."</a></li> "; 
                                    }; 
                                    echo "<li><a href='./danhsachphim.php?".$_SERVER['QUERY_STRING']."&page=$total_pages'>".'<span class="glyphicon glyphicon-fast-forward">'."</a></li> "; // Goto last page
                                    echo "</ul>";
                                    } 
                                    else {
                                        echo "Không tìm thấy kết quả";
                                    }
                              }  
                              elseif(isset($sql_phimle)) {
                                    //tìm kết quả trong bảng phim lẻ
                                    $total_sql = $sql_phimle . " UNION " . $sql_phimchieurap . " UNION " . $sql_phimbo;
                                    $num_rec_per_page=12;
                                    if (isset($_GET["page"])) { $page  = $_GET["page"]; } else { $page=1; }; 
                                    $start_from = ($page-1) * $num_rec_per_page; 
                                    $sql_current = $total_sql . " LIMIT $start_from, $num_rec_per_page";
                                    $result_phimle = $conn->query($sql_current);
                                    if ($result_phimle->num_rows > 0) {
                                        while($row = $result_phimle->fetch_assoc()) {
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
                                    $result = $conn->query($total_sql);
                                    $total_records = $result->num_rows;
                                    $total_pages = ceil($total_records / $num_rec_per_page); 
                                    echo "<br>";
                                    echo "<ul class='pagination'>";

                                    echo "<li><a href='./danhsachphim.php?".$_SERVER['QUERY_STRING']."&page=1'>".'<span class="glyphicon glyphicon-fast-backward"></span>'."</a></li> "; // Goto 1st page  

                                    for ($i=1; $i<=$total_pages; $i++) { 
                                        echo "<li><a href='./danhsachphim.php?".$_SERVER['QUERY_STRING']."&page=".$i."'>".$i."</a></li> "; 
                                    }; 
                                    echo "<li><a href='./danhsachphim.php?".$_SERVER['QUERY_STRING']."&page=$total_pages'>".'<span class="glyphicon glyphicon-fast-forward">'."</a></li> "; // Goto last page
                                    echo "</ul>";
                                    } 
                                    else {
                                        echo "Không tìm thấy kết quả";
                                    }        
                        ?>
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