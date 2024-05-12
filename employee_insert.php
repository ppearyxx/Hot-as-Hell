<?php
$con = mysqli_connect("localhost", "root", "", "my_hotel");
//Check connection
if (mysqli_connect_errno()) {
    echo "Failed to connect to MySQL: " . mysqli_connect_error();
}

if(empty($_POST['EmployeeID'])){
    echo "Please Input Employee ID";
}elseif(empty($_POST['FirstName'])){
    echo "Please Input First Name";
}elseif(empty($_POST['LastName'])){
    echo "Please Input Last Name";
}elseif(empty($_POST['PositionID'])){
    echo "Please Input Position ID";
}elseif(empty($_POST['Contact'])){
    echo "Please Input Contact";
}elseif(empty($_POST['DOB'])){
    echo "Please Input Date of Birth";
}elseif(empty($_POST['Gender'])){
    echo "Please Select Gender";
}else{
    $EmployeeID = mysqli_real_escape_string($con, $_POST['EmployeeID']);
    $FirstName = mysqli_real_escape_string($con, $_POST['FirstName']);
    $LastName = mysqli_real_escape_string($con, $_POST['LastName']);
    $PositionID = mysqli_real_escape_string($con, $_POST['PositionID']);
    $Contact = mysqli_real_escape_string($con, $_POST['Contact']);
    $DOB = mysqli_real_escape_string($con, $_POST['DOB']);
    $Gender = mysqli_real_escape_string($con, $_POST['Gender']);

    $sql="INSERT INTO Employee (EmployeeID, FirstName, LastName, PositionID, Contact, DOB, Gender)
    VALUES ('$EmployeeID', '$FirstName', '$LastName', '$PositionID', '$Contact', '$DOB', '$Gender')";
    if (!mysqli_query($con,$sql)) {
        die('Error: ' . mysqli_error($con));
    }
    echo "Success";
}

mysqli_close($con);
?>
<form name="back_employee_i" method="post" action="employee_insertf.php">
<table border="0" align="center" class="table table-hover">
    <tr>
        <td width="105" align="right"><input name="reset" type="submit" id="Back" value="Back" /></td>
    </tr>
</table>
</form>
