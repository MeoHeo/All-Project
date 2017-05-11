CREATE OR REPLACE DATABASE Phim;
USE Phim;

CREATE OR REPLACE TABLE User (
	User_id int(6) zerofill UNIQUE NOT NULL AUTO_INCREMENT,
	Username varchar(50),
	Password varchar(50),
	Name varchar(50),
	Email varchar(30),
	Phone varchar(11),
	Avatar LONGBLOB,
	Roleadmin int
);

CREATE OR REPLACE TABLE Phim (
	Phim_id int(6) zerofill UNIQUE NOT NULL AUTO_INCREMENT
);
CREATE OR REPLACE TABLE Phimle (
	Phimle_id int(6) zerofill UNIQUE NOT NULL,
	Tenphim varchar(40),
	Quocgia int,
	Thongtinphim LONGTEXT,
	Ngaycapnhat date,
	Theloai int,
	Namphathanh integer,
	Ngonngu int,
	Luotxem int,
	Image varchar(200),
	Link varchar(200),
	PRIMARY KEY (Phimle_id),
	FOREIGN KEY (Phimle_id) REFERENCES Phim(Phim_id)
);
CREATE OR REPLACE TABLE Phimchieurap (
	Phimchieurap_id int(6) zerofill UNIQUE NOT NULL,
	Tenphim varchar(40),
	Quocgia int,
	Thongtinphim LONGTEXT,
	Ngaycapnhat date,
	Theloai int,
	Namphathanh integer,
	Ngonngu int,
	Luotxem int,
	Image varchar(200),
	Link varchar(200),
	PRIMARY KEY (Phimchieurap_id),
	FOREIGN KEY (Phimchieurap_id) REFERENCES Phim(Phim_id)
);
CREATE OR REPLACE TABLE Phimbo (
	Phimbo_id int(6) zerofill UNIQUE NOT NULL,
	Tenphim varchar(40),
	Quocgia int,
	Thongtinphim LONGTEXT,
	Ngaycapnhat date,
	Theloai int,
	Namphathanh integer,
	Ngonngu int,
	Luotxem int,
	Image varchar(200),
	PRIMARY KEY (Phimbo_id),
	FOREIGN KEY (Phimbo_id) REFERENCES Phim(Phim_id)
);
CREATE OR REPLACE TABLE Tapphim (
	Tap_id int(6) zerofill NOT NULL,
	Tap integer,
	Link varchar(200),
	CONSTRAINT pk_tapphimboid PRIMARY KEY (Tap_id,Tap),
	FOREIGN KEY (Tap_id) REFERENCES Phimbo(Phimbo_id)
);
CREATE OR REPLACE TABLE Phimyeuthich (
	User_id int(6) zerofill NOT NULL,
	Phim_id int(6) zerofill NOT NULL,
	CONSTRAINT pk_phimyeuthich PRIMARY KEY (User_id,Phim_id),
	FOREIGN KEY (User_id) REFERENCES User(User_id),
	FOREIGN KEY (Phim_id) REFERENCES Phim(Phim_id)
);


DELIMITER $$
CREATE OR REPLACE TRIGGER bf_phimle BEFORE INSERT
ON Phimle
FOR EACH ROW 
BEGIN
	INSERT INTO Phim VALUES (NULL);
	SET NEW.Phimle_id = (SELECT Phim_id FROM Phim ORDER BY Phim_id DESC LIMIT 1);
END$$
DELIMITER ;

DELIMITER $$
CREATE OR REPLACE TRIGGER bf_phimbo BEFORE INSERT
ON Phimbo
FOR EACH ROW 
BEGIN
	INSERT INTO Phim VALUES (NULL);
	SET NEW.Phimbo_id = (SELECT Phim_id FROM Phim ORDER BY Phim_id DESC LIMIT 1);
END$$
DELIMITER ;

DELIMITER $$
CREATE OR REPLACE TRIGGER bf_phimchieurap BEFORE INSERT
ON Phimchieurap
FOR EACH ROW 
BEGIN
	INSERT INTO Phim VALUES (NULL);
	SET NEW.Phimchieurap_id = (SELECT Phim_id FROM Phim ORDER BY Phim_id DESC LIMIT 1);
END$$
DELIMITER ;


ALTER TABLE `phimle` CHANGE `Tenphim` `Tenphim` VARCHAR(40) CHARACTER SET utf8 COLLATE utf8_vietnamese_ci NULL DEFAULT NULL;
ALTER TABLE `phimle` CHANGE `Thongtinphim` `Thongtinphim` LONGTEXT CHARACTER SET utf8 COLLATE utf8_vietnamese_ci NULL DEFAULT NULL;
ALTER TABLE `phimbo` CHANGE `Tenphim` `Tenphim` VARCHAR(40) CHARACTER SET utf8 COLLATE utf8_vietnamese_ci NULL DEFAULT NULL;
ALTER TABLE `phimbo` CHANGE `Thongtinphim` `Thongtinphim` LONGTEXT CHARACTER SET utf8 COLLATE utf8_vietnamese_ci NULL DEFAULT NULL;
ALTER TABLE `phimchieurap` CHANGE `Tenphim` `Tenphim` VARCHAR(40) CHARACTER SET utf8 COLLATE utf8_vietnamese_ci NULL DEFAULT NULL;
ALTER TABLE `phimchieurap` CHANGE `Thongtinphim` `Thongtinphim` LONGTEXT CHARACTER SET utf8 COLLATE utf8_vietnamese_ci NULL DEFAULT NULL;

ALTER TABLE `user` CHANGE `Name` `Name` VARCHAR(50) CHARACTER SET utf8 COLLATE utf8_vietnamese_ci NULL DEFAULT NULL;


