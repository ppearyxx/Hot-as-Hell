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
$BookingNo = isset($_GET['id']) ? $_GET['id'] : '';
if (!$BookingNo) {
    echo "Booking not provided.";
    exit;
}

// Fetch reservation details from the database based on ReservationID
$query = "SELECT * FROM booking_details WHERE BookingNo = '$BookingNo'";
$result = mysqli_query($conn, $query);

// Check if reservation exists
if (mysqli_num_rows($result) === 0) {
    echo "Booking not found.";
    exit;
}

// Fetch reservation details
$row = mysqli_fetch_assoc($result);
$BookingDate = $row['BookingDate'];
$BookingTime = $row['BookingTime'];
$GuestID = $row['GuestID'];
$PaymentID = $row['PaymentID'];
$AdultCount = $row['AdultCount'];
$ChildrenCount = $row['ChildrenCount'];


// Handle form submission for updating reservation details
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Retrieve updated details from form fields
    $updatedBookingDate = mysqli_real_escape_string($conn, $_POST['BookingDate']);
    $updatedBookingTime = mysqli_real_escape_string($conn, $_POST['BookingTime']);
    $updatedGuestID = mysqli_real_escape_string($conn, $_POST['GuestID']);
    $updatedPaymentID = mysqli_real_escape_string($conn, $_POST['PaymentID']);
    $updatedAdultCount = mysqli_real_escape_string($conn, $_POST['AdultCount']);
    $updatedChildCount = mysqli_real_escape_string($conn, $_POST['ChildrenCount']);

    // Update reservation details in the database
    $updateQuery = "UPDATE booking_details SET  
    BookingDate = '$updatedBookingDate', BookingTime = '$updatedBookingTime', GuestID = '$updatedGuestID', PaymentID = 
    '$updatedPaymentID', AdultCount = '$updatedAdultCount',ChildrenCount = '$updatedChildCount' WHERE BookingNo = '$BookingNo'";
    
    // Execute update query
    if (mysqli_query($conn, $updateQuery)) {
        // Store success message in session
        $_SESSION['success_message'] = "Booking details updated successfully.";

        // Redirect to the same page to prevent displaying old data
        header("Location: {$_SERVER['PHP_SELF']}?id=$BookingNo");
        exit();
    } else {
        echo "Error updating reservation details: " . mysqli_error($conn);
    }
}

// Close the database connection
mysqli_close($conn);
?>
