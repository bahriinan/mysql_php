<!DOCTYPE HTML>  
<html>
    <head>
        <title>PIE CHART</title>
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
        if(isset($_POST['A'])){
        	$sql = "SELECT dsandct.Region AS REG, COUNT( * ) AS total FROM sale INNER JOIN salesman ON salesman.id = sale.salesman_id INNER JOIN market ON salesman.market_id = market.id INNER JOIN dsandct ON market.city_name = dsandct.City_name GROUP BY REG";
        	$result = $conn->query($sql);
        	$number=array();
        	$parsel=array();
        	while($row = $result -> fetch_assoc()){
        		array_push($number,$row['total']);
        		array_push($parsel,$row['REG']);
        	}
        	include("draw.php");
        	$x= new DRAW($number,$parsel);
        	echo '<div  class="pie"><img src="image/mypic.png"></div>';
        }
        if(isset($_POST['B'])){
        	$sql = "SELECT market.market_name AS shopname, COUNT( * ) AS total FROM sale INNER JOIN salesman ON salesman.id = sale.salesman_id INNER JOIN market ON market.id = salesman.market_id GROUP BY market.market_name";
        	$result = $conn->query($sql);
        	$number=array();
        	$parsel=array();
        	while($row = $result -> fetch_assoc()){
        		array_push($number,$row['total']);
        		array_push($parsel,$row['shopname']);
        	}
        	include("draw.php");
        	$x= new DRAW($number,$parsel);
        	echo '<div  class="pie"><img src="image/mypic.png"></div>';
        }
	?>
	</body>
</html>