<?php
// Establishing connection to MySQL database
$con=mysqli_connect("localhost","root","","hot_as_hell");
// Check connection
if (mysqli_connect_errno()) {
    echo "Failed to connect to MySQL: " . mysqli_connect_error();
    exit();
}

// Retrieving user input from the form fields and handling empty inputs
$RoomType = isset($_POST['room_type']) ? $_POST['room_type'] : '';
$RoomDetail = isset($_POST['room_detail']) ? $_POST['room_detail'] : '';

// Check if all inputs are empty
if (empty($RoomType) && empty($RoomDetail)) {
    echo "<p style='color: red; text-align: center;'>Please fill in the information.</p>";
} else {
    // Counter for numbering rows
    $r = 1;

    // Constructing the SQL query based on user input
    $query = "SELECT * FROM room_details WHERE 1=1";
    if (!empty($RoomType)) {
        $query .= " AND RoomType LIKE '%$RoomType%'";
    }
    if (!empty($RoomDetail)) {
        $query .= " AND RoomDetail LIKE '%$RoomDetail%'";
    }
    $query .= " ORDER BY RoomType ASC";

    // Executing the SQL query
    $result = mysqli_query($con, $query);

    // Check if there are any results
    if (mysqli_num_rows($result) > 0) {
        // Displaying the fetched data in a table format
        echo "<table border='1' align='center' class='table table-hover'>";
        echo "<tr>";
        echo "<td>No</td>";
        echo "<td>Room Type</td>";
        echo "<td>Room Detail</td>";
        echo "<td>Room Price</td>";
        echo "<td>Actions</td>"; // New column for actions
        echo "</tr>";

        foreach ($result as $row) {
            echo "<tr>";
            echo "<td>" . $r++ . "</td>";
            echo "<td>" . $row["RoomType"] . "</td>";
            echo "<td>" . $row["RoomDetail"] . "</td>";
            echo "<td>" . $row["RoomPrice"] . "</td>";
            echo "<td>";
            echo "<a href='RoomDetailEditForm.php?type=" . $row["RoomType"] . "'>Edit</a> | "; // Updated link
            echo "<a href='RoomDetailDeleteForm.php?type=" . $row["RoomType"] . "'>Delete</a>"; // Delete button
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
<form name="inpfrm" method="post" action="RoomDetailInsertForm.php">
    <table border="0" class="table table-hover" style="margin: 0 auto;">
        <tr>
            <td align="center"><input name="reset" type="submit" id="insert" value="Insert New Room Detail" /></td>
        </tr>
    </table>
</form>

<form name="inpfrm" method="post" action="RoomDetailSearchForm.php">
    <table border="0" class="table table-hover" style="margin: 0 auto;">
        <tr>
            <td align="center"><input name="reset" type="submit" id="Back" value="Back" /></td>
        </tr>
    </table>
</form>

<form name="inpfrm" method="post" action="RoomDetailDashboard.php">
    <table border="0" class="table table-hover" style="margin: 0 auto;">
        <tr>
            <td align="center"><input name="reset" type="submit" id="view" value="View All Room Details" /></td>
        </tr>
    </table>
</form>
