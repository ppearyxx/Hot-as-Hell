<?php
// Start session
session_start();

// Establishing connection to MySQL database
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "hot_as_hell";

$conn = mysqli_connect($servername, $username, $password, $dbname);

// Check connection
if (mysqli_connect_errno()) {
    echo "Failed to connect to MySQL: " . mysqli_connect_error();
    exit;
}

// Retrieve ReservationID from URL parameter
$GuestID = isset($_GET['id']) ? $_GET['id'] : '';
if (!$GuestID) {
    echo "Guest ID not provided.";
    exit;
}

// Fetch reservation details from the database based on ReservationID
$query = "SELECT * FROM guest WHERE GuestID = '$GuestID'";
$result = mysqli_query($conn, $query);

// Check if reservation exists
if (mysqli_num_rows($result) === 0) {
    echo "Guest not found.";
    exit;
}

// Fetch reservation details
$row = mysqli_fetch_assoc($result);
$GuestID = $row['GuestID'];
$FirstName = $row['FirstName'];
$LastName = $row['LastName'];
$Telephone = $row['Telephone'];
$Email = $row['Email'];
$Password = $row['Password'];
$NationalID = $row['NationalID'];
$PassportNo = $row['PassportNo'];
$DOB = $row['DOB'];
$Gender = $row['Gender'];

// Handle form submission for updating reservation details
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Retrieve updated details from form fields
    $updatedFirstName = mysqli_real_escape_string($conn, $_POST['FirstName']);
    $updatedLastName = mysqli_real_escape_string($conn, $_POST['LastName']);
    $updatedTelephone = mysqli_real_escape_string($conn, $_POST['Telephone']);
    $updatedEmail = mysqli_real_escape_string($conn, $_POST['Email']);
    $updatedPassword = mysqli_real_escape_string($conn, $_POST['Password']);
    $updatedNationalID = mysqli_real_escape_string($conn, $_POST['NationalID']);
    $updatedPassportNo = mysqli_real_escape_string($conn, $_POST['PassportNo']);
    $updatedDOB = mysqli_real_escape_string($conn, $_POST['DOB']);
    $updatedGender = mysqli_real_escape_string($conn, $_POST['Gender']);

    // Update reservation details in the database
    $updateQuery = "UPDATE guest SET FirstName = '$updatedFirstName', LastName = '$updatedLastName', Telephone = '$updatedTelephone', Email = '$updatedEmail', Password = '$updatedPassword', NationalID = '$updatedNationalID', PassportNo = '$updatedPassportNo', DOB = '$updatedDOB', Gender = '$updatedGender' WHERE GuestID = '$GuestID'";
    
    // Execute update query
    if (mysqli_query($conn, $updateQuery)) {
        // Store success message in session
        $_SESSION['success_message'] = "Guest details updated successfully.";

        // Redirect to the same page to prevent displaying old data
        header("Location: {$_SERVER['PHP_SELF']}?id=$GuestID");
        exit();
    } else {
        echo "Error updating guest details: " . mysqli_error($conn);
    }
}

// Close the database connection
mysqli_close($conn);
?>
