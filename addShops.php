<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="UTF-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <link
      href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/css/bootstrap.min.css"
      rel="stylesheet"
    />
    <title>Add Shops || </title>
  </head>
  <body>
    <?php
    require "db.php";
    if($_SERVER['REQUEST_METHOD']=="POST"){
       $shopName = $_POST['shopName'];
       $nickName = $_POST['nickName'];
       $number = $_POST['number'];
       $tenantName = $_POST['tenantName'];
       $tenantAdd = $_POST['tenantAdd'];
       $lateFee = $_POST['lateFee'];
       
       $sql = "INSERT INTO `shops` (`shopName` ,`nickName`,`number` , `tenantName` , `tenantAddress`, `lateFee`) VALUES ('$shopName' ,'$nickName', '$number' , '$tenantName' , '$tenantAdd', '$lateFee')";
       $result = mysqli_query($conn , $sql);
       header('Location: home.php');
      
    }
    
    ?>
   
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/js/bootstrap.bundle.min.js"></script>
  </body>
</html>
