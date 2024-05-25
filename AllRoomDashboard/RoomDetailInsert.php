<?php
$con = mysqli_connect("localhost", "root", "", "hot_as_hell");
// Check connection
if (mysqli_connect_errno()) {
    echo "Failed to connect to MySQL: " . mysqli_connect_error();
}

// Handle form submission
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Retrieve form data
    $roomType = mysqli_real_escape_string($con, $_POST['room_type']);
    $roomDetail = mysqli_real_escape_string($con, $_POST['room_detail']);
    $roomPrice = mysqli_real_escape_string($con, $_POST['room_price']);

    // Insert new room details into the database
    $insertQuery = "INSERT INTO room_details (RoomType, RoomDetail, RoomPrice) VALUES ('$roomType', '$roomDetail', '$roomPrice')";
    if (mysqli_query($con, $insertQuery)) {
        echo "New room details inserted successfully.";
        echo '<br><a href="RoomDetailDashboard.php">Back</a>';
    } else {
        echo "Error inserting room details: " . mysqli_error($con);
    }
}

mysqli_close($con);
?>
