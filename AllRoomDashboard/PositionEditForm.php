<?php
// Establishing connection to MySQL database
$con = mysqli_connect("localhost", "root", "", "hot_as_hell");
// Check connection
if (mysqli_connect_errno()) {
    echo "Failed to connect to MySQL: " . mysqli_connect_error();
}

// Retrieve PositionID from URL parameter
$positionID = isset($_GET['id']) ? $_GET['id'] : '';
if (!$positionID) {
    echo "Position ID not provided.";
    exit;
}

// Fetch position details from the database based on PositionID
$query = "SELECT * FROM employee_position WHERE PositionID = '$positionID'";
$result = mysqli_query($con, $query);

// Check if position exists
if (mysqli_num_rows($result) === 0) {
    echo "Position not found.";
    exit;
}

// Fetch position details
$row = mysqli_fetch_assoc($result);
$positionName = $row['Position'];
$salary = $row['Salary'];

// Handle form submission for updating position details
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Retrieve updated details from form fields
    $updatedPositionName = mysqli_real_escape_string($con, $_POST['position_name']);
    $updatedSalary = mysqli_real_escape_string($con, $_POST['salary']);

    // Update position details in the database
    $updateQuery = "UPDATE employee_position SET Position = '$updatedPositionName', Salary = '$updatedSalary' WHERE PositionID = '$positionID'";
    if (mysqli_query($con, $updateQuery)) {
        echo "Position details updated successfully.";
    } else {
        echo "Error updating position details: " . mysqli_error($con);
    }
}

mysqli_close($con);
?>

<!-- Display form pre-filled with existing position details -->
<?php if ($positionID): ?>
<form method="post">
    <label for="position_name">Position Name:</label>
    <input type="text" id="position_name" name="position_name" value="<?php echo $positionName; ?>"><br>

    <label for="salary">Salary:</label>
    <input type="text" id="salary" name="salary" value="<?php echo $salary; ?>"><br>

    <input type="submit" value="Update">
</form>
<?php endif; ?>


<form name="inpfrm" method="post" action="PositionDashboard.php">
    <table border="0" class="table table-hover" style="margin: 0 auto;">
        <tr>
            <td align="center"><input name="reset" type="submit" id="Back" value="Back" /></td>
        </tr>
    </table>
</form>
