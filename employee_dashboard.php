<?php
//Connect to the database
$con = mysqli_connect("localhost", "root", "", "my_hotel");

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
    echo "<table border='1'>";
    echo "<tr><th>Employee ID</th><th>First Name</th><th>Last Name</th><th>Position ID</th><th>Contact</th><th>DOB</th><th>Gender</th></tr>";
    while ($row = mysqli_fetch_assoc($result)) {
        echo "<tr>";
        echo "<td>".$row['EmployeeID']."</td>";
        echo "<td>".$row['FirstName']."</td>";
        echo "<td>".$row['LastName']."</td>";
        echo "<td>".$row['PositionID']."</td>";
        echo "<td>".$row['Contact']."</td>";
        echo "<td>".$row['DOB']."</td>";
        echo "<td>".$row['Gender']."</td>";
        echo "</tr>";
    }
    echo "</table>";
} else {
    echo "No records found";
}

//Close the database connection
mysqli_close($con);
?>
<form name="employeeSearchForm" method="post" action="employee_search.php">
    <table width="500" height="10" border="0" align="left" cellpadding="5" cellspacing="0">
        <tr>
            <td height="30" align="right"></td>
            <td width="105" align="left"> Search </td>
        </tr>
        <tr>
            <td height="30" align="right">Employee ID : </td>
            <td width="105" align="left"><input name="EmployeeID" type="text" id="EmployeeID" size="30" value="" maxlength="30"> </td>
        </tr>
        <tr>
            <td height="30" align="right">First Name : </td>
            <td width="105" align="left"><input name="FirstName" type="text" id="FirstName" size="30" value="" maxlength="50"> </td>
        </tr>
        <tr>
            <td height="30" align="right">Last Name : </td>
            <td width="105" align="left"><input name="LastName" type="text" id="LastName" size="30" value="" maxlength="50"> </td>
        </tr>
        <tr>
            <td height="30" align="right"></td>
            <td width="105" align="right"><input name="Search" type="submit" id="Search" value="SEARCH" /></td>
        </tr>
    </table>
</form>