INSERT INTO Phimle VALUES (Phimle_id, "Lật Mặt", 1, "xoay quanh cuộc sống của Khải (Lý Hải), một người sống trong cảnh nghèo khổ nên luôn mong muốn đổi đời. Anh cùng người bạn thân là Thắng (Tiết Cương) tham gia vào nhóm người đào kim cương trong rừng sâu. Hai người may mắn đào được ba viên kim cương thô. Họ phải đồng ý chia lại một nửa cho Dũng (Long Đẹp Trai), tên cầm đầu nhóm giang hồ bảo kê khu vực. Nhưng lòng tham vô đáy khiến Dũng trở nên độc ác khi muốn giết hại đôi bạn để có được toàn bộ số kim cương quý giá. Khải may mắn thoát chết nhưng bất lực chứng kiến cảnh bạn mình bị giết hại. Xem Phim Lật Mặt tiếp tục dẫn dắt qua nhiều diễn biến, gửi gắm thông điệp về ý chí vươn lên của mỗi số phận trước những thử thách trong cuộc sống.", '2016-11-25', 1, 2016, 1,10283,"./lat-mat.jpg","phim.mp4");
INSERT INTO Phimle VALUES (Phimle_id, "Vòng eo 56", 1, "Vòng Eo 56 một bộ phim điện ảnh tình cảm do Việt Nam sản xuất do đạo diễn Vũ Ngọc Đãng phụ trách sản xuất kể về cuộc đời của chân dài đình đám Ngọc Trinh hiện đang là tâm điểm chú ý của nhiều bạn trẻ hiện nay. Nội dung bộ phim kể về quãng thời gian thăng trầm trong cuộc sống của Ngọc Trinh thuở mới chân ướt chân ráo bước vào làng giải trí, ngay cả những phát ngôn gây sốc của người đẹp cũng được đưa vào bộ phim với các câu truyện cổ tích hiện đại vô cùng ý nghĩa. Bộ phim sẽ được bấm máy vào tháng 5 này các bạn hãy cùng chờ đón nhé. Chúc các bạn xem phim vui vẻ!", '2015-11-15', 10, 2015, 1,4283,"./vong-eo-56.jpg","phim-viet-nam-2.mp4");
INSERT INTO Phimle VALUES (Phimle_id, "Fast and Furious 7", 3, "Phim Furious 7 (Quá Nhanh Quá Nguy Hiểm 7) là phần 7 của loạt series Fast & Furious nổi tiếng. Ở cuối phần trước, tưởng chừng như mọi chuyện đã kết thúc, và mở ra một cuộc sống bình lặng, khi cả nhóm đã tiêu diệt được Owen Shaw. Thì trong phần này, sự xuất hiện của Deckard Shaw, người đã giết chết Han, và khiêu chiến với Dominic Toretto, để trả thù cho em trai Owen Shaw của mình, đã làm thay đổi tất cả. Khiến cho cuộc đụng độ giữa 2 băng nhóm lên đến đỉnh điểm. ", '2015-02-12', 1, 2015, 4,4283,"./fast-furious-7.jpg","phim-nuoc-ngoai-1.mp4");
INSERT INTO Phimle VALUES (Phimle_id, "Cảnh Sát Thây Ma", 3, "Dựa trên bộ truyện tranh cùng tên, kể về một viên sĩ quan cảnh sát không cam tâm bởi cái chết của mình nên ông đã quay lại để một lần nữa được diệt trừ tội phạm .", '2014-12-12', 1, 2013, 2,14283,"./canh-sat-thay-ma.jpg","phim-nuoc-ngoai-2.mp4");
INSERT INTO Phimle VALUES (Phimle_id, "Hoán Đổi Thân Xác", 1, "Phim kể về một nhà khoa học vì muốn cứu con gái mình khỏi căn bệnh sốt bại liệt nên đã nghiên cứu và chế tạo ra cỗ máy chuyển đổi thân xác. Một siêu mẫu, một ca sĩ và sau này là chính nhà khoa học và con chó của ông cũng bị chuyển đổi thân xác cho nhau gây ra bao tình huống dở khóc dở cười.", '2016-02-11', 9, 2016, 1,34833,"./hoan-doi-than-xac.jpg","phim.mp4");
INSERT INTO Phimle VALUES (Phimle_id, "Truy Sát", 1, "Truy Sát là bộ phim hình sự nghẹt thở về tổ đặc nhiệm của thiếu tá Nguyễn An An đối đầu với Băng Sói, băng đảng xã hội đen nguy hiểm bậc nhất.", '2015-09-12', 1, 2016, 1,39261,"./truy-sat.jpg","phim-viet-nam-4.mp4");
INSERT INTO Phimle VALUES (Phimle_id, "Huyền Thoại Về Người Mẹ", 1, "Phim là câu chuyện xúc động về Hương, người nữ hộ sinh tại một bệnh viện phụ sản có chồng đi tập kết. Cô đã nhận nuôi ba đứa trẻ sơ sinh là con của những cán bộ kháng chiến, tình báo, bất chấp mọi nguy hiểm. Huyền thoại về người mẹ còn kể những câu chuyện đau xót về những hy sinh thầm lặng của những chiến sĩ cách mạng trong lòng địch. Ngày hòa bình, chồng của Hương không trở lại, anh đã hy sinh ngoài chiến trường. Mẹ già của Hương cũng không còn nữa. Đúng lúc ấy, những đứa con nuôi, niềm vui sống của Hương lại lần lượt ra đi về bên những người ruột thịt. Nghệ sĩ Trà Giang trong vai Hương với diễn xuất tuyệt vời làm người xem xúc động tận đáy lòng.", '2013-02-12', 4, 2013, 1,82623,"./huyen-thoai-ve-nguoi-me.jpg","phim.mp4");
INSERT INTO Phimle VALUES (Phimle_id, "Cỏ Lau", 1, "Lực tập kết ra Bắc để lại quê hương cha già và người vợ trẻ. Trong đêm mưa gió, có một xác chết dạt vào xóm Đồng Vôi. Thai, vợ của Lực cho rằng chính là chồng của mình đã hy sinh. Cô cùng với bố chồng vớt xác đem chôn. Cuộc sống xô đẩy khiến Thai phải lấy Quảng, một thợ ảnh tốt bụng. Thai đưa cả bố chồng cũ về sống với schồng mới. Miền Nam giải phóng, Lực trở về quê hương - cũng là chiến trường xưa – cùng đơn vị tìm hài cốt đồng đội. Lực gặp lại cha và vợ mình trong nhà Quảng. Quá khứ sống lại. Mỗi người trong câu chuyện đối mặt với những dằn vặt trong quá khứ và éo le của hiện tại. Được chuyển thể từ truyện ngắn nổi tiếng cùng tên của nhà văn Nguyễn Minh Châu, Cỏ lau là câu chuyện đầy ám ảnh mang nhiều tính tâm linh có sức lôi cuốn mạnh mẽ, chạm đến cả những góc sâu kín nhất của tâm hồn con người…", '2010-02-12', 5, 2011, 1,34563,"./co-lau.jpg","phim.mp4");
INSERT INTO Phimle VALUES (Phimle_id, "Bệnh Viện Ma", 1, "Nội dung phim Bệnh Viện Ma nói về Thành là chàng trai tính tình hiền lành và tốt bụng và tranh đua với đời,là sinh viên vừa tốt nghiệp ngành y khoa xin vào làm việc tại bệnh viên.Tưởng chừng như có một công việc ổn định nhưng hằng đêm anh phát hiện ra những hiện tượng kỳ lạ, những hồn ma quanh quẩn tìm gặp bác sĩ..", '2016-02-19', 7, 2016, 1,7283,"./benh-vien-ma.jpg","phim.mp4");
INSERT INTO Phimle VALUES (Phimle_id, "Đến Hẹn Lại Lên", 1, "Là một tác phẩm nổi tiếng của điện ảnh Việt Nam những năm ’70, Đến hẹn lại lên là câu chuyện đầy cảm động quanh số phận một người con gái miền quê quan họ, cô Nết, ở quãng thời gian đầy biến động ngay trước cuộc Cách mạng tháng Tám bùng nổ. Nết (Như Quỳnh đóng) và Chi (Vũ Tự Lẫm) đã yêu nhau qua những canh hát quan họ. Mối tình của họ gặp trắc trở khi Bình (Cao Khương), con trai một địa chủ trong vùng muốn cưới Nết nên đã vu cho Chi là cộng sản, dồn ép gia đình Nết phải gả cô. Trong cơn tuyệt vọng Nết đã bỏ trốn… Mỗi nhân vật một số phận đã có sự đan cài vào nhau để sau đó họ đối diện nhau trong những hoàn cảnh khác nhau, đầy éo le, cũng không thiếu bất ngờ và xúc động.", '2011-02-12', 10, 1976, 1,6283,"./den-hen-lai-len.jpg","phim.mp4");
INSERT INTO Phimle VALUES (Phimle_id, "Nô Lệ Thời Chiến", 5, "Cốt chuyện phim Nô Lệ Thời Chiến xoay quanh số phận “những người phụ nữ mua vui” trong thời chiến và được nhà sản xuất ấp ủ suốt 14 năm trời do gặp không ít khó khăn khi thu hút vốn đầu tư vì mang đề tài nhạy cảm.Lấy bối cảnh Hàn Quốc bị Nhật Bản chiếm đóng vào năm 1943, The Spirits’ Homecoming là câu chuyện của hai cô bé Jung Min 14 tuổi và Young Hee 16 tuổi.Chiến tranh ập đến đã làm thay đổi mọi thứ của hai gia đình cô bé. Trong khi gia đình của Jung Min vẫn có một cuộc sống yên bình và hạnh phúc thì  với Young Hee, cô bé không được may mắn như Jung Min, chiến tranh đã lấy đi bố mẹ của cô, cô bé đã phải tự mình chăm sóc cho những cậu em trai của mình trong khi cô mới chỉ vẻn vẹn 16 tuổi. Một ngày nọ, lính Nhật bắt cóc hai cô bé và biến họ trở thành nô lệ tình dục. Bị cưỡng hiếp và đánh đập, Jung Min và Young Hee cố gắng chịu đựng và mong một ngày có thể trốn thoát. ", '2013-02-12', 10, 2009, 3,14283,"./no-le-thoi-chien.jpg","phim.mp4");
INSERT INTO Phimle VALUES (Phimle_id, "Song Hoa Điếm", 2, "A Frozen Flower dựa trên một câu chuyện có thật của triều đại Cao Ly Triều Tiên và lấy tựa từ một bài hát thời đó. Bài hát mô tả quan hệ tình dục của nam và nữ. Vương triều Cao Ly vào giai đoạn cuối bị nhà Nguyên thao túng quyền lực, nhà vua đầy tham vọng của Cao Ly tổ chức Kunyongwe. Hong Lim, người chỉ huy Kunryongwe, đã hấp dẫn nhà vua của Cao Ly, hoàng hậu để mắt đến mối quan hệ giữa Hong Lim và nhà vua.", '2013-04-12', 4, 2013, 2,93822,"./song-hoa-diem.jpg","phim.mp4");
INSERT INTO Phimle VALUES (Phimle_id, "Khủng Long Bạo Chúa", 5, "", '2014-02-12', 8, 2014, 2,83272,"./khung-long-bao-chua.jpg","phim-hoat-hinh.mp4");
INSERT INTO Phimle VALUES (Phimle_id, "Cô Gái Vượt Thời Gian", 6, "Câu chuyện bắt đầu với Kazuko Yoshiyam, một nữ sinh trung học rất rất bình thường. Một ngày cô đột nhiên ngất đi sau khi ngửi thấy mùi hoa oải hương thơm ngát . Khi tỉnh dậy Kazuko bắt đầu sở hữu siêu năng lực nhảy ngược lại thời gian. Để tìm kiếm lý do cho khả năng kỳ lạ này, Kazuko nhảy ngược lại 4 ngày và gặp Ken Gorou, du hành gia từ tương lai tới. Chính sự tiếp xúc với anh đã khiến cô có khả năng kỳ lạ này. ", '2012-02-12', 3, 2012, 2,43083,"./co-gai-vuot-thoi-gian.jpg","phim.mp4");
INSERT INTO Phimle VALUES (Phimle_id, "Sát Nhân Rustom", 7, "Chuyện phim kể về anh chàng sĩ quan hải quân Rustom Pavri và những rắc rối anh gặp phải trong chuyến về thăm gia đình. Rustom Pavri sau khi trở về nhà anh đã phát hiện ra vợ mình đang ngoại tình với một anh chàng doang nhân có tên Vikram Makhija, quá tức giận với những gì mình phát hiện Rustom Pavri dùng súng băn chết Vikram Makhija và quyết định ra đầu thú. Mọi rắc rối bắt đầu từ đó... ", '2008-02-12', 2, 2009, 3,3293,"./sat-nhan-rustom.jpg","phim.mp4");
INSERT INTO Phimle VALUES (Phimle_id, "Phi Vụ Mật", 3, "Dog eat dog là câu chuyện kể về bộ ba Troy (Nicolas Cage) , Mad Dog (Willem Dafoe) và Diesel(Christopher Matthew Cook), được thuê bởi một băng đảng Mafia khét tiếng thực hiện một phi vụ mật. Tuy nhiên mọi thứ không như bộ ba này suy nghĩ, các anh phải vừa đối diện với cảnh sát vừa phải đối mặt vớ các băng đảng khác. Thấy mọi vấn đề đều khác thường, bộ ba này đã quyết định sống chết để tìm ra nguyên nhân. ", '2013-07-19', 1, 2013, 2,54203,"./phi-vu-mat.jpg","phim.mp4");
INSERT INTO Phimle VALUES (Phimle_id, "Quái Vật Bóng Đêm", 4, "Hai mẹ con phải đối đầu với một con quái vật đáng sợ khi họ liều lĩnh đi vào một con đường vắng vẻ. ", '2015-02-12', 7, 2015, 3,50283,"./quai-vat-bong-dem.jpg","phim.mp4");
INSERT INTO Phimle VALUES (Phimle_id, "Nếu Đức Chúa Muốn", 3, "Một người cha độc tài và hống hách sẽ phản ứng như thế nào khi con của ông ta muốn trở thành một thầy tu? ", '2014-02-12', 9, 2014, 4,12923,"./neu-duc-chua-muon.jpg","phim.mp4");
INSERT INTO Phimle VALUES (Phimle_id, "Mặt Trăng", 3, "Bối cảnh của phim đặt ở tương lai, khi cuộc khủng hoảng năng lượng ở Trái đất đã được giải quyết ổn thỏa bằng một loại đá trên Mặt trăng. Công ty Lunar thuê Sam Bell lên mặt trăng làm việc trong hợp đồng 3 năm, coi sóc việc khai thác loại đá này. Anh ở trong một trung tâm điều khiển hiện đại, với sự giúp đỡ của con Robot thông minh Gerty. Chỉ còn 2 tuần nữa là hợp đồng kết thúc và anh đang mong muốn trở về nhà. Anh muốn gặp lại vợ và cô con gái 2 tuổi xinh đẹp chưa một lần bồng bế. Nhưng Sam bắt đầu thấy những ảo giác và sức khỏe giảm sút rõ rệt. Anh gặp tai nạn khi đang khảo sát địa hình ngoài bề mặt. Sau đó, Sam thức giấc và thấy mình đã quay lại trung tâm. Gesty thông báo rằng anh đã mất một phần trí nhớ. Sam cảm thấy nghi ngờ khi Gerty không cho anh ra ngoài lần nữa. Anh tìm cách thoát ra, tìm đến hiện trường vụ tai nạn và thấy có một Sam Bell khác đang nằm trong xe... ", '2013-02-12', 2, 2013, 4,42834,"./mat-trang.jpg","phim.mp4");
INSERT INTO Phimle VALUES (Phimle_id, "Nhật Kí Sát Thủ", 3, "Sau khi một nhà xuất bản thay đổi tiểu thuyết đầu tay của nhà văn về một sát thủ chết người từ tiểu thuyết đến phi hư cấu, tác giả thấy mình bị đẩy vào thế giới của những nhân vật chính của mình, và phải đảm nhận vai trò của các nhân vật của mình cho sự sống còn của chính mình. ", '2014-02-12', 1, 2013, 3,4283,"./nhat-ki-sat-thu.jpg","phim.mp4");
INSERT INTO Phimchieurap VALUES (Phimchieurap_id, 
"PHÙ THỦY TỐI THƯỢNG", 
6, 
"Bác sĩ Stephen Strange, một chuyên gia giải phẫu thần kinh. Sau một tai nạn xe hơi khủng khiếp, Stephen đã đến Tây Tạng học cách điều khiển được tiềm lực ma thuật bên trong bản thân và của thế giới xung quanh, cũng như cách mượn sức mạnh của các thần linh và chúa quỷ. Khi quyền năng của Stephen đạt tới cực đại thì cũng là lúc cái tên Dotor Strange ra đời. Trong truyện tranh nhân vật này còn được Death (người yêu của Thanos) ban cho cuộc sống trường sinh bất lão. Sau này Dr. Strane trở về 3, dùng sức mạnh của mình để bảo vệ người vô tội, bảo vệ thế giới khỏi những thế lực hắc ám. Sự nghiệp siêu anh hùng của ông cũng bắt đầu từ đây. ", 
'2009-11-25', 
1, 
2009, 
2,
92369,
"./doctor-strange-2016.jpg",
"phim.mp4");

