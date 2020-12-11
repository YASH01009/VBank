<!DOCTYPE html>
<html lang="en">
<head>
 <title>Transaction History</title>
 <meta name="viewport" content="width=device-width, initial-scale=1">
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.16.0/umd/popper.min.js"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
  <link href="https://fonts.googleapis.com/css?family=Montserrat" rel="stylesheet">
  
</head>
<body>
<nav class="navbar navbar-expand-sm bg-dark navbar-dark">

<a class="navbar-brand" href="#">Banking System</a>
  <ul class="navbar-nav ml-auto">
    <li class="nav-item active">
      <a class="nav-link" href="index.php">Home</a>
    </li>
    <li class="nav-item active">
      <a class="nav-link active" href="insert.php">Send Money</a>
    </li>
    
    
  </ul>
</nav>
<div class="container">
<div class="col-lg-12"><br><br>
        <h1 class="text-warning text-center">Transaction History</h1>   	
        <table class="table table-striped table-hover table-bordered">
        	<tr class="bg-dark text-white text-center">
        		<th>To</th>
        		<th>From</th>
        		<th>Amount</th>
        		
            </tr>
    
    <?php

        include 'dbConnect.php';

        $conn = openCon();
        $sql= "SELECT * FROM transfers";
        $result = mysqli_query($conn, $sql);
        closeCon($conn);

        while($row = mysqli_fetch_array($result)) {
            echo "<tr><td>" . $row["Recipient"]. "</td><td>" . $row["Sender"] . "</td><td>" . $row["Amount"]. "</td></tr>";
        }

    ?>

        </table>	
    	</div>
    	
    </div>
</body>
</html>