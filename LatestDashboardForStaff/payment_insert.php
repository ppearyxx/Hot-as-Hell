<?php
session_start(); // Start the session

// Establish database connection
$con = mysqli_connect("localhost", "root", "", "hot_as_hell");

// Check connection
if (mysqli_connect_errno()) {
    echo "Failed to connect to MySQL: " . mysqli_connect_error();
}

$error_message = '';

// Handling form submission
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    // Validating form fields
    if (empty($_POST['EarnestPayCheck'])) {
        $error_message = "Please input Earnest Pay Check";
    } elseif (empty($_POST['PaymentMethodID'])) {
        $error_message = "Please input Payment Method ID";
    } elseif (empty($_POST['PromotionID'])) {
        $error_message = "Please input Promotion ID";
    } elseif (empty($_POST['TotalAmount'])) {
        $error_message = "Please input Total Amount";
    } elseif (empty($_POST['EarnestPayDatetime'])) {
        $error_message = "Please input Earnest Pay Datetime";
    } elseif (empty($_POST['TotalPayDatetime'])) {
        $error_message = "Please input Total Pay Datetime";
    } else {
        // Sanitize and escape input data
        $earnest_pay_check = mysqli_real_escape_string($con, $_POST['EarnestPayCheck']);
        $payment_method_id = mysqli_real_escape_string($con, $_POST['PaymentMethodID']);
        $promotion_id = mysqli_real_escape_string($con, $_POST['PromotionID']);
        $total_amount = mysqli_real_escape_string($con, $_POST['TotalAmount']);
        $earnest_pay_datetime = mysqli_real_escape_string($con, $_POST['EarnestPayDatetime']);
        $total_pay_datetime = mysqli_real_escape_string($con, $_POST['TotalPayDatetime']);

        // Construct and execute SQL query
        $sql = "INSERT INTO Payment (EarnestPayCheck, PaymentMethodID, PromotionID, TotalAmount, EarnestPayDatetime, TotalPayDatetime)
                VALUES ('$earnest_pay_check', '$payment_method_id', '$promotion_id', '$total_amount', '$earnest_pay_datetime', '$total_pay_datetime')";

        if (mysqli_query($con, $sql)) {
            // Store success message in session
            $_SESSION['success_message'] = "Payment inserted successfully";

            // Redirect to prevent resubmission on refresh
            header("Location: {$_SERVER['PHP_SELF']}");
            exit();
        } else {
            $error_message = "Error inserting payment details: " . mysqli_error($con);
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
