<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Hot As Hell</title>
    <script src='https://kit.fontawesome.com/a076d05399.js' crossorigin='anonymous'></script>
    <link rel="shortcut icon" href="/images/logo.png" type="image/x-icon">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.2/css/all.min.css" integrity="sha512-SnH5WK+bZxgPHs44uWIX+LLJAJ9/2PkPKZ5QiAj6Ta86w+fsb2TkcmfRyVX3pBnMFcV7oQPJkl9QevSCWr3W6A==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <link rel="stylesheet" href="style.css">
    <style>
        .btn-custom {
            color: white;
            background-color: #00868D;
            border: none;
            border-radius: 10px;
            padding: 10px;
        }
        .btn-secondary-custom {
            background-color: grey;
            border: none;
            border-radius: 10px;
            padding: 10px;
            color: white;
        }
    </style>
</head>
<body>
    <nav>
        <img src="images/logo.png" alt="" id="logo" style="width: 80px; height: 80px;">
        <div style="display: flex;">
            <img src="images/boy.png" alt="" id="person" style="width: 80px; height: 80px;">
            <p id="name">E0001234</p>
        </div>
    </nav>
    <div class="main">
        <div class="left">
            <ul>
                <li><a href="index.html"><i class="fa-solid fa-user" style="margin-right: 10px;"></i>Employee</a></li>
                <li class="highlight"><a href="TestPositionDashboard.php"><i class="fa-solid fa-briefcase" style="margin-right: 10px;"></i>Employee Position</a></li>
                <li><a href="TestRoomDashBoard.php"><i class="fa-solid fa-bed" style="margin-right: 10px;"></i>Room</a></li>
                <li><a href="TestRoomDetailDashBoard.php"><i class="fa-solid fa-hotel" style="margin-right: 10px;"></i>Room Detail</a></li>
                <li><a href="reservation.html"><i class="fa-solid fa-user" style="margin-right: 10px;"></i>Reservation</a></li>
                <li><a href="guest.html"><i class="fa-solid fa-book" style="margin-right: 10px;"></i>Guest Information</a></li>
                <li><a href="payment.html"><i class="fa-brands fa-paypal" style="margin-right: 10px;"></i>Payment</a></li>
                <li><a href="TestMethodDashboard.php"><i class="fa-solid fa-coins" style="margin-right: 10px;"></i>Payment Method</a></li>
                <li><a href="TestPromotionDashboard.php"><i class="fa-solid fa-desktop" style="margin-right: 10px;"></i>Promotion</a></li>
            </ul>
        </div>
        <div class="right">
            <div style="display: flex; justify-content: space-between; color: white;">
                <h1>Update Position Details</h1>
            </div>
            <div style="margin-top: 20px; border-radius: 10px; background-color: white; padding: 20px; min-height: 500px; height: 100%;">

                <?php
                // Establishing connection to MySQL database
                $con = mysqli_connect("localhost", "root", "", "hot_as_hell");
                // Check connection
                if (mysqli_connect_errno()) {
                    echo "Failed to connect to MySQL: " . mysqli_connect_error();
                }

                // Retrieve PositionID from URL parameter
                $positionID = isset($_GET['id']) ? $_GET['id'] : '';
                if (!$positionID) {
                    echo "Position ID not provided.";
                    exit;
                }

                // Fetch position details from the database based on PositionID
                $query = "SELECT * FROM employee_position WHERE PositionID = '$positionID'";
                $result = mysqli_query($con, $query);

                // Check if position exists
                if (mysqli_num_rows($result) === 0) {
                    echo "Position not found.";
                    exit;
                }

                // Fetch position details
                $row = mysqli_fetch_assoc($result);
                $positionName = $row['Position'];
                $salary = $row['Salary'];

                // Handle form submission for updating position details
                if ($_SERVER["REQUEST_METHOD"] == "POST") {
                    // Retrieve updated details from form fields
                    $updatedPositionName = mysqli_real_escape_string($con, $_POST['position_name']);
                    $updatedSalary = mysqli_real_escape_string($con, $_POST['salary']);

                    // Update position details in the database
                    $updateQuery = "UPDATE employee_position SET Position = '$updatedPositionName', Salary = '$updatedSalary' WHERE PositionID = '$positionID'";
                    if (mysqli_query($con, $updateQuery)) {
                        echo "<div style='color: green; text-align: center;'>Position details updated successfully.</div>";
                    } else {
                        echo "Error updating position details: " . mysqli_error($con);
                    }
                }

                mysqli_close($con);
                ?>

                <?php if ($positionID): ?>
                <form method="post">
                    <div class="mb-3 row">
                        <label for="position_name" class="col-sm-2 col-form-label text-end">Position Name:</label>
                        <div class="col-sm-10">
                            <input type="text" class="form-control" id="position_name" name="position_name" value="<?php echo $positionName; ?>">
                        </div>
                    </div>
                    <div class="mb-3 row">
                        <label for="salary" class="col-sm-2 col-form-label text-end">Salary:</label>
                        <div class="col-sm-10">
                            <input type="text" class="form-control" id="salary" name="salary" value="<?php echo $salary; ?>">
                        </div>
                    </div>
                    <div class="row">
                        <div class="col text-end">
                            <button type="submit" class="btn-custom">Update</button>
                            <a href="TestPositionDashboard.php" class="btn btn-secondary-custom">Back</a>
                        </div>
                    </div>
                </form>
                <?php endif; ?>

            </div>
        </div>
    </div>
</body>
</html>
