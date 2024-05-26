<?php
// Start session
session_start();

// Establishing connection to MySQL database
$con = mysqli_connect("localhost", "root", "", "hot_as_hell");

// Check connection
if (mysqli_connect_errno()) {
    echo "Failed to connect to MySQL: " . mysqli_connect_error();
    exit();
}

// Retrieve EmployeeID from URL parameter
$employeeID = isset($_GET['id']) ? mysqli_real_escape_string($con, $_GET['id']) : '';
if (!$employeeID) {
    echo "Employee ID not provided.";
    exit();
}

// Fetch employee details from the database based on EmployeeID
$query = "SELECT * FROM Employee WHERE EmployeeID = '$employeeID'";
$result = mysqli_query($con, $query);

// Check if employee exists
if (mysqli_num_rows($result) === 0) {
    echo "Employee not found.";
    exit();
}

// Fetch employee details
$row = mysqli_fetch_assoc($result);
$firstName = $row['FirstName'];
$lastName = $row['LastName'];
$positionID = $row['PositionID'];
$contact = $row['Contact'];
$dob = $row['DOB'];
$gender = $row['Gender'];

// Fetch current room assignment if any
$room_query = "SELECT RoomID FROM room WHERE EmployeeID = '$employeeID'";
$room_result = mysqli_query($con, $room_query);
$currentRoom = mysqli_num_rows($room_result) > 0 ? mysqli_fetch_assoc($room_result)['RoomID'] : '';

// Handle form submission for updating employee details
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Retrieve updated details from form fields
    $updatedFirstName = mysqli_real_escape_string($con, $_POST['first_name']);
    $updatedLastName = mysqli_real_escape_string($con, $_POST['last_name']);
    $updatedPositionID = mysqli_real_escape_string($con, $_POST['position_id']);
    $updatedContact = mysqli_real_escape_string($con, $_POST['contact']);
    $updatedDOB = mysqli_real_escape_string($con, $_POST['dob']);
    $updatedGender = mysqli_real_escape_string($con, $_POST['gender']);
    $updatedRoomID = isset($_POST['room_id']) ? mysqli_real_escape_string($con, $_POST['room_id']) : '';

    // Update employee details in the database
    $updateQuery = "UPDATE Employee SET FirstName = '$updatedFirstName', LastName = '$updatedLastName', PositionID = '$updatedPositionID', Contact = '$updatedContact', DOB = '$updatedDOB', Gender = '$updatedGender' WHERE EmployeeID = '$employeeID'";
    
    // Execute update query
    if (mysqli_query($con, $updateQuery)) {
        // If room_id is provided, update the room assignment
        if ($updatedRoomID) {
            // Check if the room_id exists
            $room_check_query = "SELECT * FROM room WHERE RoomID = '$updatedRoomID'";
            $room_check_result = mysqli_query($con, $room_check_query);

            if (mysqli_num_rows($room_check_result) > 0) {
                // Update the room table with the employee_id
                $update_room_query = "UPDATE room SET EmployeeID = '$employeeID' WHERE RoomID = '$updatedRoomID'";
                if (mysqli_query($con, $update_room_query)) {
                    $_SESSION['success_message'] = "Employee details and room assignment updated successfully.";
                } else {
                    echo "Error updating room assignment: " . mysqli_error($con);
                }
            } else {
                echo "Invalid Room ID. Please make sure the Room ID exists in the room table.";
            }
        } else {
            // Clear the room assignment if no room_id is provided
            $clear_room_query = "UPDATE room SET EmployeeID = NULL WHERE EmployeeID = '$employeeID'";
            mysqli_query($con, $clear_room_query);
            $_SESSION['success_message'] = "Employee details updated successfully.";
        }

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

