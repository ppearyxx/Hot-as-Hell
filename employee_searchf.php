<?php
$con = mysqli_connect("localhost", "root", "", "my_hotel");
// Check connection
if (mysqli_connect_errno()) {
    echo "Failed to connect to MySQL: " . mysqli_connect_error();
}
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
