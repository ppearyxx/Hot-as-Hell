<?php
$con = mysqli_connect("localhost", "root", "", "hot_as_hell");
// Check connection
if (mysqli_connect_errno()) {
    echo "Failed to connect to MySQL: " . mysqli_connect_error();
}
?>
<form name="inpfrm" method="post" action="PositionInsert.php">
    <table width="500" height="10" border="0" align="left" cellpadding="0" cellspacing="0">
        <tr>
            <td height="30" align="right"></td>
            <td width="105" align="left"> Insert New Position </td>
        </tr>
        <tr>
            <td height="30" align="right">Position ID : </td>
            <td width="105" align="left"><input name="position_id" type="text" id="position_id" size="30" value="" maxlength="4" placeholder="P000"> </td>
        </tr>
        <tr>
            <td height="30" align="right">Position Name : </td>
            <td width="105" align="left">
                <input name="position_name" type="text" id="position_name" size="30" value="" placeholder="Enter position name"> 
            </td>
        </tr>
        <tr>
            <td height="30" align="right">Salary : </td>
            <td width="105" align="left"><input name="salary" type="text" id="salary" size="30" value="" placeholder="Enter salary"> </td>
        </tr>          
        <tr>
            <td height="30" align="right"></td>
            <td width="105" align="right"><input name="INSERT" type="submit" id="INSERT" value="Insert" /></td>
        </tr>
    </table>
</form> 

<!-- Second form for the "Back" button -->
<form name="inpfrm" method="post" action="PositionDashboard.php">
    <table border="0" class="table table-hover" style="margin: 0 auto;">
        <tr>
            <td align="center"><input name="reset" type="submit" id="Back" value="Back" /></td>
        </tr>
    </table>
</form>
