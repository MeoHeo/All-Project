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

<?php
    $convert_theloai = array("","Phim hành động", "Phim viễn tưởng", "Phim võ thuật","Phim tâm lý", "Phim tài liệu", "Phim cổ trang","Phim kinh dị", "Phim hoạt hình", "Phim hài hước","Phim tình cảm-lãng mạn");
    $convert_quocgia = array("","Việt Nam", "Hồng Kông", "Mỹ","Đài Loan", "Hàn Quốc", "Nhật Bản","Ấn Độ", "Thái Lan", "Nước khác");
    $convert_ngonngu = array("","Tiếng việt", "Lồng tiếng", "Thuyết minh","ViệtSub");

    $phimid = "";
    if (isset($_GET['phimid'])) {
        $phimid = $_GET['phimid'];
    }
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

    $sql = "SELECT * FROM phimle WHERE phimle_id = ".$phimid;
    $result = $conn->query($sql);
    if ($result->num_rows == 0) {
        $sql = "SELECT * FROM phimchieurap WHERE phimchieurap_id = ".$phimid;
        $result = $conn->query($sql);
        if ($result->num_rows == 0) {
            $sql = "SELECT * FROM phimbo WHERE phimbo_id = ".$phimid;
            $result = $conn->query($sql);
        }
    }
    $row = $result->fetch_assoc();
?>
<body>
    <script>
      window.fbAsyncInit = function() {
        FB.init({
          appId      : '1837656779827035',
          xfbml      : true,
          version    : 'v2.8'
        });
      };

      (function(d, s, id){
         var js, fjs = d.getElementsByTagName(s)[0];
         if (d.getElementById(id)) {return;}
         js = d.createElement(s); js.id = id;
         js.src = "//connect.facebook.net/en_US/sdk.js";
         fjs.parentNode.insertBefore(js, fjs);
       }(document, 'script', 'facebook-jssdk'));
    </script>
	<div class="container-fluid">
    <?php include './includes/header.php'; ?>
    <?php include './includes/nav.html'; ?>
    <?php include './includes/formloginsignup.php'; ?>
        <div class="tim-kiem-nang-cao" style="padding: 30px 30px 10px;">
            <?php include './includes/searchadvandbar.html'; ?>
        </div>		
        <div class="row">
            <div class="col-lg-8">
                <section class="phim-moi-nhat" style="padding-left:30px;">
                    <div class="title">
                        <h3 style="display: inline-block;color: red">XEM PHIM</h3>
                    </div>
                    <div class="row" style="padding-left: 20px">
                        <video width="100%" height="100%" controls>
                              <source src="./libraries/films/<?php echo $row['Link'];?>" type="video/mp4">
                        </video>
                    </div>
                </section>
                <section style="padding-left:100px;">
                    <div class="row chi-tiet-phim">
                            <div class="decsription-chi-tiet-phim col-sm-12">
                                <p style="font-weight: bold;font-size:3em;text-align: center;padding-bottom: 30px"><?php echo $row['Tenphim']; ?></p>
                                <ul style="padding: 20px 0;margin: 0;">
                                    <li>Quốc gia: <?php echo $convert_quocgia[$row['Quocgia']];?></li>
                                    <li>Thể loại: <?php echo $convert_theloai[$row['Theloai']];?></li>
                                    <li>Ngôn ngữ: <?php echo $convert_ngonngu[$row['Ngonngu']];?></li>
                                    <li>Năm: <?php echo $row['Namphathanh'];?></li>
                                    <li>Chất lượng: Bản đẹp</li>
                                    <li>Độ phân giải: 720HD</li>
                                </ul>
                            </div>
                    </div>
                </section>
                <section style="padding-left:30px;margin-top: 20px">
                    <div class="row binh-luan-phim">
                        <div class="title">
                            Bình luận về phim
                        </div>
                        <div style="padding: 10px 150px" class="fb-comments" data-href="<?php echo 'http://' . $_SERVER['HTTP_HOST'] . $_SERVER['REQUEST_URI']; ?>" data-colorscheme="light" data-numposts="10" data-width="600"></div>
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