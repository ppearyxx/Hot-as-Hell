<?php
// Establishing connection to MySQL database
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

// Define room types and statuses
$roomTypeOptions = array("Deluxe" => "DLX", "Family" => "FAM", "Standard" => "STD", "Suite" => "SUI");
$roomStatusOptions = array("Available", "Not Available");

// Handle form submission for updating room details
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Retrieve updated details from form fields
    $updatedRoomType = mysqli_real_escape_string($con, $_POST['room_type']);
    $updatedEmployeeID = mysqli_real_escape_string($con, $_POST['employee_id']);
    $updatedRoomStatus = mysqli_real_escape_string($con, $_POST['room_status']);

    // Update room details in the database
    $updateQuery = "UPDATE room SET RoomType = '$updatedRoomType', EmployeeID = '$updatedEmployeeID', RoomStatus = '$updatedRoomStatus' WHERE RoomID = '$roomID'";
    if (mysqli_query($con, $updateQuery)) {
        echo "Room details updated successfully.";
    } else {
        echo "Error updating room details: " . mysqli_error($con);
    }
}

mysqli_close($con);
?>

<!-- Display form pre-filled with existing room details -->
<?php if ($roomID): ?>
<form method="post">
    <label for="room_type">Room Type:</label>
    <select id="room_type" name="room_type">
        <?php foreach ($roomTypeOptions as $option => $value): ?>
            <option value="<?php echo $value; ?>" <?php if ($roomType == $value) echo "selected"; ?>><?php echo $option; ?></option>
        <?php endforeach; ?>
    </select><br>

    <label for="employee_id">Employee ID:</label>
    <input type="text" id="employee_id" name="employee_id" value="<?php echo $employeeID; ?>"><br>

    <label for="room_status">Room Status:</label>
    <select id="room_status" name="room_status">
        <?php foreach ($roomStatusOptions as $status): ?>
            <option value="<?php echo $status; ?>" <?php if ($roomStatus == $status) echo "selected"; ?>><?php echo $status; ?></option>
        <?php endforeach; ?>
    </select><br>

    <input type="submit" value="Update">
</form>
<?php endif; ?>



<form name="inpfrm" method="post" action="RoomSearch.php">
    <table border="0" class="table table-hover" style="margin: 0 auto;">
        <tr>
            <td align="center"><input name="reset" type="submit" id="Back" value="Back" /></td>
        </tr>
    </table>
</form>