INSERT INTO Phimchieurap VALUES (Phimchieurap_id, 
"PHI VỤ MẬT", 
7, 
"Dog eat dog là câu chuyện kể về bộ ba Troy (Nicolas Cage) , Mad Dog (Willem Dafoe) và Diesel(Christopher Matthew Cook), được thuê bởi một băng đảng Mafia khét tiếng thực hiện một phi vụ mật. Tuy nhiên mọi thứ không như bộ ba này suy nghĩ, các anh phải vừa đối diện với cảnh sát vừa phải đối mặt vớ các băng đảng khác. Thấy mọi vấn đề đều khác thường, bộ ba này đã quyết định sống chết để tìm ra nguyên nhân. ", 
'2013-11-25', 
2, 
2013, 
4,
92729,
"./dog-eat-dog-2016.jpg",
"phim.mp4");

INSERT INTO Phimchieurap VALUES (Phimchieurap_id, 
"NHẬT KÝ SÁT THỦ", 
3, 
"Dog eat dog là câu chuyện kể về bộ ba Troy (Nicolas Cage) , Mad Dog (Willem Dafoe) và Diesel(Christopher Matthew Cook), được thuê bởi một băng đảng Mafia khét tiếng thực hiện một phi vụ mật. Tuy nhiên mọi thứ không như bộ ba này suy nghĩ, các anh phải vừa đối diện với cảnh sát vừa phải đối mặt vớ các băng đảng khác. Thấy mọi vấn đề đều khác thường, bộ ba này đã quyết định sống chết để tìm ra nguyên nhân. ", 
'2016-11-25', 
5, 
2016, 
3,
902249,
"./true-memoirs-of-an-international-assassin-2016.jpg",
"phim.mp4");

