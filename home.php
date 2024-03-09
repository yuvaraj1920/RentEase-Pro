
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/css/bootstrap.min.css" rel="stylesheet" >
    <link rel="stylesheet" href="https://cdn.datatables.net/1.13.2/css/jquery.dataTables.min.css" class="css">
    <link rel="stylesheet" href="index.css">
    <title>HomePage</title>
</head>
<body>
<div class="header">
    <div class="container-fluid">
        <div class="row">
            <div class="col-md-10 col-10 mx-auto for-header">
                <h2 class="text-center ">Welcome to Our Shops</h2>

            </div>
           
        </div>
        
    </div>
 </div>
<div class="container-fluid">
    <div class="row mt-2">
        <div class="col-10 col-md-10 mx-auto">
        <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#exampleModal">
  Add Shop
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
                <form action="addShops.php" method="post">
            <div class="mb-3">
              <label for="exampleFormControlInput1" class="form-label"
                >Enter Shop Name:</label
              >
              <input
                type="text"
                required
                name="shopName"
                class="form-control"
                id="shopName"
              />
            </div>
            <div class="mb-3">
              <label for="exampleFormControlInput1" class="form-label"
                >Enter Shop Nick Name:</label
              >
              <input
                type="text"
                required
                name="nickName"
                class="form-control"
                id="nickName"
              />
            </div>
            <div class="mb-3">
              <label for="exampleFormControlTextarea1" class="form-label"
                >Enter Phone Number:</label
              >
              <input
                type="number"
                required
                name="number"
                class="form-control"
                id="number"
              />
            </div>
            <div class="mb-3">
              <label for="exampleFormControlTextarea1" class="form-label"
                >Enter Tenant Name:</label
              >
              <input
                type="text"
                required
                name="tenantName"
                class="form-control"
                id="tenantName"
              />
            </div>
            <div class="mb-3">
              <label for="exampleFormControlTextarea1" class="form-label"
                >Enter Tenant Address:</label
              >
              <input
                type="text"
                required
                name="tenantAdd"
                class="form-control"
                id="tenantAdd"
              />
            </div>
            <div class="mb-3">
              <label for="exampleFormControlTextarea1" class="form-label"
                >Late Fee:</label
              >
              <input
                type="text"
                required
                name="lateFee"
                class="form-control"
                id="lateFee"
              />
            </div>

            <div class="col-10">
              <button class="btn btn-primary" type="submit">Add</button>
              <button class="btn btn-success" type="reset">Reset</button>
            </div>
          </form>
                </div>
              </div>
            </div>
</div>

 <section>
    <div class="row   overflow-auto">
        <div class="col-md-10 col-10 mx-auto">
        <table class="table text-center" id="shops" border="1">
            <thead>
              <tr class="table-primary">
                <th>Shop Name</th>
                <th>Shop Nick Name</th>
                <th>Phone Number</th>
                <th>Tenant Name</th>
                <th>Tenant Address</th>
                <th>Late Fee</th>
                <th>Action</th>
              </tr>
            </thead>
            <tbody>
              <?php
              require "db.php";
              $sql = "select * from `shops`";
              $result = mysqli_query( $conn, $sql);
              while($row = mysqli_fetch_assoc($result) ){
                echo "<tr><td>".$row['shopName']."</td>
                <td>".$row['nickName']."</td>
                <td>".$row['number']."</td>
                <td>".$row['tenantName']."</td>
                <td>".$row['tenantAddress']."</td>
                <td>".$row['lateFee']."</td>
                
                <td><a href='shopStatus.php?checkShop=".$row['shopName']."'>Status</a></td></tr>";
                echo "<br>";
                 
                 } 
              
              ?>
              
            </tbody>
        </table>
        <button class="btn btn-outline-primary" onclick="exportTableToExcel('shops')">Export Table Data To Excel File</button>
        <button class="btn btn-outline-primary" onclick="createPDF()">Export Table Data To pdf File</button>
    </div>
    </div>
 </section>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/js/bootstrap.bundle.min.js"></script>
<script src="https://cdn.datatables.net/1.13.2/js/jquery.dataTables.min.js"></script>
<script src="https://code.jquery.com/jquery-3.6.4.js" integrity="sha256-a9jBBRygX1Bh5lt8GZjXDzyOB+bWve9EiO7tROUtj/E=" crossorigin="anonymous"></script>
<script>
    function exportTableToExcel(tableID, filename = ''){
    var downloadLink;
    var dataType = 'application/vnd.ms-excel';
    var tableSelect = document.getElementById(tableID);
    var tableHTML = tableSelect.outerHTML.replace(/ /g, '%20');
    
    // Specify file name
    filename = filename?filename+'.xls':'excel_data.xls';
    
    // Create download link element
    downloadLink = document.createElement("a");
    
    document.body.appendChild(downloadLink);
    
    if(navigator.msSaveOrOpenBlob){
        var blob = new Blob(['\ufeff', tableHTML], {
            type: dataType
        });
        navigator.msSaveOrOpenBlob( blob, filename);
    }else{
        // Create a link to the file
        downloadLink.href = 'data:' + dataType + ', ' + tableHTML;
    
        // Setting the file name
        downloadLink.download = filename;
        
        //triggering the function
        downloadLink.click();
    }
}


function createPDF() {
        var sTable = document.getElementById('shops').innerHTML;

        var style = "<style>";
        style = style + "table {width: 100%;font: 17px Calibri;}";
        style = style + "table, th, td {border: solid 1px #DDD; border-collapse: collapse;";
        style = style + "padding: 2px 3px;text-align: center;}";
        style = style + "</style>";

        // CREATE A WINDOW OBJECT.
        var win = window.open('', '', 'height=700,width=700');

        win.document.write('<html><head>');
        win.document.write('<title>Profile</title>');   // <title> FOR PDF HEADER.
        win.document.write(style);          // ADD STYLE INSIDE THE HEAD TAG.
        win.document.write('</head>');
        win.document.write('<body>');
        win.document.write(sTable);         // THE TABLE CONTENTS INSIDE THE BODY TAG.
        win.document.write('</body></html>');

        win.document.close(); 	// CLOSE THE CURRENT WINDOW.

        win.print();    // PRINT THE CONTENTS.
    }
    $('document').ready(()=>{
       
        

    })
    window.onload = ()=>{
      let pass = localStorage.getItem("admin")
            console.log(pass)
            if(pass === "admin123"){
              return "true"
              
            }else{
              window.location = './index.html'
            }
           
        }
   
</script>
</body>
</html>