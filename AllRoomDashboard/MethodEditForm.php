<?php
// Establishing connection to MySQL database
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

// Handle form submission for updating payment method details
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Retrieve updated details from form fields
    $updatedPaymentMethodName = mysqli_real_escape_string($con, $_POST['payment_method_name']);

    // Update payment method details in the database
    $updateQuery = "UPDATE payment_method SET PaymentMethodName = '$updatedPaymentMethodName' WHERE PaymentMethodID = '$paymentMethodID'";
    if (mysqli_query($con, $updateQuery)) {
        echo "Payment Method details updated successfully.";
    } else {
        echo "Error updating payment method details: " . mysqli_error($con);
    }
}

mysqli_close($con);
?>

<!-- Display form pre-filled with existing payment method details -->
<?php if ($paymentMethodID): ?>
<form method="post">
    <label for="payment_method_name">Payment Method Name:</label>
    <input type="text" id="payment_method_name" name="payment_method_name" value="<?php echo $paymentMethodName; ?>"><br>

    <input type="submit" value="Update">
</form>
<?php endif; ?>


<form name="inpfrm" method="post" action="MethodDashboard.php">
    <table border="0" class="table table-hover" style="margin: 0 auto;">
        <tr>
            <td align="center"><input name="reset" type="submit" id="Back" value="Back" /></td>
        </tr>
    </table>
</form>
