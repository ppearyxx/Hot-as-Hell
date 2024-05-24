<?php
// Establish connection to MySQL database
$con = mysqli_connect("localhost", "root", "", "hot_as_hell");

// Check connection
if (mysqli_connect_errno()) {
    echo "Failed to connect to MySQL: " . mysqli_connect_error();
}

// Retrieve RoomType from URL parameter
$roomType = isset($_GET['type']) ? $_GET['type'] : '';
if (!$roomType) {
    echo "Room Type not provided.";
    exit;
}

// Fetch room details from the database based on RoomType
$query = "SELECT * FROM room_details WHERE RoomType = '$roomType'";
$result = mysqli_query($con, $query);

// Check if room details exist
if (mysqli_num_rows($result) === 0) {
    echo "Room details not found.";
    exit;
}

// Fetch room details
$row = mysqli_fetch_assoc($result);
$roomDetail = $row['RoomDetail'];
$roomPrice = $row['RoomPrice'];

// Handle deletion confirmation
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    if (isset($_POST['confirm_delete'])) {
        // Execute delete query
        $deleteQuery = "DELETE FROM room_details WHERE RoomType = '$roomType'";
        if (mysqli_query($con, $deleteQuery)) {
            echo "Room details deleted successfully.";
            echo '<br><a href="RoomDetailSearch.php">Back</a>';
            exit;
        } else {
            echo "Error deleting room details: " . mysqli_error($con);
            exit;
        }
    } elseif (isset($_POST['cancel_delete'])) {
        // Redirect back to the room details search page
        header("Location: RoomDetailSearch.php");
        exit;
    }
}

mysqli_close($con);
?>

<!-- Centered delete confirmation form -->
<div style="display: flex; justify-content: center;">
    <form method="post" style="text-align: left;">
        <p>Are you sure you want to delete the following room details?</p>
        <p><strong>Room Type:</strong> <?php echo htmlspecialchars($roomType); ?></p>
        <p><strong>Room Detail:</strong> <?php echo htmlspecialchars($roomDetail); ?></p>
        <p><strong>Room Price:</strong> <?php echo htmlspecialchars($roomPrice); ?></p>
        <input type="submit" name="confirm_delete" value="Confirm Delete">
        <input type="submit" name="cancel_delete" value="Cancel">
    </form>
</div>
