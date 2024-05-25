<?php
$con=mysqli_connect("localhost","root","","hot_as_hell");
//Check connection
if (mysqli_connect_errno()) {
    echo "Failed to connect to MySQL: " . mysqli_connect_error();
}
?>

<form name="inpfrm" method="post" action="RoomInsert.php">
    <table width="500" height="10" border="0" align="left" cellpadding="0" cellspacing="0">
        <tr>
            <td height="30" align="right"></td>
            <td width="105" align="left"> Insert New Room </td>
        </tr>
        <tr>
            <td height="30" align="right">Room ID : </td>
            <td width="105" align="left"><input name="room_id" type="text" id="room_id" size="30" value="" maxlength="5" placeholder="R0000"> </td>
        </tr>
        <tr>
            <td height="30" align="right">Room Type : </td>
            <td width="105" align="left">
               <select name="room_type" id="room_type">
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
            <td width="105" align="right"><input name="INSERT" type="submit" id="INSERT" value="Insert" /></td>
        </tr>
    </table>
</form> 

<!-- Second form for the "Back" button -->
<form name="inpfrm" method="post" action="RoomSearch.php">
    <table border="0" class="table table-hover" style="margin: 0 auto;">
        <tr>
            <td align="center"><input name="reset" type="submit" id="Back" value="Back" /></td>
        </tr>
    </table>
</form>
