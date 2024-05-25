<?php
session_start(); // Start the session

$con = mysqli_connect("localhost", "root", "", "hot_as_hell");

if (mysqli_connect_errno()) {
    echo "Failed to connect to MySQL: " . mysqli_connect_error();
}

$error_message = '';

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    if (empty($_POST['employee_id'])) {
        $error_message = "Please input Employee ID";
    } elseif (empty($_POST['first_name'])) {
        $error_message = "Please input First Name";
    } elseif (empty($_POST['last_name'])) {
        $error_message = "Please input Last Name";
    } elseif (empty($_POST['position_id'])) {
        $error_message = "Please input Position ID";
    } elseif (empty($_POST['contact'])) {
        $error_message = "Please input Contact";
    } elseif (empty($_POST['dob'])) {
        $error_message = "Please input Date of Birth";
    } elseif (empty($_POST['gender'])) {
        $error_message = "Please select Gender";
    } else {
        $employee_id = mysqli_real_escape_string($con, $_POST['employee_id']);
        $first_name = mysqli_real_escape_string($con, $_POST['first_name']);
        $last_name = mysqli_real_escape_string($con, $_POST['last_name']);
        $position_id = mysqli_real_escape_string($con, $_POST['position_id']);
        $contact = mysqli_real_escape_string($con, $_POST['contact']);
        $dob = mysqli_real_escape_string($con, $_POST['dob']);
        $gender = mysqli_real_escape_string($con, $_POST['gender']);

        // Check if PositionID exists in employee_position table
        $position_check_query = "SELECT * FROM employee_position WHERE PositionID = '$position_id'";
        $position_check_result = mysqli_query($con, $position_check_query);

        if (mysqli_num_rows($position_check_result) > 0) {
            $sql = "INSERT INTO Employee (EmployeeID, FirstName, LastName, PositionID, Contact, DOB, Gender)
                    VALUES ('$employee_id', '$first_name', '$last_name', '$position_id', '$contact', '$dob', '$gender')";
        } else {
            $error_message = "Invalid Position ID. Please make sure the Position ID exists in the employee_position table.";
        }
        
        // Execute insert query
        if (mysqli_query($con, $sql)) {
            // Store success message in session
            $_SESSION['success_message'] = "Employee inserted successfully";

            // Redirect to the same page to prevent displaying old data
            header("Location: {$_SERVER['PHP_SELF']}?id=$employee_id");
            exit();
        } else {
            $error_message = "Error inserting employee details: " . mysqli_error($con);
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
