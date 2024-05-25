<?php
$con = mysqli_connect("localhost", "root", "", "hot_as_hell");
// Check connection
if (mysqli_connect_errno()) {
    echo "Failed to connect to MySQL: " . mysqli_connect_error();
}

$error_message = ''; // Initialize error message variable

if (empty($_POST['payment_method_id'])) {
    $error_message = "Please Input data Payment Method ID";
} elseif (empty($_POST['payment_method_name'])) {
    $error_message = "Please Input data Payment Method Name";
} else {
    $payment_method_id = mysqli_real_escape_string($con, $_POST['payment_method_id']);
    $payment_method_name = mysqli_real_escape_string($con, $_POST['payment_method_name']);

    $sql = "INSERT INTO payment_method (PaymentMethodID, PaymentMethodName)
    VALUES ('$payment_method_id', '$payment_method_name')";
    if (!mysqli_query($con, $sql)) {
        $error_message = "Error: " . mysqli_error($con);
    } else {
        echo "Success";
    }
}

mysqli_close($con);
?>

<div style="text-align: center;">
    <?php if (!empty($error_message)): ?>
        <div style="color: red;"><?php echo $error_message; ?></div>
    <?php else: ?>
        <form name="inpfrm" method="post" action="MethodDashboard.php">
            <table border="0" class="table table-hover" style="margin: 0 auto;">
                <tr>
                    <td align="center"><input name="reset" type="submit" id="ViewPaymentMethods" value="View Inserted Payment Methods" /></td>
                </tr>
            </table>
        </form>
    <?php endif; ?>    

    <form name="inpfrm" method="post" action="MethodInsertForm.php">
        <table border="0" class="table table-hover" style="margin: 0 auto;">
            <tr>
                <td align="center"><input name="reset" type="submit" id="Back" value="Back" /></td>
            </tr>
        </table>
    </form>
</div>
