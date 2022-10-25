<!doctype html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Bootstrap demo</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-gH2yIJqKdNHPEq0n4Mqa/HGKIhSkIHeL5AyhkYV8i59U5AR6csBvApHHNl/vI1Bx" crossorigin="anonymous">
  </head>
  <body>
    <nav class="navbar navbar-expand-lg navbar-light bg-light">
  <a class="navbar-brand" href="#">Navbar</a>
  <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNavAltMarkup" aria-controls="navbarNavAltMarkup" aria-expanded="false" aria-label="Toggle navigation">
    <span class="navbar-toggler-icon"></span>
  </button>
  <div class="collapse navbar-collapse" id="navbarNavAltMarkup">
    <div class="navbar-nav">
      <a class="nav-item nav-link" href="index.php">Home</a>
      <a class="nav-item nav-link" href="customer.php">Customer</a>
      <a class="nav-item nav-link" href="employee.php">Employee</a>
      <a class="nav-item nav-link" href="purchase.php">Purchase</a>
      <a class="nav-item nav-link" href="restaurant.php">Restaurant</a>
      
      
    </div>
  </div>
</nav>
    
<table class="table table-striped">
  <thead>
    <tr>
      <th>Purchase ID</th>
      <th>Customer ID</th>
    </tr>
  </thead>
  <tbody>
    <?php
$servername = "localhost";
$username = "kyliemer_Homework3";
$password = "ChunkyMonkey01!";
$dbname = "kyliemer_Homework3";

// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);
// Check connection
if ($conn->connect_error) {
  die("Connection failed: " . $conn->connect_error);
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
  switch ($_POST['saveType']) {
    case 'Add':
      $sqlAdd = "INSERT INTO Purchase (Customer_ID) values (?)";
      $stmtAdd = $conn->prepare($sqlAdd);
      $stmtAdd->bind_param("s", $_POST['cID']);
      $stmtAdd->execute();
      echo '<div class="alert alert-success" role="alert">New customer ID added.</div>';
      break;
    case 'Edit':
      $sqlEdit = "UPDATE Purchase SET Customer_ID=? WHERE Purchase_ID=?";
      $stmtEdit = $conn->prepare($sqlEdit);
      $stmtEdit->bind_param("ii", $_POST['cID'],$_POST['pid']);
      $stmtEdit->execute();
      echo '<div class="alert alert-success" role="alert">Customer ID edited.</div>';
      break;
    case 'Delete':
      $sqlDelete = "DELETE FROM Purchase WHERE Purchase_ID=?";
      $stmtDelete = $conn->prepare($sqlDelete);
      $stmtDelete->bind_param("i", $_POST['pid']);
      $stmtDelete->execute();
      echo '<div class="alert alert-success" role="alert">Customer deleted.</div>';
      break;
  }
}
    
$sql = "SELECT * FROM Purchase";
$result = $conn->query($sql);

if ($result->num_rows > 0) {
  // output data of each row
  while($row = $result->fetch_assoc()) {
?>
  <tr>
    <td><?=$row["Purchase_ID"]?></td>
    <td><?=$row["Customer_ID"]?></td>
   <td>
       <button type="button" class="btn btn-warning" data-bs-toggle="modal" data-bs-target="#editPurchase<?=$row["Purchase_ID"]?>">
                Edit
              </button>
              <div class="modal fade" id="editPurchase<?=$row["Purchase_ID"]?>" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="editPurchase<?=$row["Purchase_ID"]?>Label" aria-hidden="true">
                <div class="modal-dialog">
                  <div class="modal-content">
                    <div class="modal-header">
                      <h1 class="modal-title fs-5" id="editPurchase<?=$row["Purchase_ID"]?>Label">Edit Purchase</h1>
                      <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                      <form method="post" action="">
                        <div class="mb-3">
                          <label for="editPurchase<?=$row["Purchase_ID"]?>Name" class="form-label">Purchase</label>
                          <select class="form-select" aria-label="Select Customer ID" id="CustomerIDList" name="cil">
                            <?php
                                $PurchaseSql = "SELECT * FROM Purchase ORDER BY Customer_ID";
                                $PurchaseResult = $conn->query($PurchaseSql);
                                while($purchaseRow = $PurchaseResult->fetch_assoc()) {
                                  if($purchaseRow['Purchase_ID'] == $row['Purchase_ID']){
                                    $selText = "selected";
                                  } else {
                                    $selText ="";
                                  }
                            ?>
                              <option value="<?=$purchaseRow['Purchase_ID']?>"<?=$selText?>><?=$purchaseRow['Customer_ID']?></option>
                            <?php
                                  }
                            ?>
                          </select>
                          
                        </div>
                        <input type="hidden" name="pid" value="<?=$row['Purchase_ID']?>">
                        <input type="hidden" name="saveType" value="Edit">
                        <input type="submit" class="btn btn-primary" value="Submit">
                      </form>
                    </div>
                  </div>
                </div>
              </div>
            </td>
             <td>
              <form method="post" action="">
                <input type="hidden" name="pid" value="<?=$row["Purchase_ID"]?>" />
                <input type="hidden" name="saveType" value="Delete">
                <input type="submit" class="btn btn-danger" onclick="return confirm('Are you sure?')" value="Delete">
              </form>
            </td>
          </tr>
    
<?php
  }
} else {
  echo "0 results";
}
$conn->close();
?>
   </tbody>
    </table>
    <br />
     <!-- Button trigger modal -->
      <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#addPurchase">
        Add New
      </button>

      <!-- Modal -->
      <div class="modal fade" id="addPurchase" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="addPurchaseLabel" aria-hidden="true">
        <div class="modal-dialog">
          <div class="modal-content">
            <div class="modal-header">
              <h1 class="modal-title fs-5" id="addPurchaseLabel">Add Purchase</h1>
              <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
              <form method="post" action="">
                <div class="mb-3">
                  <label for="Customer_ID" class="form-label">Customer ID</label>
                  <input type="text" class="form-control" id="Customer_ID" aria-describedby="nameHelp" name="cID">
                  <div id="nameHelp" class="form-text">Enter the customer's ID.</div>
                </div>
                <input type="hidden" name="saveType" value="Add">
                <button type="submit" class="btn btn-primary">Submit</button>
              </form>
            </div>
          </div>
        </div>
      </div>
    </div>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0/dist/js/bootstrap.bundle.min.js" integrity="sha384-A3rJD856KowSb7dwlZdYEkO39Gagi7vIsF0jrRAoQmDKKtQBHUuLZ9AsSv4jD4Xa" crossorigin="anonymous"></script>
  </body>
</html>
