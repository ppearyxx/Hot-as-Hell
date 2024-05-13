<?php
$con = mysqli_connect("localhost", "root", "", "hot_as_hell");
// Check connection
if (mysqli_connect_errno()) {
    echo "Failed to connect to MySQL: " . mysqli_connect_error();
    exit();
}

// Execute a SELECT query to fetch all records from the room_details table
$query = "SELECT * FROM room_details";
$result = mysqli_query($con, $query);

// Check if there are any records
if (mysqli_num_rows($result) > 0) {
    // Process the results and display them
    echo "<div style='text-align: center;'>"; // Center-align the content
    echo "<table border='1' style='margin: 0 auto;'>"; // Set margin to auto for horizontal centering
    echo "<tr><th>RoomType</th><th>RoomDetail</th><th>RoomPrice</th>";
    while ($row = mysqli_fetch_assoc($result)) {
        echo "<tr>";
        echo "<td>".$row['RoomType']."</td>";
        echo "<td>".$row['RoomDetail']."</td>";
        echo "<td>".$row['RoomPrice']."</td>"; 
        // Display the image for each room type
        //echo "<td><img src='".$row['RoomType'].".jpg' alt='".$row['RoomType']."' width='100'></td>";      
        echo "</tr>";
    }
    echo "</table>";
    echo "</div>";
} else {
    echo "No records found";
}

mysqli_close($con);
?>
