<!DOCTYPE HTML>  
<html>
<head>
<title>CHOOSE BUTTON PAGE</title>
</head>
<body>  
<?php
    $servername="localhost";
    $username="root";
    $password="mysql";
    $conn = new mysqli($servername, $username, $password);
    if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
    }
    $sql = "CREATE DATABASE bahri_inan";
    $dbname="bahri_inan";
    if ($conn->query($sql) === TRUE) {
            echo "Database created successfully";
            echo "<br />\n";
            $conn = mysqli_connect($servername,$username,$password,$dbname);
            if(!$conn){
                die("Connection Failed". mysqli_connect_error());
            }
            $sql = "CREATE TABLE DsandCt(City_name VARCHAR(50) NOT NULL,Region VARCHAR(50) NOT NULL)";
            if(mysqli_query($conn,$sql)){
                echo "Cities table created successfully";
                echo "<br />\n";
            }
            else{
                echo "Error creating cities table: " . mysqli_error($conn);
                echo "<br />\n";
            }
            $conn = mysqli_connect($servername,$username,$password,$dbname);
            if(!$conn){
                die("Connection Failed". mysqli_connect_error());
            }
            $sql = "CREATE TABLE Market(id INT(6) UNSIGNED AUTO_INCREMENT PRIMARY KEY,market_name VARCHAR(50) NOT NULL,city_name VARCHAR(50) NOT NULL)";
            if(mysqli_query($conn,$sql)){
                echo "Market Table created successfully";
                echo "<br />\n";
            }
            else{
                echo "Error creating Market table: " . mysqli_error($conn);
                echo "<br />\n";
            }
            $conn = mysqli_connect($servername,$username,$password,$dbname);
            if(!$conn){
                die("Connection Failed". mysqli_connect_error());
            }
            $sql = "CREATE TABLE Salesman(id INT(6) UNSIGNED AUTO_INCREMENT PRIMARY KEY,name VARCHAR(50) NOT NULL,surname VARCHAR(50) NOT NULL, market_id INT(6) NOT NULL)";
            if(mysqli_query($conn,$sql)){
                echo "Salesman Table created successfully\n";
                echo "<br />\n";
            }
            else{
                echo "Error creating Salesman table\n: " . mysqli_error($conn);
                echo "<br />\n";
            }
            $conn = mysqli_connect($servername,$username,$password,$dbname);
            if(!$conn){
                die("Connection Failed". mysqli_connect_error());
            }
            $sql = "CREATE TABLE Customer(id INT(6) UNSIGNED AUTO_INCREMENT PRIMARY KEY,name VARCHAR(50) NOT NULL,surname VARCHAR(50) NOT NULL)";
            if(mysqli_query($conn,$sql)){
                echo "Customer Table created successfully\n";
                echo "<br />\n";
            }
            else{
                echo "Error creating Customer table\n: " . mysqli_error($conn);
                echo "<br />\n";
            }
            $conn = mysqli_connect($servername,$username,$password,$dbname);
            if(!$conn){
                die("Connection Failed". mysqli_connect_error());
            }
            $sql = "CREATE TABLE Product(id INT(6) UNSIGNED AUTO_INCREMENT PRIMARY KEY,name VARCHAR(50) NOT NULL)";
            if(mysqli_query($conn,$sql)){
                echo "Product Table created successfully";
                echo "<br />\n";
            }
            else{
                echo "Error creating Product table\n: " . mysqli_error($conn);
                echo "<br />\n";
            }
            $conn = mysqli_connect($servername,$username,$password,$dbname);
            if(!$conn){
                die("Connection Failed". mysqli_connect_error());
            }
            $sql = "CREATE TABLE Sale(id INT(6) UNSIGNED AUTO_INCREMENT PRIMARY KEY,salesman_id INT(6) NOT NULL,customer_id INT(6) NOT NULL,product_id INT(6) NOT NULL,price INT(6) NOT NULL,sale_date Date)";
            if(mysqli_query($conn,$sql)){
                echo "Sale Table created successfully\n";
                echo "<br />\n";
            }
            else{
                echo "Error creating Sale table\n: " . mysqli_error($conn);
                echo "<br />\n";
            }
            //read csv files begins and put the datas in tables //////
            $conn = new mysqli($servername,$username,$password,$dbname);
            if ($conn->connect_error) {
                die("Connection failed: " . $conn->connect_error);
            } 
            $ct_name=array();
            $file = fopen("city.csv","r");
            $ct_name=(fgetcsv($file));
            fclose($file);
            $dst_name=array();
            $file = fopen("dst.csv","r");
            $dst_name = (fgetcsv($file));
            fclose($file);
            for($x=0; $x < 81; $x++){
                $sql = "INSERT INTO DsandCt (City_name,Region) VALUES ('$ct_name[$x]','$dst_name[$x]')";
                $conn->query($sql);
            }
            $mname = array("bim", "a-101", "sok", "dia", "snowy","real","migros","kipa","berka","carrefour");
            $sql = "SELECT City_name FROM DsandCt";
            $result = $conn->query($sql);
            while($row = $result->fetch_assoc()){
                $number = array_rand($mname,5);
                for($i=0;$i<5;$i++){
                    $val=$mname[$number[$i]];
                    $sql="INSERT INTO Market(market_name,city_name) VALUES ('$val','$row[City_name]')";
                    $conn->query($sql);
                }
            } 
            $name_list = array();
            $surname_list = array();
            $product_list = array();
            $file = fopen("name.csv","r");
            $name_list = (fgetcsv($file));
            fclose($file);
            $file = fopen("surname.csv","r");
            $surname_list = (fgetcsv($file));
            fclose($file);
            $file = fopen("product.csv","r");
            $product_list = (fgetcsv($file));
            for($i=0; $i<1620; $i++){
                $random_names = $name_list[rand(0,500)];
                $random_surnames = $surname_list[rand(0,500)];
                $sql = "INSERT INTO Customer (name,surname) VALUES ('$random_names','$random_surnames')";
                $conn->query($sql);
            }
            $mid = 1;
            $counter=0;
            for($i = 0; $i < 1215; $i++){
                $random_names = $name_list[rand(0,500)];
                $random_surnames = $surname_list[rand(0,500)];
                if($counter > 2){
                    $mid++;
                    $counter = 0;
                }
                $sql = "INSERT INTO Salesman (name,surname,market_id) VALUES ('$random_names','$random_surnames',$mid)";
                $conn->query($sql);
                $counter++;
            }
            for($i = 0; $i < 200; $i++){
                $product_name = $product_list[$i];
                $sql = "INSERT INTO Product (name) VALUES ('$product_name')";
                $conn->query($sql);
            }
            $sql = "SELECT * FROM Customer";
            $result = $conn->query($sql);
            while($row = $result->fetch_assoc()){
                for($i = 0; $i < rand(1,5); $i++){
                    $productid = rand(1,200);
                    $customerid = $row[id];
                    $salesmanid = rand(1,1215);
                    $price = rand(1,30);
                    $fdate = strtotime("23 JULY 1991");
                    $ldate = strtotime("23 JULY 2016");
                    $timer = mt_rand($fdate,$ldate);
                    $rdate = date("Y-m-d",$timer);
                    $sql = "INSERT INTO Sale(salesman_id,customer_id,product_id,price,sale_date) VALUES ('$salesmanid','$customerid','$productid','$price','$rdate')";
                    $conn->query($sql);
                }
            } 
            if ($conn->query($sql) === TRUE) {
                echo "csv files are readed and inserted to the tables successfully";
            }           
            else {
                echo "Error: " . $sql . "<br>" . $conn->error;
            }
    }   
    else {
        echo "Error creating database\n: " . $conn->error;
        echo "<br />\n";
    }
    $conn->close();
?>
<form action="ShowCitySalesInformation.php" method="post">
<input type="submit" value="A"/>
</form>
<form action="MarketSalesInformation.php" method="post">
<input type="submit" value="B"/>
</form>
<form action="graph.php" method="post">
<input type="submit" value="C"/></form>
</body>
</html>