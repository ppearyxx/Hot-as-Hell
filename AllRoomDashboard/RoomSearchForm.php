<?php
$con=mysqli_connect("localhost","root","","hot_as_hell");
//Check connection
if (mysqli_connect_errno()) {
    echo "Failed to connect to MySQL: " . mysqli_connect_error();
}
?>

<form name="inpfrm" method="post" action="RoomSearch.php">
<table width="500" height="10" border="0" align="left" cellpadding="0" cellspacing="0">
    <tr>
        <td height="30" align="right"></td>
        <td width="105" align="left"> Search For Rooms </td>
    </tr>
    <tr>
        <td height="30" align="right">Room ID : </td>
        <td width="105" align="left"><input name="room_id" type="text" id="room_id" size="30" value="" maxlength="5" placeholder="R0000"> </td>
    </tr>
    <tr>
            <td height="30" align="right">Room Type : </td>
            <td width="105" align="left">
                <select name="room_type" id="room_type">
                    <option value="NON">Select Room Type</option>
                    <option value="DLX">Deluxe</option>
                    <option value="FAM">Family</option>
                    <option value="STD">Standard</option>
                    <option value="SUI">Suite</option>
                </select>
            </td>
        </tr>
    <tr>
        <td height="30" align="right">Employee ID : </td>
        <td width="105" align="left"><input name="employee_id" type="text" id="employee_id" size="30" value="" maxlenght="12" placeholder="E00000000000"> </td>
    </tr>       
    <tr>
        <td height="30" align="right"></td>
        <td width="105" align="right"><input name="INSERT" type="submit" id="INSERT" value="Search" /></td>
    </tr>
    
</table>
</form>