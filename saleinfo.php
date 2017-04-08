<!DOCTYPE HTML>  
<html>
    <head>
        <title>SALE INFO</title>
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
            $salid = $_GET['sid'];
            $sehir =  $_GET['city'];
            $marmar = $_GET['marname'];
            $sql = "SELECT sale.id AS ider, sale.product_id AS procer, sale.customer_id AS custer, sale.salesman_id AS saler, sale.price AS princer, sale.sale_date AS dater FROM sale INNER JOIN salesman ON sale.salesman_id = salesman.id INNER JOIN market ON salesman.market_id = market.id INNER JOIN dsandct ON market.city_name = dsandct.City_name WHERE dsandct.City_name =  '$sehir' AND market.market_name = '$marmar' AND salesman.id ='$salid'";
            echo'<table border="1"><tr><td>id</td><td>salesman_id</td><td>customer_id</td><td>product_id</td><td>price</td><td>date</td></tr>';
            $result =  $conn->query($sql);
            $cid=0;
            $ssid=0;
            while($row = $result->fetch_assoc()) {
                $z="customerinfo.php?city=".$city."&cid=".$row[custer]."&mkname=".$marname."&ssid=".$row[saler];
                echo '<tr><td>'.$row[ider].'</td><td>'.$row[saler].'</td><td><a href="'.$z.'">'.$row[custer].'</a></td><td>'.$row[procer].'</td><td>'.$row[princer].'</td><td>'.$row[dater].'</td></tr>';
            }
            echo "</table>";

        ?>
    </body>
</html>         