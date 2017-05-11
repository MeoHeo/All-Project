<!DOCTYPE html>
<html lang="en">
<head>
	<title>Lab07_Bai01</title>
	<meta charset="utf-8" >
	<link rel="stylesheet" type="text/css" href = "style.css"/>	
</head>

<body>
	<!-- ===========================PHP_Cau a======================= -->
	<?php
		$servername = "localhost";
		$username = "root";
		$password = "";
		$dbname = "examples";

		// Create connection
		$conn = new mysqli($servername, $username, $password, $dbname);

		// Check connection
		if ($conn->connect_error) {
		    die("Connection failed: " . $conn->connect_error);
		} 
		// echo "Connected successfully <br>";


		$sql = "SELECT id, name, year FROM cars";
		$result = $conn->query($sql);

		if ($result->num_rows > 0) {
		    // output data of each row
		  echo "<p>CARS</p>
		  		<table>
		  		<tr>
		  		<th>ID</th>
		  		<th>Name</th>
		  		<th>Year</th>
		  		</tr>";
		    while($row = $result->fetch_assoc()) {
		        $id_current = $row["id"];
		        $name_current = $row["name"];
		        $year_current = $row["year"];
		        echo "<tr>
			    <td>$id_current</td>
			    <td>$name_current</td>
			    <td>$year_current</td>
			  </tr>";
		    }			  
			echo "</table>";
		} 
		else {
		    echo "0 results";
		}
		$conn->close();	
	?>
	<!-- ===========================PHP_Cau b, c, d======================= -->
	

	<!-- PHP test form -->
	<?php
		$erroID=$erroName=$erroYear=$id=$name=$year="";
		$count = 0;
		if (empty($_POST['id'])) {
			$erroID ="id is required";
		}
		else{
			$id=test_input ($_POST['id']);
		}

		if (empty($_POST['name'])) {
		}
		else
		{
			$name = test_input ($_POST['name']);
			if(strlen($name) < 2 || strlen($name) > 40) {
			 	$erroName= "Name must be from 2 to 50 characters.";
			 	$count++;
			 }
		}
		
		if (empty($_POST['year'])) {
		}
		else
		{
			$year=test_input ($_POST['year']);
			if ($year<1990 ||$year>2015) {
				$erroYear ="Year must be from 1990 to 2015. ";
				$count++;
			}
		}
		 //============================================
		 function test_input ($data) {
			$data = trim($data) ;
			$data = stripslashes($data);
			$data = htmlspecialchars($data);
			return $data;
		}
	?>
	<!-- // Create form for user -->
		<form method="POST" onclick="test_input();" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>">
			<p>INSERT/UPDATE/DELETE</p>
			<span>ID:</span><input type="number" name="id" value="">*
				<?php 
					if (isset($_POST['id'])) echo $erroID;
				?>
			<br>
			<span>NAME:</span><input type="text" name="name" value="">
				<?php 
					if (isset($_POST['name'])) echo $erroName;
				?>
			<br>
			<span>YEAR:</span><input type="number" name="year" value="">
				<?php 
					if (isset($_POST['year'])) echo $erroYear;
				?>
			<br>

			<input type="submit" name="insert" value="Insert">
			<input type="submit" name="update" value="Update">
			<input type="submit" name="delete" value="Delete">

		</form>
	<!-- =========================Connect MySQLi=========================== -->
	<?php
		$servername = "localhost";
		$username = "root";
		$password = "";
		$dbname = "examples";
		// Create connection
		$conn = new mysqli($servername, $username, $password, $dbname);

		// Check connection
		if ($conn->connect_error) {
		    die("Connection failed: " . $conn->connect_error);
		} 
		// echo "Connected successfully <br>";

		//SQL
		if(isset($_POST['insert']) && $count==0)
		{
			$sql = "INSERT INTO Cars (id, name, year)
			VALUES ('$id', '$name', '$year')";

			if ($conn->query($sql) === TRUE) {
			    echo "New record created successfully";
			} else {
			    echo "Error: " . $sql . "<br>" . $conn->error;
			}
		}
		if(isset($_POST['update']) && $count==0)
		{
			$sql = "UPDATE Cars SET name='$name', year='$year' WHERE id='$id'";
			if ($conn->query($sql) === TRUE) {
			    echo "A record updated successfully";
			} else {
			    echo "Error: " . $sql . "<br>" . $conn->error;
			}
		}
		if(isset($_POST['delete'])&& $count==0)
		{
			$sql = "DELETE FROM Cars WHERE id='$id'";
			if ($conn->query($sql) === TRUE) {
			    echo "A record deleted successfully";
			} else {
			    echo "Error: " . $sql . "<br>" . $conn->error;
			}
		}

		$conn->close();
	?>	
</body>
</html>

