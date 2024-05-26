<?php
session_start(); // Start the session

$con = mysqli_connect("localhost", "root", "", "hot_as_hell");

if (mysqli_connect_errno()) {
    echo "Failed to connect to MySQL: " . mysqli_connect_error();
}

$error_message = '';

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    if (empty($_POST['earnest_pay_check'])) {
        $error_message = "Please input Earnest Pay Check";
    } elseif (empty($_POST['payment_method_id'])) {
        $error_message = "Please input Payment Method ID";
    } elseif (empty($_POST['promotion_id'])) {
        $error_message = "Please input Promotion ID";
    } elseif (empty($_POST['total_amount'])) {
        $error_message = "Please input Total Amount";
    } elseif (empty($_POST['earnest_pay_datetime'])) {
        $error_message = "Please input Earnest Pay Datetime";
    } elseif (empty($_POST['total_pay_datetime'])) {
        $error_message = "Please input Total Pay Datetime";
    } else {
        $earnest_pay_check = mysqli_real_escape_string($con, $_POST['earnest_pay_check']);
        $payment_method_id = mysqli_real_escape_string($con, $_POST['payment_method_id']);
        $promotion_id = mysqli_real_escape_string($con, $_POST['promotion_id']);
        $total_amount = mysqli_real_escape_string($con, $_POST['total_amount']);
        $earnest_pay_datetime = mysqli_real_escape_string($con, $_POST['earnest_pay_datetime']);
        $total_pay_datetime = mysqli_real_escape_string($con, $_POST['total_pay_datetime']);

        // Check if PaymentMethodID exists in payment_method table
        $payment_method_check_query = "SELECT * FROM payment_method WHERE PaymentMethodID = '$payment_method_id'";
        $payment_method_check_result = mysqli_query($con, $payment_method_check_query);

        if (mysqli_num_rows($payment_method_check_result) > 0) {
            $sql = "INSERT INTO Payment (EarnestPayCheck, PaymentMethodID, PromotionID, TotalAmount, EarnestPayDatetime, TotalPayDatetime)
                    VALUES ('$earnest_pay_check', '$payment_method_id', '$promotion_id', '$total_amount', '$earnest_pay_datetime', '$total_pay_datetime')";
        } else {
            $error_message = "Invalid Payment Method ID. Please make sure the Payment Method ID exists in the payment_method table.";
        }

        // Execute insert query if $sql is defined
        if (isset($sql) && mysqli_query($con, $sql)) {
            // Store success message in session
            $_SESSION['success_message'] = "Payment inserted successfully";

            // Redirect to the same page to prevent displaying old data
            header("Location: {$_SERVER['PHP_SELF']}?id=$earnest_pay_check");
            exit();
        } elseif (!isset($sql)) {
            $error_message = "Cannot insert payment details due to invalid Payment Method ID.";
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
