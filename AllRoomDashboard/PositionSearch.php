<?php
// Establishing connection to MySQL database
$con=mysqli_connect("localhost","root","","hot_as_hell");
// Check connection
if (mysqli_connect_errno()) {
    echo "Failed to connect to MySQL: " . mysqli_connect_error();
    exit();
}

// Retrieving user input from the form fields and handling empty inputs
$PositionID = isset($_POST['position_id']) ? $_POST['position_id'] : '';
$Position = isset($_POST['position']) ? $_POST['position'] : '';
$Salary = isset($_POST['salary']) ? $_POST['salary'] : '';

// Check if all inputs are empty
if (empty($PositionID) && empty($Position) && empty($Salary)) {
    echo "<p style='color: red; text-align: center;'>Please fill in at least one field to search.</p>";
} else {
    // Counter for numbering rows
    $r = 1;

    // Constructing the SQL query based on user input
    $query = "SELECT * FROM employee_position WHERE PositionID LIKE '%$PositionID%' 
              AND Position LIKE '%$Position%'";

    // Adding condition to include Salary in the query only if it's not empty
    if (!empty($Salary)) {
        $query .= " AND Salary = '$Salary'";
    }

    $query .= " ORDER BY PositionID ASC";

    // Executing the SQL query
    $result = mysqli_query($con, $query);

    // Check if there are any results
    if (mysqli_num_rows($result) > 0) {
        // Displaying the fetched data in a table format
        echo "<table border='1' align='center' class='table table-hover'>";
        echo "<tr>";
        echo "<td>No</td>";
        echo "<td>Position ID</td>";
        echo "<td>Position</td>";
        echo "<td>Salary</td>";
        echo "<td>Actions</td>"; // New column for actions
        echo "</tr>";

        foreach ($result as $row) {
            echo "<tr>";
            echo "<td>" . $r++ . "</td>";
            echo "<td>" . $row["PositionID"] . "</td>";
            echo "<td>" . $row["Position"] . "</td>";
            echo "<td>" . $row["Salary"] . "</td>";
            echo "<td>";
            echo "<a href='PositionEditForm.php?id=" . $row["PositionID"] . "'>Edit</a> | "; // Updated link
            echo "<a href='PositionDeleteForm.php?id=" . $row["PositionID"] . "'>Delete</a>"; // Delete button
            echo "</td>";
            echo "</tr>";
        }
        echo "</table>";
    } else {
        echo "<p style='color: red; text-align: center;'>No positions found matching the criteria.</p>";
    }
}

// Closing the database connection
mysqli_close($con);
?>

<!-- Forms for other actions -->
<form name="inpfrm" method="post" action="PositionInsertForm.php">
    <table border="0" class="table table-hover" style="margin: 0 auto;">
        <tr>
            <td align="center"><input name="reset" type="submit" id="insert" value="Insert New Position" /></td>
        </tr>
    </table>
</form>

<form name="inpfrm" method="post" action="PositionSearchForm.php">
    <table border="0" class="table table-hover" style="margin: 0 auto;">
        <tr>
            <td align="center"><input name="reset" type="submit" id="Back" value="Back" /></td>
        </tr>
    </table>
</form>

<form name="inpfrm" method="post" action="PositionDashboard.php">
    <table border="0" class="table table-hover" style="margin: 0 auto;">
        <tr>
            <td align="center"><input name="reset" type="submit" id="Back" value="View All Positions" /></td>
        </tr>
    </table>
</form>
