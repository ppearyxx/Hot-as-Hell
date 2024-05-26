<?php
// Start session
session_start();

// Establishing connection to MySQL database
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

// Handle form submission for updating payment details
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Retrieve updated details from form fields
    $updatedEarnestPayCheck = mysqli_real_escape_string($con, $_POST['earnest_pay_check']);
    $updatedPaymentMethodID = mysqli_real_escape_string($con, $_POST['payment_method_id']);
    $updatedPromotionID = mysqli_real_escape_string($con, $_POST['promotion_id']);
    $updatedTotalAmount = mysqli_real_escape_string($con, $_POST['total_amount']);
    $updatedEarnestPayDatetime = mysqli_real_escape_string($con, $_POST['earnest_pay_datetime']);
    $updatedTotalPayDatetime = mysqli_real_escape_string($con, $_POST['total_pay_datetime']);

    // Update payment details in the database
    $updateQuery = "UPDATE Payment SET EarnestPayCheck = '$updatedEarnestPayCheck', PaymentMethodID = '$updatedPaymentMethodID', PromotionID = '$updatedPromotionID', TotalAmount = '$updatedTotalAmount', EarnestPayDatetime = '$updatedEarnestPayDatetime', TotalPayDatetime = '$updatedTotalPayDatetime' WHERE PaymentID = '$paymentID'";
    
    // Execute update query
    if (mysqli_query($con, $updateQuery)) {
        // Store success message in session
        $_SESSION['success_message'] = "Payment details updated successfully.";

        // Redirect to the same page to prevent displaying old data
        header("Location: {$_SERVER['PHP_SELF']}?id=$paymentID");
        exit();
    } else {
        echo "Error updating payment details: " . mysqli_error($con);
    }
}

// Check if success message is set in session and display it
if (isset($_SESSION['success_message'])) {
    echo $_SESSION['success_message'];
    unset($_SESSION['success_message']); // Remove the message from session after displaying
}

// Close the database connection
mysqli_close($con);
?>
