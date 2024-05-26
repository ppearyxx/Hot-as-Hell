<?php
session_start(); // Start the session

$con = mysqli_connect("localhost", "root", "", "hot_as_hell");

if (mysqli_connect_errno()) {
    echo "Failed to connect to MySQL: " . mysqli_connect_error();
}

$error_message = '';

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    if (empty($_POST['ReservationID'])) {
        $error_message = "Please input Reservation ID";
    } elseif (empty($_POST['BookingNo'])) {
        $error_message = "Please input Booking NO";
    } elseif (empty($_POST['RoomID'])) {
        $error_message = "Please input Room ID";
    } elseif (empty($_POST['CheckInDate'])) {
        $error_message = "Please input Check-In Date";
    } elseif (empty($_POST['CheckInTime'])) {
        $error_message = "Please input Check-In Time";
    } elseif (empty($_POST['CheckOutDate'])) {
        $error_message = "Please input Check-Out Date";
    } elseif (empty($_POST['CheckOutTime'])) {
        $error_message = "Please input Check-Out Time";
    } else {
        $ReservationID = mysqli_real_escape_string($con, $_POST['ReservationID']);
        $BookingNo = mysqli_real_escape_string($con, $_POST['BookingNo']);
        $RoomID = mysqli_real_escape_string($con, $_POST['RoomID']);
        $CheckInDate = mysqli_real_escape_string($con, $_POST['CheckInDate']);
        $CheckInTime = mysqli_real_escape_string($con, $_POST['CheckInTime']);
        $CheckOutDate = mysqli_real_escape_string($con, $_POST['CheckOutDate']);
        $CheckOutTime = mysqli_real_escape_string($con, $_POST['CheckOutTime']);

        // Insert data into database
        $sql = "INSERT INTO reservation (ReservationID, BookingNo, RoomID, CheckInDate, CheckInTime, CheckOutDate, CheckOutTime) VALUES ('$ReservationID', '$BookingNo', '$RoomID', '$CheckInDate', '$CheckInTime', '$CheckOutDate', '$CheckOutTime')";
        
        
        // Execute insert query
        if (mysqli_query($con, $sql)) {
            // Store success message in session
            $_SESSION['success_message'] = "Reservation inserted successfully";

            // Redirect to the same page to prevent displaying old data
            header("Location: {$_SERVER['PHP_SELF']}?id=$ReservationID");
            exit();
        } else {
            $error_message = "Error inserting reservation details: " . mysqli_error($con);
        }
    }
}

// Check if success message is set in session and display it
if (isset($_SESSION['success_message'])) {
    $success_message = $_SESSION['success_message'];
    unset($_SESSION['success_message']); // Remove the message from session after displaying
}

// Close the database connection
mysqli_close($con);

?>