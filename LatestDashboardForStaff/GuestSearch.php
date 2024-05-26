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

// Execute a SELECT query to fetch records from the guest table
if ($search) {
    $query = "SELECT * FROM guest WHERE GuestID LIKE '%$search%' OR FirstName LIKE '%$search%' OR LastName LIKE '%$search%' OR Telephone LIKE '%$search%' OR Email LIKE '%$search%' OR NationalID LIKE '%$search%' OR PassportNo LIKE '%$search%'";
} else {
    $query = "SELECT * FROM guest";
}

$result = mysqli_query($con, $query);

// Check if query executed successfully
if ($result) {
    // Check if there are any records
    if (mysqli_num_rows($result) > 0) {
        // Process the results and display them
        while ($row = mysqli_fetch_assoc($result)) {
            echo "<tr>";
            echo "<td>".$row['GuestID']."</td>";
            echo "<td>".$row['FirstName']."</td>";
            echo "<td>".$row['LastName']."</td>";
            echo "<td>".$row['Telephone']."</td>";
            echo "<td>".$row['Email']."</td>";
            echo "<td>".$row['Password']."</td>";
            echo "<td>".$row['NationalID']."</td>";
            echo "<td>".$row['PassportNo']."</td>";
            echo "<td>".$row['DOB']."</td>";
            echo "<td>".$row['Gender']."</td>";
            echo "<td>";
            echo "<div style='display: flex; gap: 5px;'>";
            echo "<a href='GuestEditForm.php?id=".$row["GuestID"]."'><button style='color: white; border-radius: 5px; background-color: #00868D; padding: 5px; border: none;'>Edit</button></a>";
            echo "<a href='GuestDeleteForm.php?id=".$row["GuestID"]."'><button style='color: white; border-radius: 5px; background-color: #DC3545; padding: 5px; border: none;'>Delete</button></a>";
            echo "</div>";
            echo "</td>";
            echo "</tr>";
        }
    } else {
        echo "<tr><td colspan='11'>No records found</td></tr>";
    }
} else {
    echo "Error: " . mysqli_error($con);
}

// Close the database connection
mysqli_close($con);
?>
