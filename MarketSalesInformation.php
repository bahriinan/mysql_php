<!DOCTYPE HTML>  
<html>
	<head>
		<title>Market CHOOSER</title>
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
    		echo '<form action="MarketSalesInformation.php" method="get"> SELECT A CITY<br> <select name="city">';
    		$sql = "SELECT * FROM DsandCt";
    		$result = $conn->query($sql);
    		while($row = $result->fetch_assoc()){
    			$x=$row[City_name];
    			echo "<option>".$x;
    		}
    		echo '<input type = "submit" value = "Choose a City"></form>';
    		if($_GET['city']){
    			$city=$_GET['city'];
    			$pro="product.php?city=".$city;
    			echo '<form action="'.$pro.'" method = "post"> MARKETS OF '.$city.'<br><br> SELECT A MARKET <br> <select name = "market">';
    			$sql = "SELECT * FROM Market WHERE city_name = '$city'";
    			$result = $conn->query($sql);
    			while($row = $result->fetch_assoc()){
    				$x=$row[market_name];
    				echo "<option>".$x;
    			}
    			echo '</select> <br> <input type = "submit" name = "prod" value ="PRODUCT"><input type = "submit" name = "saleman" value="SALESMAN"></form>';
    			$mname;
    		}
		?>
	</body>
</html>