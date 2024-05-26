<?php
//Connect to the database
$con = mysqli_connect("localhost", "root", "", "hot_as_hell");

// Check connection
if (mysqli_connect_errno()) {
    echo "Failed to connect to MySQL: " . mysqli_connect_error();
    exit();
}

//Execute a SELECT query to fetch all records from the Employee table
$query = "SELECT * FROM Employee";
$result = mysqli_query($con, $query);

// Check if there are any records
if (mysqli_num_rows($result) > 0) {
    //Process the results and display them
    while ($row = mysqli_fetch_assoc($result)) {
        echo "<tr>";
        echo "<td>".$row['EmployeeID']."</td>";
        echo "<td>".$row['FirstName']." ".$row['LastName']."</td>";
        echo "<td>".$row['PositionID']."</td>";
        echo "<td>".$row['Contact']."</td>";
        echo "<td>".$row['DOB']."</td>";
        echo "<td>".$row['Gender']."</td>";
        echo "<td>";
        echo "<div style='display: flex; gap: 5px;'>";
        echo "<a href='employee_updatef.php?id=".$row["EmployeeID"]."'><button style='color: white; border-radius: 5px; background-color: #00868D; padding: 5px; border: none;'>Edit</button></a>";
        echo "<a href='employee_deletef.php?id=".$row["EmployeeID"]."'><button style='color: white; border-radius: 5px; background-color: #DC3545; padding: 5px; border: none;'>Delete</button></a>";
        echo "</div>";
        echo "</td>";
        echo "</tr>";
    }
    echo "</table>";
} else {
    echo "<tr><td colspan='8'>No records found</td></tr>";
}

//Close the database connection
mysqli_close($con);
?>
