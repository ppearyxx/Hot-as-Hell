<?php
$con = mysqli_connect("localhost", "root", "", "hot_as_hell");
// Check connection
if (mysqli_connect_errno()) {
    echo "Failed to connect to MySQL: " . mysqli_connect_error();
}
?>

<!-- Form to insert new room details -->
<form name="inpfrm" method="post" action="RoomDetailInsert.php">
    <table width="500" height="10" border="0" align="left" cellpadding="0" cellspacing="0">
        <tr>
            <td height="30" align="right"></td>
            <td width="105" align="left"> Insert New Room </td>
        </tr>
        <tr>
            <td height="30" align="right">Room Type : </td>
            <td width="105" align="left">
                <input name="room_type" type="text" id="room_type" size="30" maxlength="50">
            </td>
        </tr>
        <tr>
            <td height="30" align="right">Room Detail : </td>
            <td width="105" align="left">
                <textarea name="room_detail" id="room_detail" rows="5" cols="30"></textarea>
            </td>
        </tr>
        <tr>
            <td height="30" align="right">Room Price : </td>
            <td width="105" align="left"><input name="room_price" type="text" id="room_price" size="30"> </td>
        </tr>          
        <tr>
            <td height="30" align="right"></td>
            <td width="105" align="right"><input name="INSERT" type="submit" id="INSERT" value="Insert" /></td>
        </tr>
    </table>
</form> 

<!-- Second form for the "Back" button -->
<form name="inpfrm" method="post" action="RoomDetailSearch.php">
    <table border="0" class="table table-hover" style="margin: 0 auto;">
        <tr>
            <td align="center"><input name="reset" type="submit" id="Back" value="Back" /></td>
        </tr>
    </table>
</form>
