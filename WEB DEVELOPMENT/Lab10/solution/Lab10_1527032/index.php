<!DOCTYPE html>
<html lang="zxx">
<head>
	<meta charset="UTF-8">
	<title>Lab10_1527032</title>
	<link rel="stylesheet" type="text/css" href="style.css">
	<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.1.1/jquery.min.js"></script>
	<script>
		function insertrow()
		{
			var id = document.getElementById("id_add").value;
			var name = document.getElementById("name_add").value;
			var year = document.getElementById("year_add").value;
			$.ajax({
				// The link we are accessing.
				url: "ajax.php?operation=insert&id=" + id + "&name=" + name + "&year=" + year,
					
				// The type of request.
				type: "get",
					
				// The type of data that is getting returned.
				dataType: "html",

				success: function( strData ){	
					var result = JSON.parse(strData);
					$("#id_err").text(result[0]);
					$("#name_err").text(result[1]);
					$("#year_err").text(result[2]);
					$("#info_add").text(result[3]);
					$("#table").html(result[4]);
				}
			});
		}
		function deleterow()
		{
			var id = document.getElementById("id_delete").value;
			var name = document.getElementById("name_delete").value;
			var year = document.getElementById("year_delete").value;
			$.ajax({
				// The link we are accessing.
				url: "ajax.php?operation=delete&id=" + id + "&name=" + name + "&year=" + year,
					
				// The type of request.
				type: "get",
					
				// The type of data that is getting returned.
				dataType: "html",

				success: function( strData ){
					var result = JSON.parse(strData);
					$("#info_delete").text(result[0]);
					$("#delete_err").text(result[1]);
					$("#table").html(result[2]);
				}
			});
		}
		function updaterow()
		{
			var id_to = document.getElementById("id_update_to").value;
			var name_to = document.getElementById("name_update_to").value;
			var year_to = document.getElementById("year_update_to").value;
			var id_from = document.getElementById("id_update_from").value;
			var name_from = document.getElementById("name_update_from").value;
			var year_from = document.getElementById("year_update_from").value;
			$.ajax({

				url: "ajax.php?operation=update" + "&id_to=" + id_to + "&name_to=" + name_to + "&year_to=" + year_to + "&id_from=" + id_from + "&name_from=" + name_from + "&year_from=" + year_from,
					
				type: "get",
				
				dataType: "html",

				success: function( strData ){
					var result = JSON.parse(strData);
					$("#name_update_err").text(result[0]);
					$("#year_update_err").text(result[1]);
					$("#info_update").text(result[2]);
					$("#update_err").text(result[3]);
					$("#table").html(result[4]);
				}
			});
		}
	</script>
</head>
<body>
	<div id="menu">
		<form>
		<h3 class="title">INSERT</h3>
		ID: 
		<input type="number" id="id_add"><span class="error" id="id_err"></span><span class="info" id="info_add"></span><br/><br/>
		Name:
		<input type="text" id="name_add"><span class="error" id="name_err"></span><br/><br/>
		Year:
		<input type="number" id="year_add"><span class="error" id="year_err"></span><br/><br/>
		<input type="button" onclick="insertrow()" name="add" value="INSERT"><br/><br/>
		</form>
		 <!--form delete record -->
		<form>
			<h3 class="title">DELETE</h3>
			ID: 
			<input type="number" id="id_delete"><span class="info" id="info_delete"></span><br/><br/>
			Name:
			<input type="text" id="name_delete"><br/><br/>
			Year:
			<input type="number" id="year_delete"><span class="error" id="delete_err"></span><br/><br/>
			<input type="button" onclick="deleterow()" name="delete" value="DELETE"><br/><br/>
		</form>
		<!--form update record -->
		<form>
			<h3 class="title">UPDATE</h3>
			<div id="updatefrom">
				<h5>Old Infomation</h5>
				ID: 
				<input type="number" id="id_update_from"><br/><br/>
				Name:
				<input type="text" id="name_update_from"><br/><br/>
				Year:
				<input type="number" id="year_update_from">
			</div>
			<div id="updateto">
				<h5>New Information</h5>
				ID: 
				<input type="number" id="id_update_to"><br/><br/>
				Name:
				<input type="text" id="name_update_to"><span class="error" id="name_update_err"></span><br/><br/>
				Year:
				<input type="number" id="year_update_to"><span class="error" id="year_update_err"></span><br/><br/>
				<input type="button" onclick="updaterow()" name="update" value="UPDATE"><br/><br/>
			</div>
			
			<span class="info" id="info_update"></span>
			<span class="error" id="update_err"></span>
		</form>
	</div>
	
	<div id="table">
		<?php 
			$username = "root";
			$password = "";
			$hostname = "localhost"; 
			$dbname = "examples";
			$conn = new mysqli($hostname, $username, $password, $dbname);

			if ($conn->connect_error) {
			    die("Connection failed: " . $conn->connect_error);
			} 
			//execute the SQL query and return records
			$sql = "SELECT id, name, year FROM cars";
			$result = $conn->query($sql);
			if ($result->num_rows > 0) {
				echo"<h3 class=\"title\">CARS</h3>
					 <table>
						<tr>
						<th>ID</th>
						<th>Name</th>
						<th>Year</th>
						</tr>";
				while ($row = $result->fetch_assoc()) {
				   echo "<tr>
				   			<td>".$row['id']."</th>".
				   			"<td>".$row['name']."</th>".
				   			"<td>".$row['year']."</th>".
				   		"</tr>";
				}
				echo "</table";
			}
			$conn->close();
		?> 
	</div>
</body>
</html>