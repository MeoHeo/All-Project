<?php
        $convert_theloai = array("","Phim hành động", "Phim viễn tưởng", "Phim võ thuật","Phim tâm lý", "Phim tài liệu", "Phim cổ trang","Phim kinh dị", "Phim hoạt hình", "Phim hài hước","Phim tình cảm-lãng mạn");
        $convert_quocgia = array("","Việt Nam", "Hồng Kông", "Mỹ","Đài Loan", "Hàn Quốc", "Nhật Bản","Ấn Độ", "Thái Lan", "Nước khác");
        $convert_ngonngu = array("","Tiếng việt", "Lồng tiếng", "Thuyết minh","ViệtSub");

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
      $sql = "SELECT * FROM phimle ORDER BY luotxem DESC LIMIT 10";

      $result = $conn->query($sql);
 ?>

<div class="phim-hot-trong-tuan">
    <div class="title" style="padding-bottom: 10px">
        <h3 style="color: red;text-align: center;"><span class="glyphicon glyphicon-star"></span>PHIM LẺ HOT</h3>
    </div>
    <div class="list-phim-hot">
        <?php
            $result = $conn->query($sql);
            if ($result->num_rows > 0) {
                 while($row = $result->fetch_assoc()) {
                    $tenphim = $row['Tenphim'];
                    $hinhanh = $row['Image'];
                    $luotxem = $row['Luotxem'];
                     echo " <div class='row item-phim-hot' style = 'border-bottom:1px solid #808080'>
                            <div class='image col-sm-4'>
                                <a href='./chitietphim.php?phimid=".$row['Phimle_id']."'><img src='./libraries/posterfilms".$hinhanh."' width='150' height='185'></a>
                            </div>
                            <div class='decsription-phim-hot col-sm-8'>
                                <ul>
                                    <li><p style = 'font-weight:bold;font-size:1.3em;color:#ff3333'>".$tenphim."</p></li>
                                    <li style = 'color:white'>Quốc gia: ".$convert_quocgia[$row['Quocgia']]."</li>
                                    <li style = 'color:white'>Thể loại: ".$convert_theloai[$row['Theloai']]."</li>
                                    <li style = 'color:white'>Ngôn ngữ: ".$convert_ngonngu[$row['Ngonngu']]."</li>
                                    <li style = 'color:white'>Lượt xem: ".$row['Luotxem']."</li>
                                </ul>
                            </div>
                        </div>";
                 }
            }
            $conn->close(); 
        ?>
    </div>
</div>
<div class="phim-hot-trong-tuan">
    <div class="title" style="padding-bottom: 10px">
        <h3 style="color: red;text-align: center;"><span class="glyphicon glyphicon-star"></span>PHIM CHIẾU RẠP HOT</h3>
    </div>
    <div class="list-phim-hot">
        <?php
            $conn = new mysqli($servername, $username, $password, $dbname);
            mysqli_set_charset($conn,'utf8');

            // Check connection
            if ($conn->connect_error) {
                die("Connection failed: " . $conn->connect_error);
            } 
            $sql = "SELECT * FROM phimchieurap ORDER BY luotxem DESC LIMIT 10";
            $result = $conn->query($sql);
            if ($result->num_rows > 0) {
                 while($row = $result->fetch_assoc()) {
                    $tenphim = $row['Tenphim'];
                    $hinhanh = $row['Image'];
                    $luotxem = $row['Luotxem'];
                     echo " <div class='row item-phim-hot' style = 'border-bottom:1px solid #808080'>
                            <div class='image col-sm-4'>
                                <a href='./chitietphim.php?phimid=".$row['Phimchieurap_id']."'><img src='./libraries/posterfilms".$hinhanh."' width='150' height='185'></a>
                            </div>
                            <div class='decsription-phim-hot col-sm-8'>
                                <ul>
                                    <li><p style = 'font-weight:bold;font-size:1.3em;color:#ff3333'>".$tenphim."</p></li>
                                    <li style = 'color:white'>Quốc gia: ".$convert_quocgia[$row['Quocgia']]."</li>
                                    <li style = 'color:white'>Thể loại: ".$convert_theloai[$row['Theloai']]."</li>
                                    <li style = 'color:white'>Ngôn ngữ: ".$convert_ngonngu[$row['Ngonngu']]."</li>
                                    <li style = 'color:white'>Lượt xem: ".$row['Luotxem']."</li>
                                </ul>
                            </div>
                        </div>";
                 }
            }
            $conn->close(); 
        ?>
    </div>
</div>
<div class="phim-hot-trong-tuan">
    <div class="title" style="padding-bottom: 10px">
        <h3 style="color: red;text-align: center;"><span class="glyphicon glyphicon-star"></span>PHIM BỘ HOT</h3>
    </div>
    <div class="list-phim-hot">
        <?php
            $conn = new mysqli($servername, $username, $password, $dbname);
            mysqli_set_charset($conn,'utf8');

            // Check connection
            if ($conn->connect_error) {
                die("Connection failed: " . $conn->connect_error);
            } 
            $sql = "SELECT * FROM phimle ORDER BY luotxem DESC LIMIT 10";
            $result = $conn->query($sql);
            if ($result->num_rows > 0) {
                 while($row = $result->fetch_assoc()) {
                    $tenphim = $row['Tenphim'];
                    $hinhanh = $row['Image'];
                    $luotxem = $row['Luotxem'];
                     echo " <div class='row item-phim-hot' style = 'border-bottom:1px solid #808080'>
                            <div class='image col-sm-4'>
                                <a href='./chitietphim.php?phimid=".$row['Phimle_id']."'><img src='./libraries/posterfilms".$hinhanh."' width='150' height='185'></a>
                            </div>
                            <div class='decsription-phim-hot col-sm-8'>
                                <ul>
                                    <li><p style = 'font-weight:bold;font-size:1.3em;color:#ff3333'>".$tenphim."</p></li>
                                    <li style = 'color:white'>Quốc gia: ".$convert_quocgia[$row['Quocgia']]."</li>
                                    <li style = 'color:white'>Thể loại: ".$convert_theloai[$row['Theloai']]."</li>
                                    <li style = 'color:white'>Ngôn ngữ: ".$convert_ngonngu[$row['Ngonngu']]."</li>
                                    <li style = 'color:white'>Lượt xem: ".$row['Luotxem']."</li>
                                </ul>
                            </div>
                        </div>";
                 }
            }
            $conn->close(); 
        ?>
    </div>
</div>