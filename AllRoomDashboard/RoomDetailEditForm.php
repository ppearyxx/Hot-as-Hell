<?php
// Establishing connection to MySQL database
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

// Check if room exists
if (mysqli_num_rows($result) === 0) {
    echo "Room not found.";
    exit;
}

// Fetch room details
$row = mysqli_fetch_assoc($result);
$roomDetail = $row['RoomDetail'];
$roomPrice = $row['RoomPrice'];

// Handle form submission for updating room details
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Retrieve updated details from form fields
    $updatedRoomType = mysqli_real_escape_string($con, $_POST['room_type']);
    $updatedRoomDetail = mysqli_real_escape_string($con, $_POST['room_detail']);
    $updatedRoomPrice = mysqli_real_escape_string($con, $_POST['room_price']);

    // Update room details in the database
    $updateQuery = "UPDATE room_details SET RoomType = '$updatedRoomType', RoomDetail = '$updatedRoomDetail', RoomPrice = '$updatedRoomPrice' WHERE RoomType = '$roomType'";
    if (mysqli_query($con, $updateQuery)) {
        echo "Room details updated successfully.";
    } else {
        echo "Error updating room details: " . mysqli_error($con);
    }
}

mysqli_close($con);
?>

<!-- Display form pre-filled with existing room details -->
<?php if ($roomType): ?>
<form method="post">
    <label for="room_type">Room Type:</label>
    <input type="text" id="room_type" name="room_type" value="<?php echo $roomType; ?>" readonly><br>

    <label for="room_detail">Room Detail:</label>
    <textarea id="room_detail" name="room_detail" rows="10" cols="50"><?php echo $roomDetail; ?></textarea><br>

    <label for="room_price">Room Price:</label>
    <input type="text" id="room_price" name="room_price" value="<?php echo $roomPrice; ?>"><br>

    <input type="submit" value="Update">
</form>
<?php endif; ?>

<form name="inpfrm" method="post" action="RoomDetailSearch.php">
    <table border="0" class="table table-hover" style="margin: 0 auto;">
        <tr>
            <td align="center"><input name="reset" type="submit" id="Back" value="Back" /></td>
        </tr>
    </table>
</form>
