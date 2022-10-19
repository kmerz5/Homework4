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

$sql = "SELECT * FROM Purchase";
$result = $conn->query($sql);

if ($result->num_rows > 0) {
  // output data of each row
  while($row = $result->fetch_assoc()) {
?>
  <tr>
    <td><?=$row["Purchase_ID"]?></td>
    <td><?=$row["Customer_ID"]?></td>
  </tr>
     <td>
       <form method="post" action="purchase-delete-save.php">
                <input type="hidden" name="pid" value="<?=$row["Purchase_ID"]?>" />
                <input type="submit" value="Delete" class="btn btn-primary"/>
                
              </form>
    </td>
<?php
  }
} else {
  echo "0 results";
}
$conn->close();
?>
  </tbody>
    </table>
    <a href="purchase-add.php" class="btn btn-primary"> Add New<a/>
      <a href="purchase-delete-save.php" class="btn btn-primary"> Delete Record<a/>
