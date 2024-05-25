<?php
// Start session
session_start();

// Establishing connection to MySQL database
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

// Handle form submission for updating employee details
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Retrieve updated details from form fields
    $updatedFirstName = mysqli_real_escape_string($con, $_POST['first_name']);
    $updatedLastName = mysqli_real_escape_string($con, $_POST['last_name']);
    $updatedPositionID = mysqli_real_escape_string($con, $_POST['position_id']);
    $updatedContact = mysqli_real_escape_string($con, $_POST['contact']);
    $updatedDOB = mysqli_real_escape_string($con, $_POST['dob']);
    $updatedGender = mysqli_real_escape_string($con, $_POST['gender']);

    // Update employee details in the database
    $updateQuery = "UPDATE Employee SET FirstName = '$updatedFirstName', LastName = '$updatedLastName', PositionID = '$updatedPositionID', Contact = '$updatedContact', DOB = '$updatedDOB', Gender = '$updatedGender' WHERE EmployeeID = '$employeeID'";
    
    // Execute update query
    if (mysqli_query($con, $updateQuery)) {
        // Store success message in session
        $_SESSION['success_message'] = "Employee details updated successfully.";

        // Redirect to the same page to prevent displaying old data
        header("Location: {$_SERVER['PHP_SELF']}?id=$employeeID");
        exit();
    } else {
        echo "Error updating employee details: " . mysqli_error($con);
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
