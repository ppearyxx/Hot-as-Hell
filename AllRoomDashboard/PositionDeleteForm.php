<?php
// Establish connection to MySQL database
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

// Handle deletion confirmation
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    if (isset($_POST['confirm_delete'])) {
        // Execute delete query
        $deleteQuery = "DELETE FROM employee_position WHERE PositionID = '$positionID'";
        if (mysqli_query($con, $deleteQuery)) {
            echo "Position deleted successfully.";
            echo '<br><a href="PositionDashboard.php">Back</a>';
            exit;
        } else {
            echo "Error deleting position: " . mysqli_error($con);
            exit;
        }
    } elseif (isset($_POST['cancel_delete'])) {
        // Redirect back to the position dashboard
        header("Location: PositionDashboard.php");
        exit;
    }
}

mysqli_close($con);
?>

<!-- Centered delete confirmation form -->
<div style="display: flex; justify-content: center;">
    <form method="post" style="text-align: left;">
        <p>Are you sure you want to delete the following position?</p>
        <p>Position ID: <?php echo $positionID; ?></p>
        <p>Position Name: <?php echo $positionName; ?></p>
        <p>Salary: <?php echo $salary; ?></p>
        <input type="submit" name="confirm_delete" value="Confirm Delete">
        <input type="submit" name="cancel_delete" value="Cancel">
    </form>
</div>
