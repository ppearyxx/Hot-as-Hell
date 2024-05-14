<?php

$servername = "localhost";

$username = "root";

$password = "";

$dbname = "hotas_hell";

// Create connection

$conn = new mysqli($servername, $username, $password, $dbname);

if (isset($_POST['Save'])) {

// receive all input values from the form

$guestid = mysqli_real_escape_string($conn,$_POST['guestid']);

$fname = mysqli_real_escape_string($conn,$_POST['fname']);

$lname = mysqli_real_escape_string($conn,$_POST['lname']);

$tel = mysqli_real_escape_string($conn,$_POST['tel']);

$email= mysqli_real_escape_string($conn,$_POST['email']);

$gpassword = mysqli_real_escape_string($conn,$_POST['gpassword']);

$nationalid= mysqli_real_escape_string($conn,$_POST['nationalid']);

$passportno = mysqli_real_escape_string($conn,$_POST['passportno']);

$dateofbirth = mysqli_real_escape_string($conn,$_POST['dateofbirth']);

$gender = mysqli_real_escape_string($conn,$_POST['gender']);

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
    header("Location: GuestInfo.php");
    exit;
}


if(isset($_POST['View All'])) {
    // Redirect to view_all.php
    header("Location: GuestInfo.php");
    exit;
}



$conn->close();



?>