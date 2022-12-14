<!doctype html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Edit Instructor</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-gH2yIJqKdNHPEq0n4Mqa/HGKIhSkIHeL5AyhkYV8i59U5AR6csBvApHHNl/vI1Bx" crossorigin="anonymous">
  </head>
  <body>
    <h1>Edit Instructor</h1>
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

$sql = "SELECT DISTINCT Customer_ID, Customer_FirstName, Customer_LastName FROM Customer WHERE Customer_ID=?";
$stmt = $conn->prepare($sql);
$stmt->bind_param("i", $_POST['cid']);
$stmt->execute();
$result = $stmt->get_result();

if ($result->num_rows > 0) {
  // output data of each row
  while($row = $result->fetch_assoc()) {
?>

<form method="post" action="customer-edit-save.php">
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
  <input type="hidden" name="cid" value="<?=$row['Customer_ID']?>">
  <button type="submit" class="btn btn-primary">Submit</button>
</form>
<?php
  }
} else {
  echo "0 results";
}
$conn->close();
?>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0/dist/js/bootstrap.bundle.min.js" integrity="sha384-A3rJD856KowSb7dwlZdYEkO39Gagi7vIsF0jrRAoQmDKKtQBHUuLZ9AsSv4jD4Xa" crossorigin="anonymous"></script>
  </body>
</html>
