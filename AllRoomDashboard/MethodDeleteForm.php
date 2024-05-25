<?php
// Establish connection to MySQL database
$con = mysqli_connect("localhost", "root", "", "hot_as_hell");

// Check connection
if (mysqli_connect_errno()) {
    echo "Failed to connect to MySQL: " . mysqli_connect_error();
}

// Retrieve PaymentMethodID from URL parameter
$paymentMethodID = isset($_GET['id']) ? $_GET['id'] : '';
if (!$paymentMethodID) {
    echo "Payment Method ID not provided.";
    exit;
}

// Fetch payment method details from the database based on PaymentMethodID
$query = "SELECT * FROM payment_method WHERE PaymentMethodID = '$paymentMethodID'";
$result = mysqli_query($con, $query);

// Check if payment method exists
if (mysqli_num_rows($result) === 0) {
    echo "Payment Method not found.";
    exit;
}

// Fetch payment method details
$row = mysqli_fetch_assoc($result);
$paymentMethodName = $row['PaymentMethodName'];

// Handle deletion confirmation
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    if (isset($_POST['confirm_delete'])) {
        // Execute delete query
        $deleteQuery = "DELETE FROM payment_method WHERE PaymentMethodID = '$paymentMethodID'";
        if (mysqli_query($con, $deleteQuery)) {
            echo "Payment Method deleted successfully.";
            echo '<br><a href="MethodDashboard.php">Back</a>';
            exit;
        } else {
            echo "Error deleting payment method: " . mysqli_error($con);
            exit;
        }
    } elseif (isset($_POST['cancel_delete'])) {
        // Redirect back to the payment method dashboard
        header("Location: MethodDashboard.php");
        exit;
    }
}

mysqli_close($con);
?>

<!-- Centered delete confirmation form -->
<div style="display: flex; justify-content: center;">
    <form method="post" style="text-align: left;">
        <p>Are you sure you want to delete the following payment method?</p>
        <p>Payment Method ID: <?php echo $paymentMethodID; ?></p>
        <p>Payment Method Name: <?php echo $paymentMethodName; ?></p>
        <input type="submit" name="confirm_delete" value="Confirm Delete">
        <input type="submit" name="cancel_delete" value="Cancel">
    </form>
</div>
