<?php
// Establishing connection to MySQL database
$con=mysqli_connect("localhost","root","","hot_as_hell");

// Check connection
if (mysqli_connect_errno()) {
    echo "Failed to connect to MySQL: " . mysqli_connect_error();
    exit();
}

// Retrieving user input from the form fields and handling empty inputs
$PaymentMethodID = isset($_POST['payment_method_id']) ? $_POST['payment_method_id'] : '';
$PaymentMethodName = isset($_POST['payment_method_name']) ? $_POST['payment_method_name'] : '';

// Check if all inputs are empty
if (empty($PaymentMethodID) && empty($PaymentMethodName)) {
    echo "<p style='color: red; text-align: center;'>Please fill in at least one field to search.</p>";
} else {
    // Counter for numbering rows
    $r = 1;

    // Constructing the SQL query based on user input
    $query = "SELECT * FROM payment_method WHERE PaymentMethodID LIKE '%$PaymentMethodID%' 
              AND PaymentMethodName LIKE '%$PaymentMethodName%'";

    $query .= " ORDER BY PaymentMethodID ASC";

    // Executing the SQL query
    $result = mysqli_query($con, $query);

    // Check if there are any results
    if (mysqli_num_rows($result) > 0) {
        // Displaying the fetched data in a table format
        echo "<table border='1' align='center' class='table table-hover'>";
        echo "<tr>";
        echo "<td>No</td>";
        echo "<td>Payment Method ID</td>";
        echo "<td>Payment Method Name</td>";
        echo "<td>Actions</td>"; // New column for actions
        echo "</tr>";

        foreach ($result as $row) {
            echo "<tr>";
            echo "<td>" . $r++ . "</td>";
            echo "<td>" . $row["PaymentMethodID"] . "</td>";
            echo "<td>" . $row["PaymentMethodName"] . "</td>";
            echo "<td>";
            echo "<a href='MethodEditForm.php?id=" . $row["PaymentMethodID"] . "'>Edit</a> | "; // Edit button
            echo "<a href='MethodDeleteForm.php?id=" . $row["PaymentMethodID"] . "'>Delete</a>"; // Delete button
            echo "</td>";
            echo "</tr>";
        }
        echo "</table>";
    } else {
        echo "<p style='color: red; text-align: center;'>No payment methods found matching the criteria.</p>";
    }
}

// Closing the database connection
mysqli_close($con);
?>

<!-- Forms for other actions -->
<form name="inpfrm" method="post" action="MethodInsertForm.php">
    <table border="0" class="table table-hover" style="margin: 0 auto;">
        <tr>
            <td align="center"><input name="reset" type="submit" id="insert" value="Insert New Payment Method" /></td>
        </tr>
    </table>
</form>

<form name="inpfrm" method="post" action="MethodDashboard.php">
    <table border="0" class="table table-hover" style="margin: 0 auto;">
        <tr>
            <td align="center"><input name="reset" type="submit" id="Back" value="View All Payment Methods" /></td>
        </tr>
    </table>
</form>
