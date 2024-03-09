<?php
session_start();
$_SESSION['forShop'] = $_GET['checkShop'];
$forShop = $_SESSION['forShop'];

require "db.php";
// $checkId = $_GET['checkId'];
 
$sql = "CREATE TABLE if not exists `$forShop` (
     id INT AUTO_INCREMENT primary key NOT NULL,
    monthWithYear varchar(255),
    actualAmount varchar(25),
    amountReceived varchar(25),
    balance varchar(25),
    paidBy varchar(255),
    paidDate varchar(50),
    transId varchar(250)
)";
$result = mysqli_query($conn , $sql);
if($result){
    
}

?>



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
    <link rel="stylesheet" href="index.css" />

    <title>Status-Shops</title>
  </head>
  <body>
    <div class="header">
      <div class="container-fluid">
        <div class="row">
          <div class="col-md-10 col-10 mx-auto for-header">
            <h2 class="text-center">Welcome to Our Shops</h2>
          </div>
        </div>
      </div>
    </div>
    <div class="shop-detail">
    <div class="container-fluid">
    <div class="row mt-2">
        <div class="col-10 col-md-10 mx-auto">
    <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#exampleModal">
  Add details
</button>
</div>
</div>
</div>
              <div class="modal fade" tabindex="-1" id="exampleModal">
            <div class="modal-dialog">
              <div class="modal-content">
                <div class="modal-header">
                  <h5 class="modal-title">Enter Details</h5>
                  <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                <form action="addShopData.php"  method="post" onsubmit="notChange()">
                        <!-- <div class="mb-3">
                          <label for="exampleInputEmail1" class="form-label">id</label>
                          <input type="number" class="form-control" name="id" id="id" >
                          
                        </div> -->
                        <div class="mb-3">
                          <label for="exampleInputPassword1" class="form-label">Enter Month With Year:</label>
                          <input type="text" name="monthWithYear" class="form-control" id="exampleInputPassword1">
                        </div>
                        <div class="mb-3">
                            <label class="form-label" for="exampleCheck1">Actual amount :</label>
                          <input type="number" class="form-control" name="actualAmount" id="actualAmount">
                        </div>
                        <div class="mb-3">
                            <label class="form-label" for="exampleCheck1">Amount Received :</label>
                          <input type="number" class="form-control" name="amountReceived" id="amountReceived">
                        </div>
                        
                        <div class="mb-3">
                            <label class="form-label" for="exampleCheck1">Paid By :</label>
                          <input type="text" class="form-control" name="paidBy" id="paidBy">
                        </div>
                        <div class="mb-3">
                            <label class="form-label" for="exampleCheck1">Paid Date :</label>
                          <input type="text" class="form-control" name="paidDate" id="paidDate">
                        </div>
                        <div class="mb-3">
                            <label class="form-label" for="exampleCheck1">Transaction Id :</label>
                          <input type="text" class="form-control" name="transId" id="transId">
                        </div>
                        <button type="submit" class="btn btn-primary">Submit</button>
                      </form>
                  
                </div>
                
              </div>
            </div>
          </div>
    </div>
    <section>
      <div class="row my-5 overflow-auto">
        <div class="col-md-10 col-10 mx-auto">
          <table class="table status-table text-center" id="shopsContent" border="1" >
            <thead class="table-success">
              <tr>
              <th class= "fs-5 text-center">
              <?php
                require "db.php";
                // $checkId = $_GET['checkId'];
                $sql = "select * from `shops` where `shopName`='$forShop'";
                $result = mysqli_query($conn , $sql);
                $row = mysqli_fetch_assoc($result);
                echo "Shop Name : " .$row['shopName'];
                ?>
              </th>
              </tr>
              <tr>
               
                <th>Month With Year</th>
                <th>Actual Amount</th>
                <th>Amount Received</th>
                <th>Balance</th>
                <th>Paid By</th>
                <th>Paid Date</th>
                <th>Transaction Id</th>
                <th>Action</th>
                
              </tr>
            </thead>
            <tbody>
             
                <?php
                 require "db.php";
                 // $checkId = $_GET['checkId'];
                 $sql = "select * from `$forShop`";
                 $result = mysqli_query($conn , $sql);
                 $query = "select * from shops where shopName='$forShop'";
                 $result2 = mysqli_query($conn , $query);
                 $hold = mysqli_fetch_assoc($result2);
                 $lateFees = $hold['lateFee'];
                //  $row = mysqli_fetch_assoc($result);
                $totalRent = 0;
                $totalRentReceived = 0;
                $totalAmountToBeReceived = 0;
                $countMonths = 0;
                $totalLateFee = 0;
                $status = "";
                $MonthlylateFee = [];
                $index = 0;
                 while($row = mysqli_fetch_assoc($result) ){
                  $totalRent = $totalAmountToBeReceived;
                  if((int)$row['amountReceived'] != 0){
                    // $status = "paid";
                  $countMonths = 0;
                  $totalRent = $totalRent + (int)$row['actualAmount'] + $totalLateFee;
                  $totalLateFee = 0;
                  $totalRentReceived = $totalRentReceived + (int)$row['amountReceived'];
                  $totalAmountToBeReceived = $totalRent - $totalRentReceived;
                  }
                  else{
                    // $status = "unpaid";
                    $countMonths = $countMonths + 1;
                    if($index == 0 && $countMonths >= 1){
                      $MonthlylateFee[0] = $lateFees;
                      $index++;
                    }
                    else{
                    $ind = 0;
                    for($i = sizeof($MonthlylateFee); $i > 0 ; $i--){
                      $totalLateFee = $totalLateFee + $MonthlylateFee[$ind]*($i+1);
                      $ind++;   
                    } 
                    $MonthlylateFee[$index] = $totalLateFee + $lateFees;
                    $index++;
                  }
                     $rent = $totalLateFee + $lateFees;
                    $totalLateFee = 0;

                    $totalRent = $totalAmountToBeReceived + (int)$row['actualAmount'] + $rent;
                    $totalRentReceived = (int)$row['amountReceived'];
                    $totalAmountToBeReceived =  $totalRent - $totalRentReceived;
                  } 
                     echo "<tr><td>".$row['monthWithYear']."</td>
                     <td>".$row['actualAmount']."</td>
                     <td>".$row['amountReceived']."</td>
                     <td>".$row['balance']."</td>
                     <td>".$row['paidBy']."</td>
                     <td>".$row['paidDate']."</td>
                     <td>".$row['transId']."</td>
                     <td><a href='delete.php?deleteId=".$row['id']."'>delete</a></td></tr>";
                     echo "<br>";  
                  } 
                  echo "<tr><td><strong>Total Rent</strong></td>
                  <td><strong>".$totalRent."</strong></td>
                  <td><strong>".$totalRentReceived."</strong></td>
                  <td><strong>".$totalAmountToBeReceived." To Be Received</strong></td></tr>" ;
                   
                      
                ?>

             
            </tbody>
          </table>
          <button class="btn btn-outline-primary" onclick="exportTableToExcel('shopsContent')">Export Table Data To Excel File</button>
        </div>
      </div>
    </section>
    <section>
        <div class="container">
            <div class="row">
                <div class="col-10 col-md-4 mx-auto">
                  
          
                   
                      
                     
                   
                     
                      
                </div>
            </div>
        </div>
    </section>
   
    
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/js/bootstrap.bundle.min.js"></script>
    <script>
        function notChange(e){
            e.preventDefault();

        }
        function exportTableToExcel(tableID, filename = ''){
    var downloadLink;
    var dataType = 'application/vnd.ms-excel';
    var tableSelect = document.getElementById(tableID);
    var tableHTML = tableSelect.outerHTML.replace(/ /g, '%20');
    filename = filename?filename+'.xls':'excel_data.xls';
    downloadLink = document.createElement("a");
    
    document.body.appendChild(downloadLink);
    
    if(navigator.msSaveOrOpenBlob){
        var blob = new Blob(['\ufeff', tableHTML], {
            type: dataType
        });
        navigator.msSaveOrOpenBlob( blob, filename);
    }else{
        downloadLink.href = 'data:' + dataType + ', ' + tableHTML;
        downloadLink.download = filename;
        downloadLink.click();
    }
}
    </script>
  </body>
</html>
