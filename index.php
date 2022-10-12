<!doctype html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Bootstrap demo</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-gH2yIJqKdNHPEq0n4Mqa/HGKIhSkIHeL5AyhkYV8i59U5AR6csBvApHHNl/vI1Bx" crossorigin="anonymous">
  </head>
  
  <body style = "background-color: lightyellow;">
  
  <nav class="navbar navbar-expand-lg bg-light">
  <div class="container-fluid">
    <a class="navbar-brand" href="#">Navbar</a>
    <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
      <span class="navbar-toggler-icon"></span>
    </button>
    <div class="collapse navbar-collapse" id="navbarSupportedContent">
      <ul class="navbar-nav me-auto mb-2 mb-lg-0">
        <li class="nav-item">
          <a class="nav-link active" aria-current="page" href="#">Home</a>
        </li>
        <li class="nav-item">
          <<a class="nav-item nav-link" href="index.php">Home</a>
        </li>
        <li class="nav-item">
          <a class="nav-item nav-link" href="customer.php">Customer</a>
        </li>
        <li class="nav-item">
          <a class="nav-item nav-link" href="employee.php">Employee</a>
        </li>
        <li class="nav-item">
          <a class="nav-item nav-link" href="purchase.php">Purchase</a>
        </li>
         <li class="nav-item">
          <a class="nav-item nav-link" href="restaurant.php">Restaurant</a>
        </li>
      </ul>
      <form class="d-flex" role="search">
        <input class="form-control me-2" type="search" placeholder="Search" aria-label="Search">
        <button class="btn btn-outline-success" type="submit">Search</button>
      </form>
    </div>
  </div>
</nav>
  
  <div class="text-center">
  <img src="data:image/png;base64,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" class="rounded" alt="..."
       width="700" 
     height="500" />
    
    <div class="alert alert-primary" role="alert">
  Welcome to my personal website! Feel free to look at the many tabs to learn more things about me!
</div>
</div>


      
 
