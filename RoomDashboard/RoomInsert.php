<?php
$con=mysqli_connect("localhost","root","","hot_as_hell");
// Check connection
if (mysqli_connect_errno()) {
    echo "Failed to connect to MySQL: " . mysqli_connect_error();
}

$error_message = ''; // Initialize error message variable

if(empty($_POST['room_id'])){
    $error_message = "Please Input data Room ID";
}elseif(empty($_POST['room_type'])){
    $error_message = "Please Input data Room Type";
}elseif(empty($_POST['employee_id'])){
    $error_message = "Please Input data Employee ID";
}
else {
    $room_id = mysqli_real_escape_string($con, $_POST['room_id']);
    $room_type = mysqli_real_escape_string($con, $_POST['room_type']);
    $employee_id = mysqli_real_escape_string($con, $_POST['employee_id']);
    $room_status = "Available"; // Set the default value for RoomStatus

    $sql="INSERT INTO room (RoomID, RoomType, EmployeeID, RoomStatus)
    VALUES ('$room_id', '$room_type', '$employee_id', '$room_status')";
    if (!mysqli_query($con,$sql)) {
        $error_message = "Error: " . mysqli_error($con);
    } else {
        echo "Success" ;
    }
}

mysqli_close($con);
?>

<div style="text-align: center;">
    
    <?php if (!empty($error_message)): ?>
        <div style="color: red;"><?php echo $error_message; ?></div>
    <?php else: ?>
        <form name="inpfrm" method="post" action="RoomDashboard.php">
        <table border="0" class="table table-hover" style="margin: 0 auto;">
            <tr>
                <td align="center"><input name="reset" type="submit" id="ViewRoom" value="View Inserted Room" /></td>
            </tr>
        </table>
    </form>
    <?php endif; ?>    

    <form name="inpfrm" method="post" action="RoomInsertForm.php">
        <table border="0" class="table table-hover" style="margin: 0 auto;">
            <tr>
                <td align="center"><input name="reset" type="submit" id="Back" value="Back" /></td>
            </tr>
        </table>
    </form>
</div>
