<?php
$con = mysqli_connect("localhost", "root", "", "hot_as_hell");
// Check connection
if (mysqli_connect_errno()) {
    echo "Failed to connect to MySQL: " . mysqli_connect_error();
}

$error_message = ''; // Initialize error message variable

if (empty($_POST['position_id'])) {
    $error_message = "Please Input data Position ID";
} elseif (empty($_POST['position_name'])) {
    $error_message = "Please Input data Position Name";
} elseif (empty($_POST['salary'])) {
    $error_message = "Please Input data Salary";
} else {
    $position_id = mysqli_real_escape_string($con, $_POST['position_id']);
    $position_name = mysqli_real_escape_string($con, $_POST['position_name']);
    $salary = mysqli_real_escape_string($con, $_POST['salary']);

    $sql = "INSERT INTO employee_position (PositionID, Position, Salary)
    VALUES ('$position_id', '$position_name', '$salary')";
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
        <form name="inpfrm" method="post" action="PositionDashboard.php">
            <table border="0" class="table table-hover" style="margin: 0 auto;">
                <tr>
                    <td align="center"><input name="reset" type="submit" id="ViewPositions" value="View Inserted Positions" /></td>
                </tr>
            </table>
        </form>
    <?php endif; ?>    

    <form name="inpfrm" method="post" action="PositionInsertForm.php">
        <table border="0" class="table table-hover" style="margin: 0 auto;">
            <tr>
                <td align="center"><input name="reset" type="submit" id="Back" value="Back" /></td>
            </tr>
        </table>
    </form>
</div>
