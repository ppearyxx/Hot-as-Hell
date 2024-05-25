<?php
// Establish connection to MySQL database
$con = mysqli_connect("localhost", "root", "", "hot_as_hell");

// Check connection
if (mysqli_connect_errno()) {
    echo "Failed to connect to MySQL: " . mysqli_connect_error();
}

// Retrieve PaymentID from URL parameter
$paymentID = isset($_GET['id']) ? $_GET['id'] : '';
if (!$paymentID) {
    echo "Payment ID not provided.";
    exit;
}

// Fetch payment details from the database based on PaymentID
$query = "SELECT * FROM Payment WHERE PaymentID = '$paymentID'";
$result = mysqli_query($con, $query);

// Check if payment exists
if (mysqli_num_rows($result) === 0) {
    echo "Payment not found.";
    exit;
}

// Fetch payment details
$row = mysqli_fetch_assoc($result);
$earnestPayCheck = $row['EarnestPayCheck'];
$paymentMethodID = $row['PaymentMethodID'];
$promotionID = $row['PromotionID'];
$totalAmount = $row['TotalAmount'];
$earnestPayDatetime = $row['EarnestPayDatetime'];
$totalPayDatetime = $row['TotalPayDatetime'];

// Handle deletion confirmation
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    if (isset($_POST['confirm_delete'])) {
        // Execute delete query
        $deleteQuery = "DELETE FROM Payment WHERE PaymentID = '$paymentID'";
        if (mysqli_query($con, $deleteQuery)) {
            echo "<div style='color: green; text-align: center;'>Payment deleted successfully.</div>";
            echo '<div style="text-align: center;"><a href="payment.php" class="btn btn-secondary-custom">Back</a></div>';
            exit;
        } else {
            echo "Error deleting payment: " . mysqli_error($con);
            exit;
        }
    } elseif (isset($_POST['cancel_delete'])) {
        // Redirect back to the payment dashboard
        header("Location: payment.php");
        exit;
    }
}

mysqli_close($con);
?>
