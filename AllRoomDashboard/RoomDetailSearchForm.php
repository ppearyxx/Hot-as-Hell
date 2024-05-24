<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Room Detail Search</title>
</head>
<body>
    <form name="inpfrm" method="post" action="RoomDetailSearch.php">
        <table width="500" height="10" border="0" align="left" cellpadding="0" cellspacing="0">
            <tr>
                <td height="30" align="right"></td>
                <td width="105" align="left"> Search For Room Types </td>
            </tr>
            <tr>
                <td height="30" align="right">Room Type: </td>
                <td width="105" align="left">
                    <input type="text" name="room_type" id="room_type" placeholder="Enter Room Type">
                </td>
            </tr>
            <tr>
                <td height="30" align="right">Room Detail: </td>
                <td width="105" align="left">
                    <input type="text" name="room_detail" id="room_detail" placeholder="Enter Room Detail">
                </td>
            </tr>
            <tr>
                <td height="30" align="right"></td>
                <td width="105" align="right"><input name="SEARCH" type="submit" id="SEARCH" value="Search" /></td>
            </tr>
        </table>
    </form>
</body>
</html>