INSERT INTO Phimchieurap VALUES (Phimchieurap_id, 
"MÁI ẤM LẠ KỲ CỦA CÔ PEREGRINE", 
4, 
"Jacob lớn lên cùng những câu chuyện ông nội thường hay kể. Câu chuyện về thưở thiếu thời ông đã trải qua tại một trại trẻ đã được phù phép, nơi sinh sống của những đứa trẻ sở hữu năng lực phi thường: một cô bé biết bay, một cậu bé tàng hình, một cô bé có thể tạo ra lửa...
Năm tháng qua đi, Jacob dần không còn tin vào những điều phù phiếm, cậu đặt những bước đi đầu tiên vào một cuộc sống nhung lụa êm đềm do bố mẹ bày sẵn trước mắt. Nhưng cái cái chết đột ngột của người ông cậu kính yêu nhất đã làm thay đổi tất cả. Theo lời trăn trối của ông, cậu lên tàu tìm kiếm trại trẻ từng được nhắc đến trong những câu chuyện xa xưa. Và chính tại đây, cậu không chỉ khám phá ra bí mật động trời về thân thế của mình, mà còn bước chân vào một cuộc phiêu lưu sẽ biến cuộc đời tầm thường tẻ nhạt vốn có của cậu sang một trang mới vĩnh viễn không thể quay đầu...", 
'2013-11-25', 
4, 
2013, 
3,
29374,
"./miss-peregrines-home-for-peculiar-children-2016.jpg",
"phim.mp4");

