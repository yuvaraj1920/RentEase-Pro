<?php
$serverName = "localhost";
$userName = "root";
$password = "Ganesh@7081";
$dataBase = "shops";

$conn = mysqli_connect($serverName , $userName , $password , $dataBase);
if(!$conn){
    echo "Error";
}else{
    // echo "success";
}
$query = "CREATE TABLE if not exists `shops` (
    id INT AUTO_INCREMENT primary key NOT NULL,
    shopName varchar(255),
    nickName varchar(100),
   number varchar(12),
   tenantName varchar(250),
   tenantAddress varchar(250),
   lateFee varchar(25)
)";
$checkQuery = mysqli_query($conn , $query);

?>