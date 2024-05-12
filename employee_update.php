<?php
$con = mysqli_connect("localhost", "root", "", "my_hotel");

// Check connection
if (mysqli_connect_errno()) {
    echo "Failed to connect to MySQL: " . mysqli_connect_error();
}

if (empty($_POST['EmployeeID'])) {
    echo "Please input Employee ID";
} else {
    $EmployeeID = mysqli_real_escape_string($con, $_POST['EmployeeID']);

    // Check if the Employee ID exists in the table
    $check_query = "SELECT EmployeeID FROM Employee WHERE EmployeeID='$EmployeeID'";
    $check_result = mysqli_query($con, $check_query);
    if (mysqli_num_rows($check_result) == 0) {
        echo "Employee ID not found. Please input a valid Employee ID.";
    } else {
        // Construct the update query
        $sql = "UPDATE Employee SET ";
        $updates = [];

        if (!empty($_POST['FirstName'])) {
            $FirstName = mysqli_real_escape_string($con, $_POST['FirstName']);
            $updates[] = "FirstName='$FirstName'";
        }
        if (!empty($_POST['LastName'])) {
            $LastName = mysqli_real_escape_string($con, $_POST['LastName']);
            $updates[] = "LastName='$LastName'";
        }
        if (!empty($_POST['PositionID'])) {
            $PositionID = mysqli_real_escape_string($con, $_POST['PositionID']);
            $updates[] = "PositionID='$PositionID'";
        }
        if (!empty($_POST['Contact'])) {
            $Contact = mysqli_real_escape_string($con, $_POST['Contact']);
            $updates[] = "Contact='$Contact'";
        }
        if (!empty($_POST['DOB'])) {
            $DOB = mysqli_real_escape_string($con, $_POST['DOB']);
            $updates[] = "DOB='$DOB'";
        }
        if (!empty($_POST['Gender'])) {
            $Gender = mysqli_real_escape_string($con, $_POST['Gender']);
            $updates[] = "Gender='$Gender'";
        }

        $sql .= implode(", ", $updates) . " WHERE EmployeeID='$EmployeeID'";
        
        if (!mysqli_query($con, $sql)) {
            die('Error: ' . mysqli_error($con));
        }
        
        echo "Update successful";
    }
}

mysqli_close($con);

?>
<form name="back_employee_u" method="post" action="employee_updatef.php">
<table border="0" align="center" class="table table-hover">
    <tr>
        <td width="105" align="right"><input name="reset" type="submit" id="Back" value="Back" /></td>
    </tr>
</table>
</form>