INSERT INTO Phimchieurap VALUES (Phimchieurap_id, 
"SINH VẬT HUYỀN BÍ VÀ NƠI TÌM RA CHÚNG", 
5, 
"Lấy bối cảnh trước Harry Potter, Fantastic Beasts And Where To Find Them kể về hành trình khám phá thế giới kỳ bí của pháp sư Newt Scamander do nam diễn viên Eddie Redmayne tài năng đảm nhận. Anh lên đường tới New York vào năm 1926 và sau đó, Newt bắt đầu quá trình đúc kết những tư liệu về các loài sinh vật mà về sau trường Hogwart dùng để giảng dạy. Đây cũng là một trong những cuốn sách giáo khoa được nhắc tới trong tập 1 của Harry Potter - Harry Potter và Hòn đá phù thủy. ", 
'2014-11-25', 
7, 
2014, 
4,
8303,
"./fantastic-beasts-and-where-to-find-them-2016.jpg",
"phim.mp4");

INSERT INTO Phimchieurap VALUES (Phimchieurap_id, 
"KUBO VÀ SỨ MỆNH SAMURAI", 
6, 
"Cậu bé Kubo thông minh, tốt bụng cố gắng trang trải qua ngày bằng cách kể những câu chuyện thần thoại cho những cư dân sống tại ngôi làng nhỏ ven biển. Tuy nhiên, cuộc sống bình lặng của cậu nhanh chóng đảo lộn khi cậu vô tình triệu hồi một hồn ma huyền thoại từ quá khứ của mình, vốn từ thiên đường xuống hạ giới để thanh toán một món nợ máu có từ ngàn xưa. Phải lên đường trốn chạy, Kubo gặp gỡ hai người bạn Khỉ (Charlize Theron) và Bọ (Matthew McConaughey), cả ba cùng nhau trải qua chuyến hành trình ly kỳ nhằm giải cứu gia đình và giải đáp bí ẩn xung quanh người cha đã khuất của cậu, vị chiến binh samurai vĩ đại nhất mà thế giới từng biết đến. Với sự giúp sức của shamisen, một loại nhạc cụ thần thông, Kubo phải chiến đấu với cả thần thánh lẫn quái vật, trong đó có vị Nguyệt Đế (Ralph Fiennes) và Tỷ Muội sinh đôi độc ác (Rooney Mara), mới có thể vén bức màn bí mật về di sản của mình, đồng thời đoàn tụ với gia đình và hoàn thành sứ mệnh anh hùng. ", 
'2010-11-25', 
8, 
2010, 
4,
26193,
"./kubo-and-the-two-strings-2016.jpg",
"phim.mp4");

INSERT INTO Phimchieurap VALUES (Phimchieurap_id, 
"ĐIỆP VỤ MILANO", 
4, 
"Phim Điệp Vụ Milano với cái tên tiếng anh là Mission Milano. Tuy không phải là một bộ phim đình đám nhưng nó đủ sức hút để mọi người chú ý đến. Điệp Vụ Milano có sự tham gia của hai ngôi sao hàng đầu hoa ngữ thời điểm hiện tại là trai đẹp Huỳnh Hiểu Minh và tài tử Lưu Đức Hoa. Bộ phim được biết đến là một dự án điện ảnh có kinh phí khá lớn do đạo diễn lừng danh Vương Tinh chỉ đạo, tên tuổi của ông được mọi người biết đến qua loạt phim điện ảnh thần bài hay là bộ phim ăn khách trường học Uy Long, những thước phim này cũng đánh dấu tên tuổi của vua hài Châu Tinh Trì. Ngoài ra, phim còn có sự tham gia của một số diễn viên nổi tiếng khác như: Vương Tổ Lam, Âu Dương Na Na…Trong Điệp Vụ Milano, Huỳnh Hiểu Minh sẽ vào vai một siêu đạo chích tinh quái và anh phải đối đầu với tay thám tử hài hước do Lưu Đức Hoa thủ vai. Lúc đầu, khi chưa biết đối thủ của mình thế nào, 2 người chiến đấu giống như một sống một còn nhưng chính những lần đối đầu đó khiến 2 người hiểu nhau hơn và dần dần trở thành cặp đôi hoàn hảo. ", 
'2012-11-25', 
6, 
2012, 
2,
93893,
"./mission-milano-2016.jpg",
"phim.mp4");

INSERT INTO Phimchieurap VALUES (Phimchieurap_id, 
"VIỄN TÂY SINH SÁT", 
3, 
"Khi một gã chuyên cướp xe ngựa miền viễn Tây bị săn đuổi bởi một viên cảnh sát trưởng đầy lòng căm thù.", 
'2015-11-25', 
2, 
2015, 
3,
39932,
"./stagecoach-the-texas-jack-story-2016.jpg",
"phim.mp4");

INSERT INTO Phimchieurap VALUES (Phimchieurap_id, 
"TRÒ CHƠI GỌI HỒN 2", 
4, 
"Ouija 2 -Trò Chơi Gọi Hồn 2 kể về một câu chuyện lấy bối cảnh năm 1965 tại Los Angeles, 3. Một góa phụ cùng hai con gái đã tham gia vào buổi gọi hồn để ủng hộ việc kinh doanh bất chính nhưng vô tình mời một ác quỷ đích thực vào nhà. Khi đứa con út bị chiếm đoạt bởi linh hồn độc ác, cả gia đình phải đối mặt với nỗi sợ không thể tưởng để giải cứu cô con gái nhỏ và đưa kẻ chiếm đoạt về thế giới bên kia.", 
'2011-11-25', 
6, 
2011, 
3,
82032,
"./ouija-origin-of-evil-2016.jpg",
"phim.mp4");

INSERT INTO Phimchieurap VALUES (Phimchieurap_id, 
"CHIẾN HẠM INDIANAPOLIS", 
6,  
"USS Indianapolis Men of Courage là phim viễn tưởng do 3 sản xuất câu chuyện nói về một thuyền trưởng chỉ huy hơn 1100 thuyền viên, nhưng sao khi USS Indianapolis lâm nạn thì đã bỏ mạng hết 300 người, những người còn lại thì lênh đênh trên mặt biển suốt mấy ngày trời để chờ người đến cứu mạng. Sau khi được cứu, thủy thủ đoàn chỉ còn lại 327 người còn sống. Và ngay sau đó, thuyền trường McVay đã bị đưa ra tòa án quân sự để chịu trách nhiệm. Và hơn sau nửa thế kỷ nỗi oan của McVay mới đươc giải.", 
'2015-11-25', 
6, 
2015, 
4,
12399,
"./uss-indianapolis-men-of-courage-2016.jpg",
"phim.mp4");

