<?php
// Establishing connection to MySQL database
$con=mysqli_connect("localhost","root","","hot_as_hell");
// Check connection
if (mysqli_connect_errno()) {
    echo "Failed to connect to MySQL: " . mysqli_connect_error();
}

// Retrieving user input from the form fields and handling empty inputs
$RoomType = isset($_POST['room_type']) ? $_POST['room_type'] : '';

// Counter for numbering rows
$r=1;
// Constructing the SQL query based on user input
$query = "SELECT * FROM room_details WHERE RoomType LIKE '%$RoomType%' ORDER BY RoomType ASC";

// Executing the SQL query
$result = mysqli_query($con, $query);

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
    echo "<td>".$r++."</td>";
    echo "<td>".$row["RoomType"]."</td>";
    echo "<td>".$row["RoomDetail"]."</td>";
    echo "<td>".$row["RoomPrice"]."</td>";
    echo "<td>";
    echo "<a href='RoomDetailEditForm.php?type=".$row["RoomType"]."'>Edit</a> | "; // Updated link
    echo "<a href='RoomDetailDeleteForm.php?type=".$row["RoomType"]."'>Delete</a>"; // Delete button
    echo "</td>";
    echo "</tr>";
}
echo "</table>";

// Closing the database connection
mysqli_close($con);
?>

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
            <td align="center"><input name="reset" type="submit" id="Back" value="Seach For Room Detail" /></td>
        </tr>
    </table>
</form>
