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
    		//echo $_POST['city'];
    		if(isset($_POST['prod'])){
    			$mname=$_POST['market'];
    			$_GET['saleid']=0;
    			$sql = "SELECT product.id, product.name, COUNT(product.id) AS total FROM product INNER JOIN sale ON product.id = sale.product_id INNER JOIN salesman ON sale.salesman_id = salesman.id INNER JOIN market ON salesman.market_id = market.id INNER JOIN dsandct ON market.city_name = dsandct.City_name WHERE dsandct.City_name ='$city' AND market.market_name ='$mname' GROUP BY product.name";
    			$result = $conn->query($sql);
    			while($row = $result->fetch_assoc()){
    				echo '<br>'; 
    				echo '<td>'.$row[name].'</td><td>		</td><td>'.$row[total].'</td>';
    			}
    		}
    		if(isset($_POST['saleman'])){
    			$mname = $_POST['market'];
    			$_GET['saleid']=0;
    			$sql = "SELECT market.market_name AS makname,salesman.id,salesman.name,salesman.surname,COUNT(sale.id) AS total FROM salesman INNER JOIN sale ON salesman.id=sale.salesman_id INNER JOIN  market ON salesman.market_id=market.id WHERE market.city_name='$city' AND market.market_name='$mname' GROUP BY salesman.id";
    			echo "Salesmans in ".$city." at ".$mname;
    			$result = $conn->query($sql);
    			$sid=0;
    			echo '<table border="1"><tr><td>Salesman Name</td><td>Total sales</td></tr>';
    			while($row = $result->fetch_assoc()){
    				if($mname==$row[makname]){
    					echo '<br>';
    					$z="saleinfo.php?city=".$city."&sid=".$row[id]."&marname=".$mname;
    					echo '<tr><td><a href="'.$z.'">'.$row[sname]." ".$row[surname].'</td><td>'.$row[total].'</a></td></tr>';
    				} 
    			}
    		}
		?>
	</body>
</html>    		














