<?php
session_start(); // Start the session

$con = mysqli_connect("localhost", "root", "", "hot_as_hell");

if (mysqli_connect_errno()) {
    echo "Failed to connect to MySQL: " . mysqli_connect_error();
    exit();
}

$error_message = '';

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    if (empty($_POST['BookingNo'])) {
        $error_message = "Please input Booking No";
    } elseif (empty($_POST['BookingDate'])) {
        $error_message = "Please input Booking Date";
    } elseif (empty($_POST['BookingTime'])) {
        $error_message = "Please input Booking Time";
    } elseif (empty($_POST['GuestID'])) {
        $error_message = "Please input Guest ID";
    } elseif (empty($_POST['PaymentID'])) {
        $error_message = "Please input Payment ID";
    } elseif (empty($_POST['AdultCount'])) {
        $error_message = "Please input Adult Count";
    } elseif (empty($_POST['ChildrenCount'])) {
        $error_message = "Please input Children Count";
    } else {
        $BookingNo = mysqli_real_escape_string($con, $_POST['BookingNo']);
        $BookingDate = mysqli_real_escape_string($con, $_POST['BookingDate']);
        $BookingTime = mysqli_real_escape_string($con, $_POST['BookingTime']);
        $GuestID = mysqli_real_escape_string($con, $_POST['GuestID']);
        $PaymentID = mysqli_real_escape_string($con, $_POST['PaymentID']);
        $AdultCount = mysqli_real_escape_string($con, $_POST['AdultCount']);
        $ChildrenCount = mysqli_real_escape_string($con, $_POST['ChildrenCount']);

        // Insert data into database
        $sql = "INSERT INTO booking_details (BookingNo, BookingDate, BookingTime, GuestID, PaymentID, AdultCount, ChildrenCount, SpecialRequests) VALUES ('$BookingNo', '$BookingDate', '$BookingTime', '$GuestID', '$PaymentID', '$AdultCount', '$ChildrenCount', NULL)";

        // Execute insert query
        if (mysqli_query($con, $sql)) {
            // Store success message in session
            $_SESSION['success_message'] = "Booking inserted successfully";

            // Redirect to the same page to prevent displaying old data
            header("Location: BookingInsertForm.php");
            exit();
        } else {
            $error_message = "Error inserting booking details: " . mysqli_error($con);
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

include 'BookingInsertForm.php';
?>
