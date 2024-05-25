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
                <li><a href="TestPositionDashboard.php"><i class="fa-solid fa-briefcase" style="margin-right: 10px;"></i>Employee Position</a></li>
                <li class="highlight"><a href="TestRoomDashBoard.php"><i class="fa-solid fa-bed" style="margin-right: 10px;"></i>Room</a></li>
                <li><a href="TestRoomDetailDashBoard.php"><i class="fa-solid fa-hotel" style="margin-right: 10px;"></i>Room Detail</a></li>
                <li><a href="reservation.html"><i class="fa-solid fa-user" style="margin-right: 10px;"></i>Reservation</a></li>
                <li><a href="guest.html"><i class="fa-solid fa-book" style="margin-right: 10px;"></i>Guest Information</a></li>
                <li><a href="payment.html"><i class="fa-brands fa-paypal" style="margin-right: 10px;"></i>Payment</a></li>
                <li><a href="TestMethodDashboard.php"><i class="fa-brands fa-coins" style="margin-right: 10px;"></i>Payment Method</a></li>
                <li><a href="TestPromotionDashboard.php"><i class="fa-solid fa-desktop" style="margin-right: 10px;"></i>Promotion</a></li>
            </ul>
        </div>
        <div class="right">
            <div style="display: flex; justify-content: space-between; color: white;">
                <h1>Delete Room</h1>
            </div>
            <div style="margin-top: 20px; border-radius: 10px; background-color: white; padding: 20px; min-height: 500px; height: 100%;">

                <?php
                // Establish connection to MySQL database
                $con = mysqli_connect("localhost", "root", "", "hot_as_hell");

                // Check connection
                if (mysqli_connect_errno()) {
                    echo "Failed to connect to MySQL: " . mysqli_connect_error();
                }

                // Retrieve RoomID from URL parameter
                $roomID = isset($_GET['id']) ? $_GET['id'] : '';
                if (!$roomID) {
                    echo "Room ID not provided.";
                    exit;
                }

                // Fetch room details from the database based on RoomID
                $query = "SELECT * FROM room WHERE RoomID = '$roomID'";
                $result = mysqli_query($con, $query);

                // Check if room exists
                if (mysqli_num_rows($result) === 0) {
                    echo "Room not found.";
                    exit;
                }

                // Fetch room details
                $row = mysqli_fetch_assoc($result);
                $roomType = $row['RoomType'];
                $employeeID = $row['EmployeeID'];
                $roomStatus = $row['RoomStatus'];

                // Handle deletion confirmation
                if ($_SERVER["REQUEST_METHOD"] == "POST") {
                    if (isset($_POST['confirm_delete'])) {
                        // Execute delete query
                        $deleteQuery = "DELETE FROM room WHERE RoomID = '$roomID'";
                        if (mysqli_query($con, $deleteQuery)) {
                            echo "<div style='color: green; text-align: center;'>Room deleted successfully.</div>";
                            echo '<div style="text-align: center;"><a href="TestRoomSearch.php" class="btn btn-secondary-custom">Back</a></div>';
                            exit;
                        } else {
                            echo "Error deleting room: " . mysqli_error($con);
                            exit;
                        }
                    } elseif (isset($_POST['cancel_delete'])) {
                        // Redirect back to the room search page
                        header("Location: TestRoomSearch.php");
                        exit;
                    }
                }

                mysqli_close($con);
                ?>

                <div style="text-align: center;">
                    <form method="post">
                        <p>Are you sure you want to delete the following room?</p>
                        <p><strong>Room ID</strong>: <?php echo $roomID; ?></p>
                        <p><strong>Room Type</strong>: <?php echo $roomType; ?></p>
                        <p><strong>Employee ID</strong>: <?php echo $employeeID; ?></p>
                        <p><strong>Room Status</strong>: <?php echo $roomStatus; ?></p>
                        <input type="submit" name="confirm_delete" value="Confirm Delete" class="btn btn-custom">
                        <input type="submit" name="cancel_delete" value="Cancel" class="btn btn-secondary-custom">
                    </form>
                </div>

            </div>
        </div>
    </div>
</body>
</html>
