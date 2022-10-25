<!doctype html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Customers</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-gH2yIJqKdNHPEq0n4Mqa/HGKIhSkIHeL5AyhkYV8i59U5AR6csBvApHHNl/vI1Bx" crossorigin="anonymous">
  </head>
  <body>
    <div class="container">
      
<?php>
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
      $sqlAdd = "insert into customer (Customer_FirstName, Customer_LastName) value (?,?)";
      $stmtAdd = $conn->prepare($sqlAdd);
      $stmtAdd->bind_param("ss", $_POST['cName'],$_POST['lName']);
      $stmtAdd->execute();
      echo '<div class="alert alert-success" role="alert">New customer added.</div>';
      break;
    case 'Edit':
      $sqlEdit = "update Customer set Customer_FirstName=?, Customer_LastName=? WHERE Customer_ID=?";
      $stmtEdit = $conn->prepare($sqlEdit);
      $stmtEdit->bind_param("ssi", $_POST[cName],$_POST['lName'],$_POST['cid']);
      $stmtEdit->execute();
      echo '<div class="alert alert-success" role="alert">Customer edited.</div>';
      break;
    case 'Delete':
      $sqlDelete = "delete from Customer where Customer_ID=?";
      $stmtDelete = $conn->prepare($sqlDelete);
      $stmtDelete->bind_param("i", $_POST['cid']);
      $stmtDelete->execute();
      echo '<div class="alert alert-success" role="alert">Customer deleted.</div>';
      break;
  }
}
?>
      
  <h1>Customers</h1>
  <table class="table table-striped">
  <thead>
    <tr>
      <th>Customer ID</th>
      <th>First Name</th>
      <th>Last Name</th>
    </tr>
  </thead>
  <tbody>
    
<?php
$sql = "SELECT DISTINCT Customer_ID, Customer_FirstName, Customer_LastName FROM Customer";
$result = $conn->query($sql);

if ($result->num_rows > 0) {
  // output data of each row
  while($row = $result->fetch_assoc()) {
?>
    
  <tr>
    <td><?=$row["Customer_ID"]?></td>
    <td>
              <button type="button" class="btn" data-bs-toggle="modal" data-bs-target="#editCustomer<?=$row["Customer_ID"]?>">
                Edit
              </button>
              <div class="modal fade" id="editCustomer<?=$row["Customer_ID"]?>" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="editCustomer<?=$row["Customer_ID"]?>Label" aria-hidden="true">
                <div class="modal-dialog">
                  <div class="modal-content">
                    <div class="modal-header">
                      <h1 class="modal-title fs-5" id="editCustomer<?=$row["instructor_id"]?>Label">Edit Customer</h1>
                      <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                      <form method="post" action="">
                        <div class="mb-3">
                          <label for="editCustomer<?=$row["Customer_ID"]?>Name" class="form-label">Name</label>
                          <input type="text" class="form-control" id="editCustomer<?=$row["Customer_ID"]?>Name" aria-describedby="editCustomer<?=$row["Customer_ID"]?>Help" name="cName" value="<?=$row['Customer_FirstName']?>">
                          <div id="editCustomer<?=$row["Customer_ID"]?>Help" class="form-text">Enter the customer's name.</div>
                        </div>
                        <div class="mb-3">
                          <label for="editCustomer<?=$row["Customer_ID"]?>Name" class="form-label">Name</label>
                          <input type="text" class="form-control" id="editCustomer<?=$row["Customer_ID"]?>Name" aria-describedby="editCustomer<?=$row["Customer_ID"]?>Help" name="lName" value="<?=$row['Customer_LastName']?>">
                          <div id="editCustomer<?=$row["Customer_ID"]?>Help" class="form-text">Enter the customer's name.</div>
                        </div>
                        <input type="hidden" name="cid" value="<?=$row['Customer_ID']?>">
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
                <input type="hidden" name="cid" value="<?=$row["Customer_ID"]?>" />
                <input type="hidden" name="saveType" value="Delete"
                <input type="submit" value="Delete" class="btn btn-primary"/>
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
      <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#addCustomer">
        Add New
      </button>

      <!-- Modal -->
      <div class="modal fade" id="addCustomer" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="addCustomerLabel" aria-hidden="true">
        <div class="modal-dialog">
          <div class="modal-content">
            <div class="modal-header">
              <h1 class="modal-title fs-5" id="addCustomerLabel">Add Customer</h1>
              <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
              <form method="post" action="">
                <div class="mb-3">
                  <label for="Customer_FirstName" class="form-label">Name</label>
                  <input type="text" class="form-control" id="Customer_FirstName" aria-describedby="nameHelp" name="cName">
                  <div id="nameHelp" class="form-text">Enter the customer's first name.</div>
                </div>
                <div class="mb-3">
                  <label for="Customer_LastName" class="form-label">Name</label>
                  <input type="text" class="form-control" id="Customer_LastName" aria-describedby="nameHelp" name="lName">
                  <div id="nameHelp" class="form-text">Enter the customer's last name.</div>
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
