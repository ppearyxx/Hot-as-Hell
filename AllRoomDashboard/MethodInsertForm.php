<form name="inpfrm" method="post" action="MethodInsert.php">
    <table width="500" height="10" border="0" align="left" cellpadding="0" cellspacing="0">
        <tr>
            <td height="30" align="right"></td>
            <td width="105" align="left"> Insert New Payment Method </td>
        </tr>
        <tr>
            <td height="30" align="right">Payment Method ID : </td>
            <td width="105" align="left"><input name="payment_method_id" type="text" id="payment_method_id" size="30" value="" maxlength="5" placeholder="PM000"> </td>
        </tr>
        <tr>
            <td height="30" align="right">Payment Method Name : </td>
            <td width="105" align="left">
                <input name="payment_method_name" type="text" id="payment_method_name" size="30" value="" placeholder="Enter payment method name"> 
            </td>
        </tr>       
        <tr>
            <td height="30" align="right"></td>
            <td width="105" align="right"><input name="INSERT" type="submit" id="INSERT" value="Insert" /></td>
        </tr>
    </table>
</form> 

<!-- Second form for the "Back" button -->
<form name="inpfrm" method="post" action="MethodDashboard.php">
    <table border="0" class="table table-hover" style="margin: 0 auto;">
        <tr>
            <td align="center"><input name="reset" type="submit" id="Back" value="Back" /></td>
        </tr>
    </table>
</form>
