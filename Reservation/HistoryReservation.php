<?php
// Connect to the database
$con = mysqli_connect("localhost", "root", "", "hot_as_hell");

// Check connection
if (mysqli_connect_errno()) {
    echo "Failed to connect to MySQL: " . mysqli_connect_error();
    exit();
}

// Get the search term
$search = isset($_GET['search']) ? mysqli_real_escape_string($con, $_GET['search']) : '';

// Execute a SELECT query to fetch records from the reservation table
if ($search) {
    $query = "SELECT * FROM reservation WHERE ReservationID LIKE '%$search%' OR BookingNo LIKE '%$search%' OR RoomID LIKE '%$search%' OR CheckInDate LIKE '%$search%' OR CheckInTime LIKE '%$search%' OR CheckOutDate LIKE '%$search%' OR CheckOutTime LIKE '%$search%'";
} else {
    $query = "SELECT * FROM reservation";
}

$result = mysqli_query($con, $query);

// Check if query executed successfully
if ($result) {
    // Check if there are any records
    if (mysqli_num_rows($result) > 0) {
        // Process the results and display them
        while ($row = mysqli_fetch_assoc($result)) {
            echo "<tr>";
            echo "<td>".$row['ReservationID']."</td>";
            echo "<td>".$row['BookingNo']."</td>";
            echo "<td>".$row['RoomID']."</td>";
            echo "<td>".$row['CheckInDate']."</td>";
            echo "<td>".$row['CheckInTime']."</td>";
            echo "<td>".$row['CheckOutDate']."</td>";
            echo "<td>".$row['CheckOutTime']."</td>";
            echo "<td>";
            echo "<div style='display: flex; gap: 5px;'>";
            echo "<a href='ReservationEditForm.php?id=".$row["ReservationID"]."'><button style='color: white; border-radius: 5px; background-color: #00868D; padding: 5px; border: none;'>Edit</button></a>";
            echo "<a href='ReservationDeleteForm.php?id=".$row["ReservationID"]."'><button style='color: white; border-radius: 5px; background-color: #DC3545; padding: 5px; border: none;'>Delete</button></a>";
            echo "</div>";
            echo "</td>";
            echo "</tr>";
        }
    } else {
        echo "<tr><td colspan='8'>No records found</td></tr>";
    }
} else {
    echo "Error: " . mysqli_error($con);
}

// Close the database connection
mysqli_close($con);
?>
