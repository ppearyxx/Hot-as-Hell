<?php
// Establish connection to MySQL database
$con = mysqli_connect("localhost", "root", "", "hot_as_hell");

// Check connection
if (mysqli_connect_errno()) {
    echo "Failed to connect to MySQL: " . mysqli_connect_error();
}

// Retrieve EmployeeID from URL parameter
$employeeID = isset($_GET['id']) ? $_GET['id'] : '';
if (!$employeeID) {
    echo "Employee ID not provided.";
    exit;
}

// Fetch employee details from the database based on EmployeeID
$query = "SELECT * FROM Employee WHERE EmployeeID = '$employeeID'";
$result = mysqli_query($con, $query);

// Check if employee exists
if (mysqli_num_rows($result) === 0) {
    echo "Employee not found.";
    exit;
}

// Fetch employee details
$row = mysqli_fetch_assoc($result);
$firstName = $row['FirstName'];
$lastName = $row['LastName'];
$positionID = $row['PositionID'];
$contact = $row['Contact'];
$dob = $row['DOB'];
$gender = $row['Gender'];

// Handle deletion confirmation
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    if (isset($_POST['confirm_delete'])) {
        // Execute delete query
        $deleteQuery = "DELETE FROM Employee WHERE EmployeeID = '$employeeID'";
        if (mysqli_query($con, $deleteQuery)) {
            echo "<div style='color: green; text-align: center;'>Employee deleted successfully.</div>";
            echo '<div style="text-align: center;"><a href="employee.php" class="btn btn-secondary-custom">Back</a></div>';
            exit;
        } else {
            echo "Error deleting employee: " . mysqli_error($con);
            exit;
        }
    } elseif (isset($_POST['cancel_delete'])) {
        // Redirect back to the employee dashboard
        header("Location: employee.php");
        exit;
    }
}

mysqli_close($con);
?>
