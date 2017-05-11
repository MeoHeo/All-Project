<?php  
		$username = "root";
		$password = "";
		$hostname = "localhost"; 
		$dbname = "examples";
		$info_add = "";
		$info_delete = "";
		$info_update = "";
		$id_add_err = "";
		$name_add_err = "";
		$year_add_err = "";
		$err = 0;
		$err_update = 0;
		$sql_delete_id = "";
		$sql_delete_name = "";
		$sql_delete_year = "";
		$sql_update_id = "";
		$sql_update_name = "";
		$sql_update_year = ""; 
		$sql_update = "";
		$name_update_err = "";
		$year_update_err = "";
		$update_err = "";
		$delete_err = "";
			if ($_REQUEST["operation"] == "insert") {
				if (empty($_REQUEST["id"])) {
					$id_add_err = "* ID is required";
					$err = 1;
				}
				if (empty($_REQUEST["name"])) {
					$name_add_err = "* Name is required";
					$err = 1;
				}
				elseif (!test_name($_REQUEST["name"])) {
				 	$name_add_err = " Lenght of name must be from 5 to 40";
					$err = 1;
				 }
				 if (empty($_REQUEST["year"])) {
					$year_add_err = "* Year is required";
					$err = 1;
				}
				elseif (!test_year($_REQUEST["year"])) {
				 	$year_add_err = " Year must be from 1990 to 2015.";
					$err = 1;
				 } 
           		if ($err == 0) {
           			$conn = new mysqli($hostname, $username, $password, $dbname);
					// Check connection
					if ($conn->connect_error) {
					    die("Connection failed: " . $conn->connect_error);
					}
           			$id = test_input($_REQUEST["id"]);
					$name = test_input($_REQUEST["name"]);
					$year = test_input($_REQUEST["year"]);
					$sql = "INSERT INTO Cars (id, name, year)
					VALUES ('$id', '$name', '$year')";
					if ($conn->query($sql) === TRUE) {
					    $info_add = " Operation was completed";
					} else {
					    echo "Error: " . $sql . "<br>" . $conn->error;
					}
					$conn->close();
	           	}
			}
			if ($_REQUEST["operation"] == "delete") {
				//$id_delete = $name_delete = $year_delete = "";
				if (empty($_REQUEST["id"])) {
					$sql_delete_id = "id LIKE '%%'";
				}
				else {
					$id_delete = test_input($_REQUEST["id"]);
					$sql_delete_id = "id =".$id_delete;
					$err = 1;
				}
				if (empty($_REQUEST["name"])) {
					$sql_delete_name = "name LIKE '%%'";
				}
				else {
					$name_delete = test_input($_REQUEST["name"]);
					$sql_delete_name = "name ="."'".$name_delete."'";
					$err = 1;
				}
				if (empty($_REQUEST["year"])) {
					$sql_delete_year = "year LIKE '%%'";
				}
				else {
					$year_delete = test_input($_REQUEST["year"]);
					$sql_delete_year = "year =".$year_delete;
					$err = 1;
				}
				if ($err == 1) {
           			$conn = new mysqli($hostname, $username, $password, $dbname);
					// Check connection
					if ($conn->connect_error) {
					    die("Connection failed: " . $conn->connect_error);
					}
					$sql = "DELETE FROM Cars WHERE ".$sql_delete_id." and ".$sql_delete_name." and ".$sql_delete_year;
					if ($conn->query($sql) === TRUE) {
					    $info_delete = " Operation was completed";
					} else {
					    echo "Error: " . $sql . "<br>" . $conn->error;
					}
					$conn->close();
	           	}
	           	else {
	           		$delete_err = " Must have at least one field to update!";
	           	}
			}
			if ($_REQUEST["operation"] == "update") {
				//$id_from = $id_to = $name_from = $name_to = $year_from = $year_to = "";
				if (empty($_REQUEST["id_from"])) {
					$sql_update_id = "id LIKE '%%'";
				}
				else {
					$id_from = test_input($_REQUEST["id_from"]);
					$sql_update_id = "id =".$id_from;
					$err = 1;
				}
				if (empty($_REQUEST["name_from"])) {
					$sql_update_name = "name LIKE '%%'";
				}
				else {
					$name_from = test_input($_REQUEST["name_from"]);
					$sql_update_name = "name ="."'".$name_from."'";
					$err = 1;
				}
				if (empty($_REQUEST["year_from"])) {
					$sql_update_year = "year LIKE '%%'";
				}
				else {
					$year_from = test_input($_REQUEST["year_from"]);
					$sql_update_year = "year =".$year_from;
					$err = 1;
				}
				if (empty($_REQUEST["id_to"]) and empty($_REQUEST["name_to"]) and empty($_REQUEST["year_to"])) {
					$update_err = "Must have at least one field to update!";
					$err_update = 1;
				}
				elseif(!empty($_REQUEST["id_to"]) and empty($_REQUEST["name_to"]) and empty($_REQUEST["year_to"])) {
					$id_to = test_input($_REQUEST["id_to"]);
					$sql_update = "id = ".$id_to;
				}
				elseif(empty($_REQUEST["id_to"]) and !empty($_REQUEST["name_to"]) and empty($_REQUEST["year_to"])) {
					if (!test_name($_REQUEST["name_to"])) {
						$err_update = 1;
						$name_update_err = "Lenght of name must be from 5 to 40";
					}
					$name_to = test_input($_REQUEST["name_to"]);
					$sql_update = "name = "."'".$name_to."'";
				}
				elseif(empty($_REQUEST["id_to"]) and empty($_REQUEST["name_to"]) and !empty($_REQUEST["year_to"])) {
					if (!test_year($_REQUEST["year_to"])) {
						$err_update = 1;
						$year_update_err = "Year must be from 1990 to 2015";
					}
					$year_to = test_input($_REQUEST["year_to"]);
					$sql_update = "year = ".$year_to;
				}
				elseif(!empty($_REQUEST["id_to"]) and !empty($_REQUEST["name_to"]) and empty($_REQUEST["year_to"])) {
					if (!test_name($_REQUEST["name_to"])) {
						$err_update = 1;
						$name_update_err = "Lenght of name must be from 5 to 40";
					}
					$name_to = test_input($_REQUEST["name_to"]);
					$id_to = test_input($_REQUEST["id_to"]);
					$sql_update = "id = ".$id_to.", name = "."'".$name_to."'";
				}
				elseif(empty($_REQUEST["id_to"]) and !empty($_REQUEST["name_to"]) and !empty($_REQUEST["year_to"])) {
					if (!test_year($_REQUEST["year_to"])) {
						$err_update = 1;
						$year_update_err = "Year must be from 1990 to 2015";
					}
					if (!test_name($_REQUEST["name_to"])) {
						$err_update = 1;
						$name_update_err = "Lenght of name must be from 5 to 40";
					}
					$name_to = test_input($_REQUEST["name_to"]);
					$year_to = test_input($_REQUEST["year_to"]);
					$sql_update = "name = "."'".$name_to."'".",year = ".$year_to;
				}
				elseif(!empty($_REQUEST["id_to"]) and empty($_REQUEST["name_to"]) and !empty($_REQUEST["year_to"])) {
					if (!test_year($_REQUEST["year_to"])) {
						$err_update = 1;
						$year_update_err = "Year must be from 1990 to 2015";
					}
					$id_to = test_input($_REQUEST["id_to"]);
					$year_to = test_input($_REQUEST["year_to"]);
					$sql_update = "id = ".$id_to.",year = ".$year_to;
				}
				else {
					if (!test_year($_REQUEST["year_to"])) {
						$err_update = 1;
						$year_update_err = "Year must be from 1990 to 2015";
					}
					if (!test_name($_REQUEST["name_to"])) {
						$err_update = 1;
						$name_update_err = "Lenght of name must be from 5 to 40";
					}
					$id_to = test_input($_REQUEST["id_to"]);
					$name_to = test_input($_REQUEST["name_to"]);
					$year_to = test_input($_REQUEST["year_to"]);
					$sql_update = "id = ".$id_to.",name = "."'".$name_to."'".",year = ".$year_to;
				}
				if ($err == 1 and $err_update == 0) {
           			$conn = new mysqli($hostname, $username, $password, $dbname);
					// Check connection
					if ($conn->connect_error) {
					    die("Connection failed: " . $conn->connect_error);
					}
					$sql = "UPDATE Cars SET ".$sql_update." WHERE ".$sql_update_id." and ".$sql_update_name." and ".$sql_update_year;
					if ($conn->query($sql) === TRUE) {
					    $info_update = "Operation was completed";
					} else {
					    echo "Error: " . $sql . "<br>" . $conn->error;
					}
					$conn->close();
	           	}
			}
		function test_input($data) {
		    $data = trim($data);
			$data = stripslashes($data);
			$data = htmlspecialchars($data);
			return $data;
		}
		function test_name($data) {
			if(strlen($data)<5 or strlen($data)>40)
				return false;
			else return true;
		}
		function test_year($data) {
			if ($data<1990 or $data>2015) 
				return false;
			else return true;
		}
	?>

	<?php 
		$conn = new mysqli($hostname, $username, $password, $dbname);

		// Check connection
		if ($conn->connect_error) {
		    die("Connection failed: " . $conn->connect_error);
		} 
		//execute the SQL query and return records
		$datatable = "";
		$sql = "SELECT id, name, year FROM cars";
		$result = $conn->query($sql);
		if ($result->num_rows > 0) {
			$datatable = "<h3 class=\"title\">CARS</h3><table><tr><th>ID</th><th>Name</th><th>Year</th></tr>";
			while ($row = $result->fetch_assoc()) {
			   $datatable
			   = $datatable."<tr><td>".$row['id']."</th>"."<td>".$row['name']."</th>"."<td>".$row['year']."</th>"."</tr>";
			}
			$datatable = $datatable."</table>";	
		}
		$conn->close();
		if ($_REQUEST["operation"] == "insert") {
			echo json_encode(array($id_add_err,$name_add_err,$year_add_err,$info_add,$datatable));
		}
		if ($_REQUEST["operation"] == "delete") {
			echo json_encode(array($info_delete,$delete_err,$datatable));
		}
		if ($_REQUEST["operation"] == "update") {
			echo json_encode(array($name_update_err,$year_update_err,$info_update,$update_err,$datatable));
		}
		
	?> 