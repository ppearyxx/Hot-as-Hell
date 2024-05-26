<?php
// Start session
session_start();

// Establishing connection to MySQL database
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "hot_as_hell";

$conn = mysqli_connect($servername, $username, $password, $dbname);

// Check connection
if (mysqli_connect_errno()) {
    echo "Failed to connect to MySQL: " . mysqli_connect_error();
    exit;
}

// Retrieve ReservationID from URL parameter
$reservationID = isset($_GET['id']) ? $_GET['id'] : '';
if (!$reservationID) {
    echo "Reservation ID not provided.";
    exit;
}

// Fetch reservation details from the database based on ReservationID
$query = "SELECT * FROM reservation WHERE ReservationID = '$reservationID'";
$result = mysqli_query($conn, $query);

// Check if reservation exists
if (mysqli_num_rows($result) === 0) {
    echo "Reservation not found.";
    exit;
}

// Fetch reservation details
$row = mysqli_fetch_assoc($result);
$BookingNo = $row['BookingNo'];
$RoomID = $row['RoomID'];
$CheckInDate = $row['CheckInDate'];
$CheckInTime = $row['CheckInTime'];
$CheckOutDate = $row['CheckOutDate'];
$CheckOutTime = $row['CheckOutTime'];

// Handle form submission for updating reservation details
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Retrieve updated details from form fields
    $updatedBookingNo = mysqli_real_escape_string($conn, $_POST['BookingNo']);
    $updatedRoomID = mysqli_real_escape_string($conn, $_POST['RoomID']);
    $updatedCheckInDate = mysqli_real_escape_string($conn, $_POST['CheckInDate']);
    $updatedCheckInTime = mysqli_real_escape_string($conn, $_POST['CheckInTime']);
    $updatedCheckOutDate = mysqli_real_escape_string($conn, $_POST['CheckOutDate']);
    $updatedCheckOutTime = mysqli_real_escape_string($conn, $_POST['CheckOutTime']);

    // Update reservation details in the database
    $updateQuery = "UPDATE reservation SET BookingNo = '$updatedBookingNo', RoomID = '$updatedRoomID', CheckInDate = '$updatedCheckInDate', CheckInTime = '$updatedCheckInTime', CheckOutDate = '$updatedCheckOutDate', CheckOutTime = '$updatedCheckOutTime' WHERE ReservationID = '$reservationID'";
    
    // Execute update query
    if (mysqli_query($conn, $updateQuery)) {
        // Store success message in session
        $_SESSION['success_message'] = "Reservation details updated successfully.";

        // Redirect to the same page to prevent displaying old data
        header("Location: {$_SERVER['PHP_SELF']}?id=$reservationID");
        exit();
    } else {
        echo "Error updating reservation details: " . mysqli_error($conn);
    }
}

// Close the database connection
mysqli_close($conn);
?>
