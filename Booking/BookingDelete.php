<?php
// Establish connection to MySQL database
$con = mysqli_connect("localhost", "root", "", "hot_as_hell");

// Check connection
if (mysqli_connect_errno()) {
    echo "Failed to connect to MySQL: " . mysqli_connect_error();
}

// Retrieve EmployeeID from URL parameter
$BookingNo = isset($_GET['id']) ? $_GET['id'] : '';
if (!$BookingNo) {
    echo "Booking No not provided.";
    exit;
}

// Fetch employee details from the database based on EmployeeID
$query = "SELECT * FROM booking_details WHERE BookingNo = '$BookingNo'";
$result = mysqli_query($con, $query);

// Check if employee exists
if (mysqli_num_rows($result) === 0) {
    echo "Reservation not found.";
    exit;
}

// Fetch employee details
$row = mysqli_fetch_assoc($result);
$bookingNo = $row['BookingNo'];
$BookingDate = $row['BookingDate'];
$BookingTime = $row['BookingTime'];
$GuestID = $row['GuestID'];
$PaymentID = $row['PaymentID'];
$AdultCount = $row['AdultCount'];
$ChildrenCount = $row['ChildrenCount'];

// Handle deletion confirmation
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    if (isset($_POST['confirm_delete'])) {
        // Execute delete query
        $deleteQuery = "DELETE FROM booking_details WHERE BookingNo = '$BookingNo'";
        if (mysqli_query($con, $deleteQuery)) {
            echo "<div style='color: green; text-align: center;'>Booking deleted successfully.</div>";
            echo '<div style="text-align: center;"><a href="BookingDetailsForm.php" class="btn btn-secondary-custom">Back</a></div>';
            exit;
        } else {
            echo "Error deleting reservation: " . mysqli_error($con);
            exit;
        }
    } elseif (isset($_POST['cancel_delete'])) {
        // Redirect back to the employee dashboard
        header("Location: BookingDetailsForm.php");
        exit;
    }
}

mysqli_close($con);
?>
