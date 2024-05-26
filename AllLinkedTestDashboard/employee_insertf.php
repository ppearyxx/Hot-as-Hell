<?php include ('employee_insert.php'); ?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Hot As Hell</title>
    <script src='https://kit.fontawesome.com/a076d05399.js' crossorigin='anonymous'></script>
    <link rel="shortcut icon" href="/images/logo.png" type="image/x-icon">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.2/css/all.min.css"
        integrity="sha512-SnH5WK+bZxgPHs44uWIX+LLJAJ9/2PkPKZ5QiAj6Ta86w+fsb2TkcmfRyVX3pBnMFcV7oQPJkl9QevSCWr3W6A=="
        crossorigin="anonymous" referrerpolicy="no-referrer" />
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
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
                <li class="highlight"><a href="employee.php"><i class="fa-solid fa-user" style="margin-right: 10px;"></i>Employee</a></li>
                <li><a href="TestPositionDashboard.php"><i class="fa-solid fa-briefcase" style="margin-right: 10px;"></i>Employee Position</a></li>
                <li><a href="TestRoomDashBoard.php"><i class="fa-solid fa-bed" style="margin-right: 10px;"></i>Room</a></li>
                <li><a href="TestRoomDetailDashBoard.php"><i class="fa-solid fa-hotel" style="margin-right: 10px;"></i>Room Detail</a></li>
                <li><a href="reservation.php"><i class="fa-solid fa-user" style="margin-right: 10px;"></i>Reservation</a></li>
                <li><a href="guest.php"><i class="fa-solid fa-book" style="margin-right: 10px;"></i>Guest Information</a></li>
                <li><a href="payment.php"><i class="fa-brands fa-paypal" style="margin-right: 10px;"></i>Payment</a></li>
                <li><a href="TestMethodDashboard.php"><i class="fa-solid fa-coins" style="margin-right: 10px;"></i>Payment Method</a></li>                
                <li><a href="TestPromotionDashboard.php"><i class="fa-solid fa-desktop" style="margin-right: 10px;"></i>Promotion</a></li>
            </ul>
        </div>
        <div class="right">
            <div style="display: flex; justify-content: space-between; color: white;">
                <h1>Insert New Employee</h1>
                <div>
                    <p>Search</p>
                    <input type="text" name="search" id="search"
                        style="background-color: white; border: 1px solid black; border-radius: 10px; padding: 5px; height: 30px;">
                </div>
            </div>
            <div
                style="margin-top: 20px; border-radius: 10px; background-color: white; padding: 20px; min-height: 500px; height: 100%;">

                <div style="text-align: center; padding-top: 10px;">
                    <?php if (!empty($error_message)): ?>
                        <div style="color: red;"><?php echo $error_message; ?></div>
                    <?php elseif (!empty($success_message)): ?>
                        <div style="color: green;"><?php echo $success_message; ?></div>
                    <?php endif; ?>
                </div>

                <form name="inpfrm" method="post" action="">
                    <div class="mb-3 row">
                        <label for="employee_id" class="col-sm-2 col-form-label text-end">Employee ID:</label>
                        <div class="col-sm-10">
                            <input type="text" class="form-control" id="employee_id" name="employee_id" maxlength="12"
                                placeholder="E0000000000"
                                value="<?php echo isset($_POST['employee_id']) ? $_POST['employee_id'] : ''; ?>">
                        </div>
                    </div>
                    <div class="mb-3 row">
                        <label for="first_name" class="col-sm-2 col-form-label text-end">First Name:</label>
                        <div class="col-sm-10">
                            <input type="text" class="form-control" id="first_name" name="first_name"
                                placeholder="Enter first name"
                                value="<?php echo isset($_POST['first_name']) ? $_POST['first_name'] : ''; ?>">
                        </div>
                    </div>
                    <div class="mb-3 row">
                        <label for="last_name" class="col-sm-2 col-form-label text-end">Last Name:</label>
                        <div class="col-sm-10">
                            <input type="text" class="form-control" id="last_name" name="last_name"
                                placeholder="Enter last name"
                                value="<?php echo isset($_POST['last_name']) ? $_POST['last_name'] : ''; ?>">
                        </div>
                    </div>
                    <div class="mb-3 row">
                        <label for="position_id" class="col-sm-2 col-form-label text-end">Position ID:</label>
                        <div class="col-sm-10">
                            <input type="text" class="form-control" id="position_id" name="position_id"
                                placeholder="Enter position ID"
                                value="<?php echo isset($_POST['position_id']) ? $_POST['position_id'] : ''; ?>">
                        </div>
                    </div>
                    <div class="mb-3 row">
                        <label for="contact" class="col-sm-2 col-form-label text-end">Contact:</label>
                        <div class="col-sm-10">
                            <input type="text" class="form-control" id="contact" name="contact"
                                placeholder="Enter contact"
                                value="<?php echo isset($_POST['contact']) ? $_POST['contact'] : ''; ?>">
                        </div>
                    </div>
                    <div class="mb-3 row">
                        <label for="dob" class="col-sm-2 col-form-label text-end">Date of Birth:</label>
                        <div class="col-sm-10">
                            <input type="date" class="form-control" id="dob" name="dob"
                                value="<?php echo isset($_POST['dob']) ? $_POST['dob'] : ''; ?>">
                        </div>
                    </div>
                    <div class="mb-3 row">
                        <label for="gender" class="col-sm-2 col-form-label text-end">Gender:</label>
                        <div class="col-sm-10">
                            <select class="form-control" id="gender" name="gender">
                                <option value="" <?php echo (isset($_POST['gender']) && $_POST['gender'] == '') ? 'selected' : ''; ?>>Select Gender</option>
                                <option value="Male" <?php echo (isset($_POST['gender']) && $_POST['gender'] == 'M') ? 'selected' : ''; ?>>Male</option>
                                <option value="Female" <?php echo (isset($_POST['gender']) && $_POST['gender'] == 'F') ? 'selected' : ''; ?>>Female</option>
                            </select>
                        </div>
                    </div>
                    <div class="mb-3 row">
                        <label for="position_id" class="col-sm-2 col-form-label text-end">Room ID:</label>
                        <div class="col-sm-10">
                            <input type="text" class="form-control" id="room_id" name="room_id"
                                placeholder="Enter room ID"
                                value="<?php echo isset($_POST['room_id']) ? $_POST['room_id'] : ''; ?>">
                        </div>
                    </div>
                    <div class="row">
                        <div class="col text-end">
                            <button type="submit" class="btn-custom">Insert</button>
                            <a href="employee.php" class="btn btn-secondary-custom">View Employees</a>
                            <a href="employee.php" class="btn btn-secondary-custom">Back</a>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</body>

</html>