INSERT INTO Phimchieurap VALUES (Phimchieurap_id, 
"KHÔNG QUAY ĐẦU", 
5, 
"Jack Reacher: Never Go Back tiếp tục được chuyển thể từ phần thứ 18 trong cuốn tiểu thuyết của Lee Child. Câu chuyện mới dường như “chơi chữ” với tiêu đề “không quay đầu”. Trên thực tế, đây là sự trở lại của Jack Reacher sau thời gian dài ẩn danh để tìm kiếm sếp cũ - thiếu úy Susan Turner – rồi phát hiện ra cô ấy đã bị gài bẫy và đang chịu cảnh tù tội. Cách giải quyết của Jack Reacher? “Các người nghĩ mình đứng trên luật pháp. Nhưng tôi không phải là luật pháp. Vì thế các người liệu mà chạy đi trước khi tôi bắt đầu chuyến đi săn này. Khi tôi tìm thấy các người, tôi sẽ tiêu diệt tất cả!”. ", 
'2016-11-25', 
4, 
2016, 
3,
10229,
"./jack-reacher-never-go-back-2016.jpg",
"phim.mp4");

INSERT INTO Phimchieurap VALUES (Phimchieurap_id, 
"HOẢ NGỤC", 
6, 
"Tỉnh dậy trong bệnh viện ở Florence (Nước Ý), Robert Langdon phát hiện mình bị thương ở đầu, đồng thời bị mất đi một phần ký ức của những ngày vừa qua. Những gì ông còn nhớ là hình ảnh mình đang đi trong khuôn viên trường Harvard. Sienna Brooks, một trong các bác sĩ đang chăm sóc cho Robert, cho biết ông bị chấn thương sọ não do một viên đạn bay sượt qua đầu và đã tự mình đến phòng cấp cứu. Chưa kịp hiểu chuyện gì đang diễn ra thì Robert lại bị săn đuổi bởi các sát thủ buộc ông phải tiếp tục trốn chạy và bước vào hành trình giải mã những bí ẩn, ngăn chặn âm mưu diệt chủng loài người. ", 
'2013-11-25', 
9, 
2013, 
3,
19329,
"./inferno-2016.jpg",
"phim.mp4");

INSERT INTO Phimchieurap VALUES (Phimchieurap_id, 
"CHUYỆN CHƯA KỂ Ở XỬ SỞ KHỔNG LỒ", 
7, 
"The BFG kể câu chuyện huyền ảo về tình bạn giữa cô bé Sophie và một Người Khổng Lồ - BFG, người đã cho cô xem những điều kỳ diệu cũng như mối đe doạ ở Vương ff giấc mơ. Họ nhanh chóng trở thành bạn tốt, nhưng sự hiện diện của Sophie ở Vương Quốc Khổng Lồ đã thu hút sự chú ý và quấy rối của những gã khổng lồ khác. Sophie và BFG quyết định tới London để gặp Nữ Hoàng (Penelope Wilton) và cảnh báo bà về âm mưu của người khổng lồ, nhưng trước hết họ cần thuyết phục Nữ Hoàng và cô hầu gái của bà, Mary (Rebecca Hall) rằng người khổng lồ là có thật. Họ cùng nhau lập kế hoạch để đẩy lùi đám người khổng lồ và bảo vệ vương quốc.", 
'2014-11-25', 
2, 
2014, 
2,
39139,
"./the-bfg-2016.jpg",
"phim.mp4");

INSERT INTO Phimchieurap VALUES (Phimchieurap_id, 
"THUNG LŨNG CỦA BẠO LỰC", 
5, 
"Ngôi sao Hawke thủ vai Paul, người đàn ông bí ẩn vừa đặt chân xuống một thị trấn ở Texas, kéo theo đó là sự hoài nghi của người dân địa phương nơi đây. Như cái tên của bộ phim, In a Valley of Violence thể hiện sự bạo lực từ bên trong thị trấn cho đến những thung lũng sa mạc, thêm nữa bộ phim thể hiện được mối liên kết tình cảm giữa con người với người bạn trung thành nhất là loài chó.", 
'2013-11-25', 
1, 
2013, 
2,
9822,
"./in-a-valley-of-violence-2016.jpg",
"phim.mp4");

INSERT INTO Phimchieurap VALUES (Phimchieurap_id, 
"BỆNH NHÂN SỐ BẢY", 
2, 
"Bộ phim về Tiến sĩ Marcus, một bác sĩ tâm thần nổi tiếng, đã chọn 6 bệnh nhân bị bệnh tâm thần và nguy hiểm nghiêm trọng từ các bệnh viện tâm thần Spring Valley để phỏng vấn như là một phần của nghiên cứu cho cuốn sách mới của mình. Khi cuộc phỏng vấn của Tiến sĩ Marcus với từng bệnh nhân, đã phát hiện ra những nỗi kinh hoàng của từng người một. Tuy nhiên, Tiến sĩ Marcus sớm nhận ra rằng có một bệnh nhân đã gắn kết họ lại với nhau - Đó là Bệnh nhân số Bảy. ", 
'2012-11-25', 
2, 
2012, 
3,
19333,
"./patient-seven-2016.jpg",
"phim.mp4");

INSERT INTO Phimchieurap VALUES (Phimchieurap_id, 
"VÂY HÃM JADOTVILLE", 
7, 
"Năm 1961, Liên Hợp Quốc cử đội gìn giữ hòa bình của Ireland đến Congo, để bảo vệ những cư dân thị trấn mỏ Jadotville trước cuộc nội chiến. Nhưng họ nhanh chóng phát hiện mình đang ở trong một âm mưu chính trị, mà chỉ một sai lầm sẽ phải trả giá đắt. ", 
'2009-11-25', 
1, 
2009, 
3,
78829,
"./the-siege-of-jadotville-2016.jpg",
"phim.mp4");

INSERT INTO Phimchieurap VALUES (Phimchieurap_id, 
"CÂU CHUYỆN ĐỜI TÔI", 
5, 
"Certain Women là ba mẩu chuyện nhỏ về những người phụ nữ ở một thị trấn nhỏ ở nước Mĩ. Đó là một luật sư với những rắc rối nghề nghiệp, một người vợ trẻ với những lo âu và bất an về cuộc hôn nhân, là những cuộc gặp trong quán ăn giữa hai người xa lạ.
Phim vẫn mang phong cách đặc trưng của Kelly Reichard: trầm lắng, từ tốn, những khung hình rộng, trống trải. Con người có lẽ thật nhỏ bé trong đó, ưu tư của họ cũng dường như thật bình thường, nhưng không hề kém phức tạp và sâu lắng.", 
'2009-11-25', 
10, 
2009, 
3,
43209,
"./certain-women-2016.jpg",
"phim.mp4");

