<?php
// Establishing connection to MySQL database
$con=mysqli_connect("localhost","root","","hot_as_hell");
// Check connection
if (mysqli_connect_errno()) {
    echo "Failed to connect to MySQL: " . mysqli_connect_error();
    exit();
}

// Retrieving user input from the form fields and handling empty inputs
$RoomID = isset($_POST['room_id']) ? $_POST['room_id'] : '';
$RoomType = isset($_POST['room_type']) ? $_POST['room_type'] : '';
$EmployeeID = isset($_POST['employee_id']) ? $_POST['employee_id'] : '';
$RoomStatus = isset($_POST['room_status']) ? $_POST['room_status'] : '';

// Check if all inputs are empty
if (empty($RoomID) && $RoomType === 'NON' && empty($EmployeeID) && empty($RoomStatus)) {
    echo "<p style='color: red; text-align: center;'>Please fill in the information.</p>";
} else {
    // Counter for numbering rows
    $r = 1;

    // Constructing the SQL query based on user input
    $query = "SELECT * FROM room WHERE RoomID LIKE '%$RoomID%' 
              AND EmployeeID LIKE '%$EmployeeID%'";

    // Adding condition to include RoomType in the query only if it's not "NON"
    if ($RoomType !== "NON") {
        $query .= " AND RoomType LIKE '%$RoomType%'";
    }

    $query .= " ORDER BY RoomID ASC";

    // Executing the SQL query
    $result = mysqli_query($con, $query);

    // Check if there are any results
    if (mysqli_num_rows($result) > 0) {
        // Displaying the fetched data in a table format
        echo "<table border='1' align='center' class='table table-hover'>";
        echo "<tr>";
        echo "<td>No</td>";
        echo "<td>Room ID</td>";
        echo "<td>Room Type</td>";
        echo "<td>Employee ID</td>";
        echo "<td>Room Status</td>";
        echo "<td>Actions</td>"; // New column for actions
        echo "</tr>";

        foreach ($result as $row) {
            echo "<tr>";
            echo "<td>" . $r++ . "</td>";
            echo "<td>" . $row["RoomID"] . "</td>";
            echo "<td>" . $row["RoomType"] . "</td>";
            echo "<td>" . $row["EmployeeID"] . "</td>";
            echo "<td>" . $row["RoomStatus"] . "</td>";
            echo "<td>";
            echo "<a href='RoomEditForm.php?id=" . $row["RoomID"] . "'>Edit</a> | "; // Updated link
            echo "<a href='RoomDeleteForm.php?id=" . $row["RoomID"] . "'>Delete</a>"; // Delete button
            echo "</td>";
            echo "</tr>";
        }
        echo "</table>";
    } else {
        echo "<p style='color: red; text-align: center;'>No rooms found matching the criteria.</p>";
    }
}

// Closing the database connection
mysqli_close($con);
?>

<!-- Forms for other actions -->
<form name="inpfrm" method="post" action="RoomInsertForm.php">
    <table border="0" class="table table-hover" style="margin: 0 auto;">
        <tr>
            <td align="center"><input name="reset" type="submit" id="insert" value="Insert New Room" /></td>
        </tr>
    </table>
</form>

<form name="inpfrm" method="post" action="RoomSearchForm.php">
    <table border="0" class="table table-hover" style="margin: 0 auto;">
        <tr>
            <td align="center"><input name="reset" type="submit" id="Back" value="Back" /></td>
        </tr>
    </table>
</form>

<form name="inpfrm" method="post" action="RoomDashboard.php">
    <table border="0" class="table table-hover" style="margin: 0 auto;">
        <tr>
            <td align="center"><input name="reset" type="submit" id="Back" value="View All Room" /></td>
        </tr>
    </table>
</form>
