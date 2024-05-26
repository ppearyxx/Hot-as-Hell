<?php
// Establish connection to MySQL database
$con = mysqli_connect("localhost", "root", "", "hot_as_hell");

// Check connection
if (mysqli_connect_errno()) {
    echo "Failed to connect to MySQL: " . mysqli_connect_error();
}

// Retrieve EmployeeID from URL parameter
$GuestID = isset($_GET['id']) ? $_GET['id'] : '';
if (!$GuestID) {
    echo "Guest ID not provided.";
    exit;
}

// Fetch employee details from the database based on EmployeeID
$query = "SELECT * FROM guest WHERE GuestID = '$GuestID'";
$result = mysqli_query($con, $query);

// Check if employee exists
if (mysqli_num_rows($result) === 0) {
    echo "Guest not found.";
    exit;
}

// Fetch employee details
$row = mysqli_fetch_assoc($result);
$FirstName = $row['FirstName'];
$LastName= $row['LastName'];
$Telephone = $row['Telephone'];
$Email = $row['Email'];
$Password = $row['Password'];
$NationalID = $row['NationalID'];
$PassportNo = $row['PassportNo'];
$DOB = $row['DOB'];
$Gender = $row['Gender'];

// Handle deletion confirmation
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    if (isset($_POST['confirm_delete'])) {
        // Execute delete query
        $deleteQuery = "DELETE FROM guest WHERE GuestID = '$GuestID'";
        if (mysqli_query($con, $deleteQuery)) {
            echo "<div style='color: green; text-align: center;'>Guest deleted successfully.</div>";
            echo '<div style="text-align: center;"><a href="GuestFB.php" class="btn btn-secondary-custom">Back</a></div>';
            exit;
        } else {
            echo "Error deleting guest: " . mysqli_error($con);
            exit;
        }
    } elseif (isset($_POST['cancel_delete'])) {
        // Redirect back to the employee dashboard
        header("Location: GuestFB.php");
        exit;
    }
}

mysqli_close($con);
?>
