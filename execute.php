<?php

if(isset($_POST['Transfer'])) {
    $To =$_REQUEST['To'];
    $From =$_REQUEST['From'];
    $Amount =$_REQUEST['Amount'];

    include 'dbConnect.php';

    $conn = openCon();

    // // semaphores - windows does NOT support
    // $que1 = "SELECT id FROM balance WHERE Name = '$From'";
    // $sender_id = mysqli_query($conn, $que1);
    // $senid = mysqli_fetch_assoc($sender_id);

    // $que2 = "SELECT id FROM balance WHERE Name = '$To'";
    // $receiver_id = mysqli_query($conn, $que2);
    // $recid = mysqli_fetch_assoc($receiver_id);

    // $lower = min($senid['id'], $recid['id']);
    // $higher = max($senid['id'], $recid['id']);

    // $maxAcquire = 1;
    // $permissions = 0666;
    // $autoRelease = 1;

    // $sem_low = sem_get($lower, $maxAcquire, $permissions, $autoRelease);
    // $sem_high = sem_get($higher, $maxAcquire, $permissions, $autoRelease);

    // sem_acquire($sem_low);
    // sem_acquire($sem_high);

    $sql1 = "SELECT Balance FROM balance WHERE Name = '$From'";
    $sender_balance = mysqli_query($conn, $sql1);
    $senbal = mysqli_fetch_assoc($sender_balance);

    $sql2 = "SELECT Balance FROM balance WHERE Name = '$To'";
    $reciever_balance = mysqli_query($conn, $sql2);
    $recbal = mysqli_fetch_assoc($reciever_balance);
    
    if($Amount <=  $senbal['Balance']){
        $s = $senbal['Balance']-$Amount;
        $r = $recbal['Balance']+$Amount;
        
        $sql3 = "UPDATE balance SET Balance = $s WHERE Name = '$From'";
        mysqli_query($conn,$sql3);
        
        $sql4 = "UPDATE balance SET Balance = $r WHERE Name = '$To'";
        mysqli_query($conn,$sql4);

        $sql5 = "INSERT INTO `transfers`(`Recipient`, `Sender`, `Amount`) VALUES ('$To','$From','$Amount')";
        $nit = mysqli_query($conn,$sql5);
        $no_balance= 1;
    }
    else{
      $nit = 0;
      $no_balance= 0;
    }

    // sem_release($sem_low);
    // sem_release($sem_high);

    mysqli_free_result($sender_balance);
    mysqli_free_result($reciever_balance);
    closeCon($conn);
}

?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Transaction Report</title>
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
   
<?php
    if($nit && $no_balance) {
        echo "<script type='text/javascript'>
               alert('Transaction Successfull!');
               window.location='transaction.php';
               </script>";
    } else {
        echo "<script type='text/javascript'>
               alert('Transaction failed!');
               window.location='transaction.php';
               </script>";
    }
?>

</body>
</html>
