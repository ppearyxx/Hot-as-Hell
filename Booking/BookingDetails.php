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

// Execute a SELECT query to fetch records from the booking table
if ($search) {
    $query = "SELECT * FROM booking_details WHERE BookingNo LIKE '%$search%' OR BookingDate LIKE '%$search%' OR BookingTime LIKE '%$search%' OR GuestID LIKE '%$search%' OR PaymentID LIKE '%$search%' OR AdultCount LIKE '%$search%' OR ChildrenCount LIKE '%$search%'";
} else {
    $query = "SELECT * FROM booking_details";
}

$result = mysqli_query($con, $query);

// Check if query executed successfully
if ($result) {
    // Check if there are any records
    if (mysqli_num_rows($result) > 0) {
        // Process the results and display them
        while ($row = mysqli_fetch_assoc($result)) {
            echo "<tr>";
            echo "<td>".$row['BookingNo']."</td>";
            echo "<td>".$row['BookingDate']."</td>";
            echo "<td>".$row['BookingTime']."</td>";
            echo "<td>".$row['GuestID']."</td>";
            echo "<td>".$row['PaymentID']."</td>";
            echo "<td>".$row['AdultCount']."</td>";
            echo "<td>".$row['ChildrenCount']."</td>";
            echo "<td>";
            echo "<div style='display: flex; gap: 5px;'>";
            echo "<a href='BookingEditForm.php?id=".$row["BookingNo"]."'><button style='color: white; border-radius: 5px; background-color: #00868D; padding: 5px; border: none;'>Edit</button></a>";
            echo "<a href='BookingDeleteForm.php?id=".$row["BookingNo"]."'><button style='color: white; border-radius: 5px; background-color: #DC3545; padding: 5px; border: none;'>Delete</button></a>";
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
