<?php
$con=mysqli_connect("localhost","root","","hot_as_hell");
//Check connection
if (mysqli_connect_errno()) {
    echo "Failed to connect to MySQL: " . mysqli_connect_error();
}
?>

<form name="inpfrm" method="post" action="PositionSearch.php">
<table width="500" height="10" border="0" align="left" cellpadding="0" cellspacing="0">
    <tr>
        <td height="30" align="right"></td>
        <td width="105" align="left"> Search For Positions </td>
    </tr>
    <tr>
        <td height="30" align="right">Position ID : </td>
        <td width="105" align="left"><input name="position_id" type="text" id="position_id" size="30" value="" maxlength="4" placeholder="P000"> </td>
    </tr>
    <tr>
        <td height="30" align="right">Position : </td>
        <td width="105" align="left"><input name="position" type="text" id="position" size="30" value="" placeholder="Enter Position"> </td>
    </tr>
    <tr>
        <td height="30" align="right">Salary : </td>
        <td width="105" align="left"><input name="salary" type="text" id="salary" size="30" value="" placeholder="Enter Salary"> </td>
    </tr>
    <tr>
        <td height="30" align="right"></td>
        <td width="105" align="right"><input name="search" type="submit" id="search" value="Search" /></td>
    </tr>
    
</table>
</form>
