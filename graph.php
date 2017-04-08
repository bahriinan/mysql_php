<!DOCTYPE HTML>  
<html>
	<head>
		<title>CHOOSE A GRAPH</title>
	</head>
	<body>  
		<?php
			$servername = "localhost";
    		$username = "root";
    		$password = "mysql";
    		$dbname = "bahri_inan";
    		$conn = new mysqli($servername, $username, $password,$dbname);
    		if ($conn->connect_error) {
        		die("Connection failed: " . $conn->connect_error);
    		}
    		echo '<form action = "chart.php" method = "post">';
    		echo '<input type = "submit" name = "A" value = "Draw a piechart on all sales divided into districts"><br><input type = "submit" name = "B" value = "Draw a piechart on all sales divided into markets"></form>';
?>
	</body>
</html>