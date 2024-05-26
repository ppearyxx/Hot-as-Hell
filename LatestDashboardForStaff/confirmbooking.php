<?php

// Start session
session_start();

// Check if user is logged in
if (!isset($_SESSION["FirstName"])) {
    // Redirect to login page if user is not logged in
    header("Location: ../Login/login.html");
    exit;
}

// Retrieve username from session variable
$username = $_SESSION["FirstName"];
$guest_id = $_SESSION["GuestID"];

$roomID = $_GET['RoomID'];
$roomType = $_GET['RoomType'];
$roomPrice = $_GET['RoomPrice'];
$roomDetail = $_GET['RoomDetail'];

$_SESSION['selectedRoom'] = [
    'RoomID' => $roomID,
    'RoomType' => $roomType,
    'RoomPrice' => $roomPrice,
    'RoomDetail' => $roomDetail
];

switch ($roomType) {
    case 'STD':
        $roomType = 'Standard';
        break;
    case 'FAM':
        $roomType = 'Family Suite';
        break;
    case 'DLX':
        $roomType = 'Deluxe';
        break;
    case 'SUI':
        $roomType = 'Luxury Suite';
        break;

}


// Database connection
$con = mysqli_connect("localhost", "root", "", "hot_as_hell");

// Check connection
if (mysqli_connect_errno()) {
    echo "Failed to connect to MySQL: " . mysqli_connect_error();
}


?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8"/>
    <meta name="viewport" content="width=device-width, initial-scale=1.0"/>
    <title>Hot As Hell</title>

    <link rel="stylesheet" href="../Navbar.css">
    <link rel="stylesheet" href="../SignUp/signup.css">
    

    <link rel="shortcut icon" href="../images/logo.png" type="image/x-icon">

    <style>
        .user-button {
            display: flex;
            align-items: center;
            background-color: #171A33;
            width: 10vw;
            height: 5vh;
            border-radius: 0.5em;
            color: white;
            margin-left: 20vw;
            padding: 0vw;
            margin-top: 1vw;
        }

        .user-button img {
            width: 22px;
            height: 22px;
            margin-right: 1vw;
            margin-left: 1.5vw;
        }

        body {
            font-family: Arial, sans-serif;
            display: flex;
            justify-content: space-around;
            align-items: flex-start;
            margin: 5vw;
            padding: 0;
        }

        .booking-details {
            width: 40%;
            margin: 5vw;
            padding: 2vw;
            border: none;
            border-radius: 10px;
        }

        .payment-methods {
            width: 40%;
            margin: 5vw;
            padding: 2vw;
            border: none;
            border-radius: 10px;
        }

        .heading {
            font-size: 1.5em;
            font-weight: bold;
            margin-bottom: 1em;
        }

        .detail-item {
            margin-bottom: 1em;
        }

        .detail-item label {
            font-weight: bold;
        }

        .total-price label {
            font-weight: bold;
        }

        .total-price {
            margin-top: 1em;
            border-top: 1px solid #ccc;
            padding-top: 1em;
        }

        .payment-method {
            margin-bottom: 1em;
        }


    </style>
</head>
<body>

<!--Navbar of the website-->
<header>
    <nav>
        <ul>
            <li>Home</li>
            <li>About Us</li>
            <li>Rooms</li>
            <li>Contact Us</li>
        </ul>

        <img src="../images/logo.png" class="logo">

        <button class="user-button">
            <img src="../images/user.png" alt="User Icon">
            <?php echo $username; ?>
        </button>

    </nav>
</header>

<div>
<div style="display: flex;">
<div class="booking-details">
    <div class="heading">Booking Details</div>

    <div class="detail-item">
        <label>RoomID: </label>
        <?php echo $_SESSION['selectedRoom']['RoomID']; ?>
    </div>

    <div class="detail-item">
        <label>RoomType: </label>
        <?php echo $_SESSION['selectedRoom']['RoomType']; ?>
    </div>

    <div class="detail-item">
        <label>Check-in/out: </label>
        <?php echo $_SESSION['checkInDate'] . ' ' . $_SESSION['checkInTime'] . ' - ' . $_SESSION['checkOutDate'] . ' ' . $_SESSION['checkOutTime']; ?>
    </div>

    <div class="detail-item">
        <label>RoomPrice: </label>
        <?php echo $_SESSION['selectedRoom']['RoomPrice'] . ' THB'; ?>
    </div>

    <div class="total-price">
        <label>Total: </label>
        <?php
        // Compute total days
        $checkInDateTime = strtotime($_SESSION['checkInDate'] . ' ' . $_SESSION['checkInTime']);
        $checkOutDateTime = strtotime($_SESSION['checkOutDate'] . ' ' . $_SESSION['checkOutTime']);
        $totalDays = ceil(($checkOutDateTime - $checkInDateTime) / (60 * 60 * 24));

        // Compute total price
        $totalPrice = $totalDays * $_SESSION['selectedRoom']['RoomPrice'];
        echo $totalPrice . ' THB';
        $_SESSION['TotalPrice'] = $totalPrice;
        ?>
    </div>
</div>

<form id="paymentForm" action="bookingsuccess.php" method="post" style="margin: 5vw;">
    <div class="payment-methods">
        <div class="heading">Payment Methods</div>

        <div class="payment-method">
            <input type="radio" id="cash" name="payment" value="cash" required>
            <label for="cash">Cash</label>
        </div>

        <div class="payment-method">
            <input type="radio" id="bank-transfer" name="payment" required value="bank-transfer">
            <label for="bank-transfer">Bank Transfer</label>
        </div>
    </div>


</div>

<div style="display: flex;">
    <button style="width: 10vw; margin-right: 50vw;" >
        <a href="../Reservation/roomselect.php" style="text-decoration: none; color: white;">Back</a>
    </button>
    <button type="submit" style="width: 10vw;">Done</button>
</div>
</form>

</div>


</body>
</html>
