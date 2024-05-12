<?php
$con=mysqli_connect("localhost","root","","my_hotel");
// Check connection
if (mysqli_connect_errno()) {
    echo "Failed to connect to MySQL: " . mysqli_connect_error();
}
?>

<form name="updateEmployeeForm" method="post" action="employee_update.php">
    <table width="500" border="0" align="center" cellpadding="5" cellspacing="0">
        <tr>
            <td colspan="2" align="center"><strong>Update Employee</strong></td>
        </tr>
        <tr>
            <td align="right">Employee ID:</td>
            <td><input name="EmployeeID" type="text" id="EmployeeID" size="30" value="" maxlength="30"></td>
        </tr>
        <tr>
            <td align="right">First Name:</td>
            <td><input name="FirstName" type="text" id="FirstName" size="30" value="" maxlength="50"></td>
        </tr>
        <tr>
            <td align="right">Last Name:</td>
            <td><input name="LastName" type="text" id="LastName" size="30" value="" maxlength="50"></td>
        </tr>
        <tr>
            <td align="right">Position ID:</td>
            <td><input name="PositionID" type="text" id="PositionID" size="30" value="" maxlength="30"></td>
        </tr>
        <tr>
            <td align="right">Contact:</td>
            <td><input name="Contact" type="text" id="Contact" size="20" value="" maxlength="20"></td>
        </tr>
        <tr>
            <td align="right">DOB:</td>
            <td><input name="DOB" type="date" id="DOB" size="10" value=""></td>
        </tr>
        <tr>
            <td align="right">Gender:</td>
            <td>
                <select name="Gender" id="Gender">
                    <option value="Male">Male</option>
                    <option value="Female">Female</option>
                </select>
            </td>
        </tr>
        <tr>
            <td colspan="2" align="center"><input name="Update" type="submit" id="Update" value="Update" /></td>
        </tr>
    </table>
</form>
