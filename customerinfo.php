<!DOCTYPE HTML>  
<html>
    <head>
        <title>CUSTOMER INFO</title>
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
            $cuid = $_GET['cid'];
            $ccity = $_GET['city'];
            $marmr=$_GET['mkname'];
            $sid = $_GET['ssid'];
            $sql = "SELECT product.name AS namer, sale.price AS pricer, sale.sale_date AS dater FROM customer INNER JOIN sale ON customer.id = sale.customer_id INNER JOIN product ON sale.product_id = product.id INNER JOIN salesman ON salesman.id = sale.salesman_id INNER JOIN market ON market.id = salesman.market_id INNER JOIN dsandct ON market.city_name = dsandct.City_name WHERE dsandct.City_name ='$ccity' AND market.market_name = '$marmr' AND customer.id ='$cuid' AND salesman.id = '$sid'";
            $result = $conn->query($sql);
            echo'<table border="1"><tr><td>PRODUCT NAME</td><td>SALE PRICE</td><td>DATE</td></tr>';
            while($row = $result -> fetch_assoc()){
                echo '<tr><td>'.$row[namer].'</td><td>'.$row[pricer].'</td><td>'.$row[dater].'</td></tdr>';
                $tp+=$row[pricer];
            }
            echo '</table>';
            echo "<br> TOTAL PRICE".$tp;        
        ?>
  </body>
</html>         