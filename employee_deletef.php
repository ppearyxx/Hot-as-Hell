<?php
$con=mysqli_connect("localhost","root","","my_hotel");
//Check connection
if (mysqli_connect_errno()) {
    echo "Failed to connect to MySQL: " . mysqli_connect_error();
}
?>

<form name="deleteEmployeeForm" method="post" action="employee_delete.php">
    <table width="500" border="0" align="center" cellpadding="5" cellspacing="0">
        <tr>
            <td colspan="2" align="center"><strong>Delete Employee</strong></td>
        </tr>
        <tr>
            <td align="right">Employee ID:</td>
            <td><input name="EmployeeID" type="text" id="EmployeeID" size="30" value="" maxlength="30"></td>
        </tr>
        <tr>
            <td colspan="2" align="center"><input name="Delete" type="submit" id="Delete" value="Delete" /></td>
        </tr>
    </table>
</form>
