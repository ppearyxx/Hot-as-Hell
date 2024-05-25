<?php
$con=mysqli_connect("localhost","root","","hot_as_hell");
//Check connection
if (mysqli_connect_errno()) {
    echo "Failed to connect to MySQL: " . mysqli_connect_error();
}
?>

<form name="inpfrm" method="post" action="MethodSearch.php">
    <table width="500" height="10" border="0" align="left" cellpadding="0" cellspacing="0">
        <tr>
            <td height="30" align="right"></td>
            <td width="105" align="left"> Search For Payment Methods </td>
        </tr>
        <tr>
            <td height="30" align="right">Payment Method ID : </td>
            <td width="105" align="left"><input name="payment_method_id" type="text" id="payment_method_id" size="30" value="" maxlength="5" placeholder="PM000"> </td>
        </tr>
        <tr>
            <td height="30" align="right">Payment Method Name : </td>
            <td width="105" align="left"><input name="payment_method_name" type="text" id="payment_method_name" size="30" value="" placeholder="Enter Payment Method Name"> </td>
        </tr>
        <tr>
            <td height="30" align="right"></td>
            <td width="105" align="right"><input name="search" type="submit" id="search" value="Search" /></td>
        </tr>
    </table>
</form>
