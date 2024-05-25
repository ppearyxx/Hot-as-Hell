<?php
// Connect to the database
$con = mysqli_connect("localhost", "root", "", "hot_as_hell");

// Check connection
if (mysqli_connect_errno()) {
    echo "Failed to connect to MySQL: " . mysqli_connect_error();
    exit();
}

// Execute a SELECT query to fetch all records from the Payment table
$query = "SELECT * FROM Payment";
$result = mysqli_query($con, $query);

// Check if there are any records
if (mysqli_num_rows($result) > 0) {
    // Process the results and display them
    while ($row = mysqli_fetch_assoc($result)) {
        echo "<tr>";
        echo "<td>".$row['PaymentID']."</td>";
        echo "<td>".$row['EarnestPayCheck']."</td>";
        echo "<td>".$row['PaymentMethodID']."</td>";
        echo "<td>".$row['PromotionID']."</td>";
        echo "<td>".$row['TotalAmount']."</td>";
        echo "<td>".$row['EarnestPayDatetime']."</td>";
        echo "<td>".$row['TotalPayDatetime']."</td>";
        echo "<td>";
        echo "<div style='display: flex; gap: 5px;'>";
        echo "<a href='payment_updatef.php?id=".$row["PaymentID"]."'><button style='color: white; border-radius: 5px; background-color: #00868D; padding: 5px; border: none;'>Edit</button></a>";
        echo "<a href='payment_deletef.php?id=".$row["PaymentID"]."'><button style='color: white; border-radius: 5px; background-color: #DC3545; padding: 5px; border: none;'>Delete</button></a>";
        echo "</div>";
        echo "</td>";
        echo "</tr>";
    }
} else {
    echo "<tr><td colspan='7'>No records found</td></tr>";
}

// Close the database connection
mysqli_close($con);
?>
