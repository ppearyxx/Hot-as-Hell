<?php
$con = mysqli_connect("localhost", "root", "", "my_hotel");
// Check connection
if (mysqli_connect_errno()) {
    echo "Failed to connect to MySQL: " . mysqli_connect_error();
}

$EmployeeID = mysqli_real_escape_string($con, $_POST['EmployeeID']);
$FirstName = mysqli_real_escape_string($con, $_POST['FirstName']);
$LastName = mysqli_real_escape_string($con, $_POST['LastName']);

$query = "SELECT * FROM Employee WHERE EmployeeID = '$EmployeeID' OR FirstName = '$FirstName' OR LastName = '$LastName'";
$result = mysqli_query($con, $query);

if (mysqli_num_rows($result) > 0) {
    echo "<table border='1' align='center' class='table table-hover'>";
    echo "<tr>";
    echo "<td>"."No"."</td>";
    echo "<td>"."Employee ID"."</td>";
    echo "<td>"."First Name"."</td>";
    echo "<td>"."Last Name"."</td>";
    echo "<td>"."Position ID"."</td>";
    echo "<td>"."Contact"."</td>";
    echo "<td>"."DOB"."</td>";
    echo "<td>"."Gender"."</td>";
    echo "</tr>";

    $r = 1;
    while ($row = mysqli_fetch_assoc($result)) {
        echo "<tr>";
        echo "<td>".$r++."</td>";
        echo "<td>".$row["EmployeeID"]."</td>";
        echo "<td>".$row["FirstName"]."</td>";
        echo "<td>".$row["LastName"]."</td>";
        echo "<td>".$row["PositionID"]."</td>";
        echo "<td>".$row["Contact"]."</td>";
        echo "<td>".$row["DOB"]."</td>";
        echo "<td>".$row["Gender"]."</td>";
        echo "</tr>";
    }

    echo "</table>";
} else {
    echo "No results found.";
}

mysqli_close($con);
?>
<form name="back_employee_s" method="post" action="employee_dashboard.php">
<table border="0" align="center" class="table table-hover">
    <tr>
        <td width="105" align="right"><input name="reset" type="submit" id="Back" value="Back" /></td>
    </tr>
</table>
</form>