INSERT INTO Phimchieurap VALUES (Phimchieurap_id, 
"BẢY TAY SÚNG HUYỀN THOẠI", 
6, 
"The Magnificent Seven là bản làm lại từ bộ phim kinh điển cùng tên được sản xuất năm 1960 của đạo diễn John Sturges, dựa trên kịch bản phim Seven Samurai của Akira Kurosawa. Nội dung chính vẫn tập trung vào bảy anh chàng cao bồi và hành trình giải thoát cho một ngôi làng khỏi ách áp bức của bọn địa chủ. Riêng bản làm mới sẽ thay đổi địa điểm xảy ra câu chuyện, bối cảnh chính trong phim sẽ là miền viễn Tây nước 3 thay cho ngôi làng nhỏ ở Mexico. Bản phim cũ đã được đề cử cho rất nhiều giải thưởng danh giá như giải Oscar và Quả cầu vàng, bản 2016 cũng hứa hẹn sẽ mang lại rất nhiều điều thú vị và mới mẻ cho khán giả. ", 
'2010-11-25', 
4, 
2010, 
4,
10219,
"./the-magnificent-seven-2016.jpg",
"phim.mp4");

INSERT INTO Phimchieurap VALUES (Phimchieurap_id, 
"ĐIỆP VỤ TAM GIÁC VÀNG", 
2, 
"Điệp Vụ Tam Giác Vàng là câu chuyện có thật dựa trên cuộc thảm sát trên sông Mê-kông diễn ra vào ngày 5/10/2011. Hai chiếc tàu buôn của Trung Quốc bị tấn công trên khu vực Tam Giác Vàng, toàn bộ 13 thuyền viên đều bị giết, đồng thời phát hiện 90 tấn thuốc phiện ở trên tàu. Nhằm minh oan cho những người đã chết và điều tra rõ ràng chân tướng, một đội đặc công đã được phái đến khu vực xảy ra thảm án. Thế nhưng, họ không lường trước được vụ án tưởng chừng như đơn giản này lại ẩn chứa một bí mật kinh hoàng, liên quan đến nhiều tập đoàn tội phạm dọc vùng sông nước này.", 
'2016-11-25', 
1, 
2016, 
3,
29103,
"./operation-mekong-2016.jpg",
"phim.mp4");

INSERT INTO Phimchieurap VALUES (Phimchieurap_id, 
"DẬY THÌ MUỘN", 
4, 
"Ở tuổi 30. Peter Newmans là bác sĩ trị liệu chuyên chữa trị cho những người nghiện tình dục. Tuy nhiên, sau khi một khối u ở não bị cắt bỏ, a bỗng trải qua giai đoạn dậy thì lần đầu tiên trong đời. Các thay đổi bất thường cũng như ham muôn sinh lý bắt đầu làm đảo lộn cuộc sống của Peter, tạo ra nhiều tình huống dở khóc dở cười.", 
'2016-11-25', 
9, 
2016, 
4,
2934,
"./the-late-bloomer-2016.jpg",
"phim.mp4");


INSERT INTO user(Username, Password, Name, Email, Phone, Avatar, Roleadmin) VALUES ("Quang","12345678","Nguyễn Nhựt Quang","quang@gmail.com","01644270427","user_quang.jpg",0);

INSERT INTO user(Username, Password, Name, Email, Phone, Avatar, Roleadmin) VALUES ("Tri","12345678","Lê Thiện Trí","tri@gmail.com","01644270428","user_tri.jpg",1);

INSERT INTO user(Username, Password, Name, Email, Phone, Avatar, Roleadmin) VALUES ("Phuong","12345678","Nguyễn Thị Phượng","phuong@gmail.com","01644270429","user_phuong.jpg",0);

INSERT INTO user(Username, Password, Name, Email, Phone, Avatar, Roleadmin) VALUES ("Trung","12345678","Nguyễn Thành Trung","trung@gmail.com","01644270430","user_trung.jpg",0);






-- phpMyAdmin SQL Dump
-- version 4.5.1
-- http://www.phpmyadmin.net
--
-- Host: 127.0.0.1
-- Generation Time: Nov 27, 2016 at 11:09 AM
-- Server version: 10.1.16-MariaDB
-- PHP Version: 5.5.38

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `tintuc`
--

-- --------------------------------------------------------

--
-- Table structure for table `tinphim`
--

