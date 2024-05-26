<?php
session_start(); // Start the session

$con = mysqli_connect("localhost", "root", "", "hot_as_hell");

if (mysqli_connect_errno()) {
    echo "Failed to connect to MySQL: " . mysqli_connect_error();
    exit();
}

$error_message = '';

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    if (empty($_POST['GuestID'])) {
        $error_message = "Please input Guest ID";
    } elseif (empty($_POST['FirstName'])) {
        $error_message = "Please input First Name";
    } elseif (empty($_POST['LastName'])) {
        $error_message = "Please input Last Name";
    } elseif (empty($_POST['Telephone'])) {
        $error_message = "Please input Telephone";
    } elseif (empty($_POST['Email'])) {
        $error_message = "Please input Email";
    } elseif (empty($_POST['Password'])) {
        $error_message = "Please input Password";
    } elseif (empty($_POST['NationalID'])) {
        $error_message = "Please input National ID";
    } elseif (empty($_POST['PassportNo'])) {
        $error_message = "Please input Passport No";
    } elseif (empty($_POST['DOB'])) {
        $error_message = "Please input Date of Birth";
    } elseif (empty($_POST['Gender'])) {
        $error_message = "Please input Gender";
    } else {
        $GuestID = mysqli_real_escape_string($con, $_POST['GuestID']);
        $FirstName = mysqli_real_escape_string($con, $_POST['FirstName']);
        $LastName = mysqli_real_escape_string($con, $_POST['LastName']);
        $Telephone = mysqli_real_escape_string($con, $_POST['Telephone']);
        $Email = mysqli_real_escape_string($con, $_POST['Email']);
        $Password = mysqli_real_escape_string($con, $_POST['Password']);
        $NationalID = mysqli_real_escape_string($con, $_POST['NationalID']);
        $PassportNo = mysqli_real_escape_string($con, $_POST['PassportNo']);
        $DOB = mysqli_real_escape_string($con, $_POST['DOB']);
        $Gender = mysqli_real_escape_string($con, $_POST['Gender']);

        // Insert data into database
        $sql = "INSERT INTO guest (GuestID, FirstName, LastName, Telephone, Email, Password, NationalID, PassportNo, DOB, Gender) VALUES ('$GuestID', '$FirstName', '$LastName', '$Telephone', '$Email', '$Password', '$NationalID', '$PassportNo', '$DOB', '$Gender')";

        // Execute insert query
        if (mysqli_query($con, $sql)) {
            // Store success message in session
            $_SESSION['success_message'] = "Guest inserted successfully";

            // Redirect to the same page to prevent displaying old data
            header("Location: {$_SERVER['PHP_SELF']}?id=$GuestID");
            exit();
        } else {
            $error_message = "Error inserting guest details: " . mysqli_error($con);
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

include 'GuestInsertForm.php';
?>
