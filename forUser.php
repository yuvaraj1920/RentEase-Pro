<?php
require 'db.php';
if($_SERVER['REQUEST_METHOD']=='POST'){
  $shopName = $_POST['shopName'];
  $sql = "select * from `shops` where shopName='$shopName'";
  $result =  mysqli_query($conn, $sql);
  if(mysqli_num_rows($result) == 0){
    $sql = "select shopName from `shops` where nickName='$shopName'";
    $result =  mysqli_query($conn, $sql);
  }
}

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/css/bootstrap.min.css" rel="stylesheet" >
    <title>Shop Details</title>
</head>
<body>
    <div class="container-fluid">
        <div class="row">
            <div class="col-md-10 col-10 mx-auto overflow-auto">
            <?php
                require 'db.php';
                if($_SERVER['REQUEST_METHOD']=='POST'){
                  $shopName = $_POST['shopName'];
                  $sql = "select * from `shops` where shopName='$shopName'";
                  $result =  mysqli_query($conn, $sql);
                  if(mysqli_num_rows($result) == 0){
                    $sql = "select shopName from `shops` where nickName='$shopName'";
                    $result =  mysqli_query($conn, $sql);
                  }
               if(mysqli_num_rows($result) == 0){
                    //  echo "<h3 class='text-center'>No Details Available</h3>";
                 }
                  else{
                   while($row = mysqli_fetch_assoc($result) ){
                     $shopName = $row['shopName'];   
                    }
                   $sql ="select  *  from `$shopName` ";
                  $result = mysqli_query($conn , $sql);
                

                  echo "<h3 class='text-center my-3'>Shop Name : $shopName</h3>";
                  }
               
                    }
            ?>
                 
                 


            <table class="table status-table overflow-auto my-4 "  id="shopsContent" border="1" >
            <thead class="table-success">
              <tr>
               
                <th>Month With Year</th>
                <th>Actual Amount</th>
                <th>Amount Received</th>
                <th>Balance</th>
                <th>Paid By</th>
                <th>Paid Date</th>
                <th>Transaction Id</th>
                
              </tr>
            </thead>
            <tbody>
              <tr>
              <?php
                  require 'db.php';
                  if($_SERVER['REQUEST_METHOD']=='POST'){
                      $shopName = $_POST['shopName'];
                      $sql = "select * from `shops` where shopName='$shopName'";
                      $result =  mysqli_query($conn, $sql);
                      if(mysqli_num_rows($result) == 0){
                        $sql = "select shopName from `shops` where nickName='$shopName'";
                        $result =  mysqli_query($conn, $sql);
                      }
                   if(mysqli_num_rows($result) == 0){
                    echo "<h3 class='text-center'>No Details Available</h3>";
                     }
                  else{
                    while($row = mysqli_fetch_assoc($result) ){
                      $shopName = $row['shopName'];   
                     }
                     $sql ="select  *  from `$shopName` ";
                    $result = mysqli_query($conn , $sql);
                    
                    while($row = mysqli_fetch_assoc($result)){
                    
                      echo "<tr><td>".$row['monthWithYear']."</td>
                     <td>".$row['actualAmount']."</td>
                     <td>".$row['amountReceived']."</td>
                     <td>".$row['balance']."</td>
                     <td>".$row['paidBy']."</td>
                     <td>".$row['paidDate']."</td>
                     <td>".$row['transId']."</td></tr>";
                     echo "<br>";
                    }
                   }
                  }
                  ?>
              </tr>
            </tbody>
          </table>
            </div>
        </div>
    </div>
</body>
</html>