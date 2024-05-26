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
    <script>
        function deleteRow(button) {
            var row = button.parentNode.parentNode;
            row.parentNode.removeChild(row);
        }
    </script>
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
                <li><a href="employee.php"><i class="fa-solid fa-user" style="margin-right: 10px;"></i>Employee</a></li>
                <li class="highlight"><a href="TestPositionDashboard.php"><i class="fa-solid fa-briefcase" style="margin-right: 10px;"></i>Employee Position</a></li>
                <li><a href="TestRoomDashBoard.php"><i class="fa-solid fa-bed" style="margin-right: 10px;"></i>Room</a></li>
                <li><a href="TestRoomDetailDashBoard.php"><i class="fa-solid fa-hotel" style="margin-right: 10px;"></i>Room Detail</a></li>
                <li><a href="ReservationFB.php"><i class="fa-solid fa-user" style="margin-right: 10px;"></i>Reservation</a></li>
                <li><a href="GuestFB.php"><i class="fa-solid fa-book" style="margin-right: 10px;"></i>Guest Information</a></li>
                <li><a href="payment.php"><i class="fa-brands fa-paypal" style="margin-right: 10px;"></i>Payment</a></li>
                <li><a href="TestMethodDashboard.php"><i class="fa-solid fa-coins" style="margin-right: 10px;"></i>Payment Method</a></li>
                <li><a href="TestPromotionDashboard.php"><i class="fa-solid fa-desktop" style="margin-right: 10px;"></i>Promotion</a></li>
            </ul>
        </div>
        <div class="right">
            <div style="display: flex; justify-content: space-between; color: white;">
                <h1>Insert New Position</h1>
                <div>
                <form method="GET" action="TestPositionSearchForm2.php">
                        <p>Search</p>
                        <input type="text" name="search" id="search" style="background-color: white; border: 1px solid black; border-radius: 10px; padding: 5px; height: 30px;">
                        <button type="submit" style="background-color: #00868D; color: white; border: none; border-radius: 5px; padding: 5px 10px;">Search</button>
                    </form>
                </div>
            </div>
            <div style="margin-top: 20px; border-radius: 10px; background-color: white; padding: 20px; min-height: 500px; height: 100%;">
                <?php
                $con = mysqli_connect("localhost", "root", "", "hot_as_hell");
                if (mysqli_connect_errno()) {
                    echo "Failed to connect to MySQL: " . mysqli_connect_error();
                }

                $error_message = '';

                if ($_SERVER['REQUEST_METHOD'] == 'POST') {
                    if (empty($_POST['position_id'])) {
                        $error_message = "Please Input Position ID";
                    } elseif (empty($_POST['position_name'])) {
                        $error_message = "Please Input Position Name";
                    } elseif (empty($_POST['salary'])) {
                        $error_message = "Please Input Salary";
                    } else {
                        $position_id = mysqli_real_escape_string($con, $_POST['position_id']);
                        $position_name = mysqli_real_escape_string($con, $_POST['position_name']);
                        $salary = mysqli_real_escape_string($con, $_POST['salary']);

                        $sql = "INSERT INTO employee_position (PositionID, Position, Salary)
                                VALUES ('$position_id', '$position_name', '$salary')";
                        if (!mysqli_query($con, $sql)) {
                            $error_message = "Error: " . mysqli_error($con);
                        } else {
                            echo "<div style='color: green; text-align: center;'>Success</div>";
                        }
                    }
                }

                mysqli_close($con);
                ?>

                <div style="text-align: center;">
                    <?php if (!empty($error_message)): ?>
                        <div style="color: red;"><?php echo $error_message; ?></div>
                    <?php endif; ?>    

                    <form name="inpfrm" method="post" action="">
                        <div class="mb-3 row">
                            <label for="position_id" class="col-sm-2 col-form-label text-end">Position ID:</label>
                            <div class="col-sm-10">
                                <input type="text" class="form-control" id="position_id" name="position_id" value="<?php echo isset($_POST['position_id']) ? $_POST['position_id'] : ''; ?>">
                            </div>
                        </div>
                        <div class="mb-3 row">
                            <label for="position_name" class="col-sm-2 col-form-label text-end">Position Name:</label>
                            <div class="col-sm-10">
                                <input type="text" class="form-control" id="position_name" name="position_name" value="<?php echo isset($_POST['position_name']) ? $_POST['position_name'] : ''; ?>">
                            </div>
                        </div>
                        <div class="mb-3 row">
                            <label for="salary" class="col-sm-2 col-form-label text-end">Salary:</label>
                            <div class="col-sm-10">
                                <input type="text" class="form-control" id="salary" name="salary" value="<?php echo isset($_POST['salary']) ? $_POST['salary'] : ''; ?>">
                            </div>
                        </div>
                        <div class="row">
                            <div class="col text-end">
                                <button type="submit" class="btn-custom">Insert Position</button>
                                <a href="TestPositionDashboard.php" class="btn btn-secondary-custom">View Inserted Positions</a>
                                <a href="TestPositionDashboard.php" class="btn btn-secondary-custom">Back</a>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</body>
</html>
