<!DOCTYPE HTML>  
<html>
<head>
<title>ShowCitySalesInformation</title>
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
    echo '<form action="ShowCitySalesInformation.php" method="get"> SELECT A CITY <br> <select name="city">';
    $sql = "SELECT * FROM DsandCt";
    $result = $conn->query($sql);
    while($row = $result->fetch_assoc()){
    	$x=$row[City_name];
    	echo "<option>".$x;
    }
    echo '</select><br><input type="submit" value="Choose a city"></form>';
    if($_GET['city']){
    	$city = $_GET['city'];
    	$sql = "SELECT market.market_name, market.id, COUNT( sale.product_id ) AS TOTAL FROM market INNER JOIN salesman ON salesman.market_id = market.id INNER JOIN sale ON sale.salesman_id = salesman.id WHERE market.city_name =  '$city' GROUP BY market.market_name";
    	$result = $conn->query($sql);
    	echo $city;
    	echo '<br>';
    	$mname = array();
    	$product_count = array();
    	echo '<td>Name</td><td>          </td><td>Total</td>';
    	while($row = $result->fetch_assoc()){
    		echo '<br>';
    		echo "<tr><td>".$row['market_name']."</td><td>          </td><td>".$row['TOTAL']."</td></tr>";
    		array_push($mname,$row['market_name']);
    		array_push($product_count,$row['TOTAL']);
    	}
    }
?>
</body>
</html>