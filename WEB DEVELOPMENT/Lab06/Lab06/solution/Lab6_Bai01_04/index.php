<!DOCTYPE html>
<html lang="en">
<head>
	<title>Lab06_Bai01</title>
	<meta charset="utf-8" >
	<link rel="stylesheet" href="style.php" media="screen">	
</head>

<body >
	<!--================================Bai_1==================================-->
	<h1>Result Question 1</h1>
	<div style="border: solid 1px">
	<?php
		$x=10;
		$y=7;
		print $x."+".$y."=";
		print $x+$y;

		print"<br/>";

		print $x."-".$y."=";
		print $x-$y;

		print"<br/>";

		print $x."*".$y."=";
		print $x*$y;

		print"<br/>";

		print $x."/".$y."=";
		print $x/$y;

		print"<br/>";

		print $x."%".$y."=";
		print $x%$y;
	?>
	</div>
	<!--================================Bai_2==================================-->
	<h1>Result Question 2</h1>
	<div style="border: solid 1px">
		<?php
			function xuatThongDiep($n){
				$Sodu = $n%5;
				switch ($Sodu) {
					case 0:
						echo "Hello<br>";
						break;
					case 1:
						echo "How are you<br>";
						break;
					case 2:
						echo "I'm doing well, thank you<br>";
						break;
					case 3:
						echo "See you later<br>";
						break;
					case 4:
						echo "Good bye<br>";
						break;
					default:
						echo "Nothing<br>";
						break;
				}
			}
			xuatThongDiep(5);
			xuatThongDiep(6);
			xuatThongDiep(7);
			xuatThongDiep(8);
			xuatThongDiep(9);
		?>
	</div>
	<!--================================Bai_3==================================-->
	<h1>Result Question 3a</h1>
	<div style="border: solid 1px">
		<?php
			for($x=0;$x<=100;$x++){
				if($x==99)
				{
					echo $x;
					break;
				}
				if($x%2==1){
					echo $x.',';
				}
			}
		?>	
	</div>

	<h1>Result Question 3b</h1>
	<div style="border: solid 1px">
		<?php
			$x = 0;
			while ($x <= 100) {
				if($x==99)
				{
					echo $x;
					break;
				}
				if($x%2==1){
					echo $x.',';
				}
				$x++;
			}
		?>
	</div>
	<!--================================Bai_3==================================-->
	<h1>Result Question 4</h1>
	<div style="border: solid 1px">
		<?php
		   $row = 7; //Dynamic number for rows
		   $col = 7; // Dynamic number for columns
		   $n = 1;
		   echo "<table border='1'>";
		   for($i=0;$i<$row;$i++){
		     echo "<tr>";
		      for($j=1;$j<=$col;$j++){
		        echo "<td>";
		        echo $j*$n;		        
		        echo "</td>";
		      }
		      $n++;
		      echo "</tr>";
		  }
		  echo "</table>";
		?>
	</div>
</body>
</html>

