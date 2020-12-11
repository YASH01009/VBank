<!DOCTYPE html>
<html lang="en">
<head>
  <title>Send Money</title>
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
  <script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.16.0/umd/popper.min.js"></script>
  
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
  <link rel="stylesheet" type="text/css" href="style.css">
</head>

<body>

<nav class="navbar navbar-expand-sm bg-dark navbar-dark">

<a class="navbar-brand" href="#">Banking System</a>
  <ul class="navbar-nav ml-auto">
    <li class="nav-item active">
      <a class="nav-link" href="index.php">Home</a>
    </li>
    <li class="nav-item active">
      <a class="nav-link" href="transaction.php">View Transactions</a>
    </li>
    
    
  </ul>
  
</nav>



<div class="col-lg-6 m-auto">

    <form action="execute.php" method="POST">
        <br><br><br><br><div class="card">
        
        <div class="card-header bg-dark">
            <h1 class="text-white text-center">Send Money</h1>
        </div>
        <br>

        <datalist id="customers">
            <option value>No Selection</option>
            <?php

                include 'dbConnect.php';

                $conn = openCon();
                $sql = "SELECT Name FROM balance";
                $result = $conn->query($sql);
                
                // output data of each row
                while($row = $result->fetch_assoc()) {
                    echo "<option value=". $row["Name"] . ">";
                }
                
                closeCon($conn);
            ?>
        </datalist> 
        <!-- DO NOT use spaces in names of customers,
        though sql is supporting this, there is some
        problem using them in <datalist> or <selest> -->

        <label> To </label>
        <input list="customers" type="text" class="form-control" name="To" required>   
        <br>        

        <label> From </label>
        <input list="customers" type="text" class="form-control" name="From" required> 
        <br>  

        <label> Amount </label>
        <input type="number" name="Amount" class="form-control" required/><br> 

        <input type="submit" class="btn btn-success"  name="Transfer" value = "Transfer"><br>
    </form>
  
</div>

</body>
</html>