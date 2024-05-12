<?php
$con=mysqli_connect("localhost","root","","my_hotel");
//Check connection
if (mysqli_connect_errno()) {
    echo "Failed to connect to MySQL: " . mysqli_connect_error();
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    if (empty($_POST['EmployeeID'])) {
        echo "Please Input Employee ID";
    } else {
        $EmployeeID = mysqli_real_escape_string($con, $_POST['EmployeeID']);

        // Constructing the DELETE query
        $sql = "DELETE FROM Employee WHERE EmployeeID='$EmployeeID'";
        
        if (!mysqli_query($con, $sql)) {
            die('Error: ' . mysqli_error($con));
        }

        echo "Success";
    }
} 

mysqli_close($con);

?>
<form name="back_employee_d" method="post" action="employee_deletef.php">
<table border="0" align="center" class="table table-hover">
    <tr>
        <td width="105" align="right"><input name="reset" type="submit" id="Back" value="Back" /></td>
    </tr>
</table>
</form>