CREATE TABLE `tinphim` (
  `id_phim` int(100) NOT NULL,
  `tin_title` text COLLATE utf8_unicode_ci NOT NULL,
  `tin_image` text COLLATE utf8_unicode_ci NOT NULL,
  `tin_noidung` text COLLATE utf8_unicode_ci NOT NULL,
  `tin_tacgia` text COLLATE utf8_unicode_ci NOT NULL,
  `tin_ngay` text COLLATE utf8_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `tinphim`
--

INSERT INTO `tinphim` (`id_phim`, `tin_title`, `tin_image`, `tin_noidung`, `tin_tacgia`, `tin_ngay`) VALUES
(1, 'ONE PIECE FILM GOLD ĐƯỢC TRÌNH CHIẾU TẠI MỸ VÀ CANADA', 'hinh10.jpg', 'One Piece Film Gold đã được ra rạp tại Nhật Bản vào ngày 23/07, nhưng cho đến tận bây giờ, nhiều quốc gia khác trên thế giới vẫn chưa được ngồi rạp thưởng thức bộ bom tấn này. Vào thứ Tư vừa qua, Funimation đã công bố rằng họ đã cấp phép cho One Piece Film Gold được trình chiếu tại Mỹ và Canada.', 'Vuighe', '27-11-16'),
(2, 'ONE PIECE FILM GOLD ĐƯỢC<br > TRÌNH CHIẾU TẠI MỸ VÀ CANADA', 'small4.jpg', 'One Piece Film Gold đã được ra rạp tại Nhật Bản vào ngày 23/07, nhưng cho đến tận bây giờ, nhiều quốc gia khác trên thế giới vẫn chưa được ngồi rạp thưởng thức bộ bom tấn này. <br ><strong>Vào thứ Tư vừa qua, Funimation</strong> đã công bố rằng họ đã cấp phép cho One Piece Film Gold được trình chiếu tại Mỹ và Canada.', 'Vuighe', '27-11-16'),
(3, 'NGHẸT NGỞ VỚI TRAILER CỦA FINAL FANTASY XV', 'hinh7.jpg', 'Gần kề ngày ra mắt, Square Enix lại làm fan nóng lòng bằng việc tung ra trailer với những pha hành động cực gay cấn dành cho bộ game Final Fantasy XV đình đám. Đây là một trong những bom tấn rất được chờ đợi của năm nay, và thời gian gần ngày ra mắt là thời điểm cái tên Final Fantasy XV trở nên nóng hơn bao giờ hết!', 'Misaki Mei', '27-11-16'),
(7, 'NOBU - XUYÊN KHÔNG TỬU LẦU KÍNH CHÀO QUÝ KHÁCH!', 'hinh21.jpg', 'Isekai Izakaya "Nobu" xoay quanh một quán bar tại Kyoto, Nhật Bản, có cửa thông với các thế giới khác nhau. Khách đến quán bar là những cư dân đến từ các thế giới song song kia. Thực khách đến Nobu để thưởng thức đồ ăn ngon và vị bia lạnh trứ danh bậc nhất cùng câu cửa miệng quen thuộc: "Toriaezu Nama". <br >\r\n<br >\r\nĐược biết, tác giả Natsuya Semikawa đăng tải bộ light novel này lần đầu trên trang web: Shōsetsu-ka ni Narou (Cùng làm Tiểu thuyết gia) vào năm 2012 và gặt hái thành công với giải thưởng:"Ni Narou Con Taishō". Nhà xuất bản Takarajimasha bắt đầu ấn hành Nobu - Xuyên không Tửu lầu với minh họa bởi họa sĩ Kururi vào năm 2014 và tới tháng 12 năm 2015, bộ tiểu thuyết đã bước sang cuốn thứ tư. Hiện tại, nhà xuất bản đang in lại toàn bộ tác phẩm dưới dạng bunkobon (sách bỏ túi cỡ A6) cùng một số chi tiết mới. Vào tháng 7 năm 2015, Virginia Nitōhei đã xuất bản Manga phỏng theo tác phẩm trên tạp chí Kadokawa''s Young Ace và đồng thời ra mắt công chúng tập sách tổng hợp thứ hai của manga vào ngày 4 tháng 7.', 'Anilezah', '11-27-16'),
(8, 'ANIME NGOẠI TRUYỆN CHIRURAN: SHINSENGUMI CHINKON-KA SẮP RA MẮT!', 'hinh9.jpg', 'Bộ manga nguyên tác được mô tả như sau: Trước khi thời đại mới mở ra, Kyoto chìm trong hỗn loạn. Các bang phái bài xích nhau về mục tiêu, các lý tưởng đối chọi nhau quyết liệt và số đông cổ suý bạo lực đến rợn người để củng cố quan điểm mình. Trong bối cảnh ấy, một nhóm thiếu niên bốc đồng được lựa chọn để cứu lấy Kyoto và cũng để chứng minh chân giá trị của mình. Người ta gọi họ là Shinsengumi - những kiếm khách của hoà bình, người sẽ trả lại trật tự cho khắp các con phố vùng Kyoto...Đây, là câu chuyện về những Samurai đánh thuê trẻ tuổi đầy ngạo nghễ trong thời kì loạn lạc trùng trùng sóng gió. <br ><br >Những gã mà sự sống và cái chết gắn liền với thanh gươm của mình. Những gã, mà 2 tiếng "đàn ông" được định nghĩa bằng cách anh ta "lìa đời".', 'Anilezah', '27-11-16'),
(10, 'VŨ KHÍ CỔ ĐẠI TRONG ONE PIECE', 'hinh22.jpg', 'Vũ khí Cổ Đại là 3 vũ khí có khả năng hủy diệt hàng loạt, mỗi loại có một hình dáng riêng, được biết đến với cái tên Pluton, Poseidon và Uranus.  Các vũ khí này không chỉ giới hạn ở những vật vô tri mà còn ở những sinh vật sống nữa.<br >\r\n\r\nVũ khí cổ đại cũng chính là lý do mà Chính Quyền Thế Giới cấm nghiên cứu về Thế Kỷ Trống, do họ lo sợ rằng kiến thức về các vũ khí này có thể dẫn đến chiến tranh thế giới. <br >\r\n\r\nTuy nhiên, điều này không khiến cho một số thành viên của Chính quyền trong đó có Spandam cùng với cựu Thất Vũ Hải Crocodile ngừng công việc tìm kiếm chúng. <br >\r\n\r\nThậm chí, dù không có kiến thức về Thế Kỷ Trống, một số người khác vẫn có hứng thú tìm kiếm Vũ khí cổ đại, ví dụ như Vander Decken IX.', 'Misaki Mei', '27-11-16'),
(11, 'BÀN VỀ HUYẾT KẾ GIỚI HẠN TRONG NARUTO (PHẦN 2)', 'hinh23.jpg', 'Huyết Kế Giới Hạn là năng lực phi thường di truyền qua các thế hệ trong một gia tộc nhất định. Ở phần 1, TinAnime đã giới thiệu đến các bạn về tổng quan và một số loại Huyết Kế Giới Hạn. Hôm nay, TinAnime tiếp tục phần hai, xoay quanh chủ yếu các Huyết Kế Giới Hạn Đồng Thuật và Huyết Kế Giới Hạn đặc biệt của các gia tộc khác.<br >\r\n\r\nBạch Nhãn (白眼 - Byakugan): Là một Huyết Kế Giới Hạn của gia tộc Hyuuga và gia tộc Otsutsuki. Huyết Kế Giới Hạn này là một trong Tam Đại Đồng Thuật. Đôi mắt này có màu trắng và không xuất hiện đồng tử, chỉ khi được kích hoạt, đồng tử hiện ra, và huyết mạch chung quanh đôi mắt sẽ phồng lên. Một trong những năng lực tuyệt nhất của Bạch Nhãn đó chính là nó có thể thấy được hệ thống mạch chakra và 361 huyệt trên cơ thể người khác. Gia tộc Hyuuga đã lợi dụng ưu thế này và tạo ra thế võ Nhu Quyền, đánh vào các huyệt đạo trên cơ thể đối thủ, tùy ý đóng mở các huyệt chakra của họ.', 'Anilezah', '27-11-16'),
(12, 'ROCK LEE - THIÊN TÀI THỂ THUẬT - THIÊN TÀI NỖ LỰC', 'hinh24.jpg', 'Rock Lee là một anh hùng thể thuật của Làng Lá, vốn dĩ cậu thua thiệt hơn bất cứ ai do không sở hữu bất kì nhẫn thuật hay ảo thuật nào, cậu lại là một người có tinh thần quyết tâm và chăm chỉ hơn ai hết. Nhân dịp sinh nhật của anh chàng lông mày sâu róm này, TinAnime giới thiệu đến các bạn một số câu nói hay từ Lee nhé!', 'Anilezah', '27-11-16');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `tinphim`
--
ALTER TABLE `tinphim`
  ADD PRIMARY KEY (`id_phim`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `tinphim`
--
ALTER TABLE `tinphim`
  MODIFY `id_phim` int(100) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=17;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
