
<?php

$servername = "localhost";

$username = "root";

$password = "";

$dbname = "hotas_hell";

// Create connection

$conn = new mysqli($servername, $username, $password, $dbname);

if (isset($_POST['Save'])) {

// receive all input values from the form

$referenceno = mysqli_real_escape_string($conn,$_POST['referenceno']);

$guestid = mysqli_real_escape_string($conn,$_POST['pirce']);

$cin = mysqli_real_escape_string($conn,$_POST['cin']);

$cout = mysqli_real_escape_string($conn,$_POST['cout']);

$rcin= mysqli_real_escape_string($conn,$_POST['rcin']);

$rcout = mysqli_real_escape_string($conn,$_POST['rcout']);

$roomid= mysqli_real_escape_string($conn,$_POST['roomid']);

$ernestpay = mysqli_real_escape_string($conn,$_POST['ernestpay']);

$specialreq = mysqli_real_escape_string($conn,$_POST['specialreq']);

// Check connection

if ($conn->connect_error) {

die("Connection failed: " . $conn->connect_error);

}

$sql = "INSERT INTO products (referenceno,guestid,cin,cout,rcin,rcout,roomid,ernestpay,specialreq)

VALUES ('$referenceno', '$guestid', '$cin','$cout','$rcin','$rcout','$roomid','$ernestpay','$specialreq)";

if ($conn->query($sql) === TRUE) {

echo "alert('New record created successfully')";

} else {

echo "Error: " . $sql . "<br>" . $conn->error;

}

}
if(isset($_POST['View All'])) {
    // Redirect to view_all.php
    header("Location: HistoryReservation.php");
    exit;
}
$conn->close();

?>