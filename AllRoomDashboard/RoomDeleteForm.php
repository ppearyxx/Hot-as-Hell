<?php
// Establish connection to MySQL database
$con = mysqli_connect("localhost", "root", "", "hot_as_hell");

// Check connection
if (mysqli_connect_errno()) {
    echo "Failed to connect to MySQL: " . mysqli_connect_error();
}

// Retrieve RoomID from URL parameter
$roomID = isset($_GET['id']) ? $_GET['id'] : '';
if (!$roomID) {
    echo "Room ID not provided.";
    exit;
}

// Fetch room details from the database based on RoomID
$query = "SELECT * FROM room WHERE RoomID = '$roomID'";
$result = mysqli_query($con, $query);

// Check if room exists
if (mysqli_num_rows($result) === 0) {
    echo "Room not found.";
    exit;
}

// Fetch room details
$row = mysqli_fetch_assoc($result);
$roomType = $row['RoomType'];
$employeeID = $row['EmployeeID'];
$roomStatus = $row['RoomStatus'];

// Handle deletion confirmation
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    if (isset($_POST['confirm_delete'])) {
        // Execute delete query
        $deleteQuery = "DELETE FROM room WHERE RoomID = '$roomID'";
        if (mysqli_query($con, $deleteQuery)) {
            echo "Room deleted successfully.";
            echo '<br><a href="RoomSearch.php">Back</a>';
            exit;
        } else {
            echo "Error deleting room: " . mysqli_error($con);
            exit;
        }
    } elseif (isset($_POST['cancel_delete'])) {
        // Redirect back to the room search page
        header("Location: RoomSearch.php");
        exit;
    }
}

mysqli_close($con);
?>

<!-- Centered delete confirmation form -->
<div style="display: flex; justify-content: center;">
    <form method="post" style="text-align: left;">
        <p>Are you sure you want to delete the following room?</p>
        <p>Room ID: <?php echo $roomID; ?></p>
        <p>Room Type: <?php echo $roomType; ?></p>
        <p>Employee ID: <?php echo $employeeID; ?></p>
        <p>Room Status: <?php echo $roomStatus; ?></p>
        <input type="submit" name="confirm_delete" value="Confirm Delete">
        <input type="submit" name="cancel_delete" value="Cancel">
    </form>
</div>
