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

// Database connection
$con = mysqli_connect("localhost", "root", "", "hot_as_hell");

// Check connection
if (mysqli_connect_errno()) {
    echo "Failed to connect to MySQL: " . mysqli_connect_error();
}

// Check if the form is submitted
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Retrieve form data
    $checkInDate = $_POST['checkindate'];
    $checkInTime = $_POST['checkintime'];
    $checkOutDate = $_POST['checkoutdate'];
    $checkOutTime = $_POST['checkouttime'];
    $adults = $_POST['adult'];
    $children = $_POST['children'];
    $specialRequests = $_POST['specialrequests'];
}

 // Store check-in and check-out date/time values in session variables
 $_SESSION['checkInDate'] = $checkInDate;
 $_SESSION['checkOutDate'] = $checkOutDate;
 $_SESSION['checkInTime'] = $checkInTime;
 $_SESSION['checkOutTime'] = $checkOutTime;

$bookingno = 'B' .  rand(0, 999) . rand(0, 999) . rand(0, 999);
$bookingDate = date("Y-m-d");
$bookingTime = date("H:i:s");
$payment_id = "0";

$_SESSION['BookingNo'] = $bookingno;


$insertsql="INSERT INTO booking_details (BookingNo, BookingDate, BookingTime, GuestID, PaymentID, AdultCount, ChildrenCount, SpecialRequests)
VALUES ('$bookingno', '$bookingDate', '$bookingTime', '$guest_id', '$payment_id', '$adults', '$children', '$specialRequests')";
if (!mysqli_query($con,$insertsql)) {
    die('Error: ' . mysqli_error($con));
}

// Retrieve all available rooms with their details from the database
$sql = "SELECT r.RoomID, r.RoomType, r.RoomStatus, rd.RoomPrice, rd.RoomDetail 
        FROM room r 
        INNER JOIN room_details rd ON r.RoomType = rd.RoomType 
        WHERE r.RoomStatus = 'Available'";
$result = mysqli_query($con, $sql);

// Initialize an array to store available rooms data
$availableRoomsData = [];

// Check if any rooms are available
if (mysqli_num_rows($result) > 0) {
    // Fetch available rooms data
    while ($row = mysqli_fetch_assoc($result)) {
        $availableRoomsData[] = $row;
    }
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

          /* Styling for the table */
          #availableRoomsTable table {
            width: 80%;
            border-collapse: collapse;
            border: 2px solid #fff; /* Set border color */
        }

        #availableRoomsTable th {
            background-color: #720202; /* Header background color */
            color: white;
            padding: 12px; /* Larger padding for header */
        }

        #availableRoomsTable th,
        #availableRoomsTable td {
            padding: 8px; /* Padding for cells */
            text-align: center;
            border: 1px solid #fff; /* Set border color */
        }

        .roomsList{
            box-shadow: 0 0 10px rgba(255, 255, 255, 0.5);
            width: 75vw;
            height: 25vh;
            text-align: center;
            color: white;
            border-radius: 0.8em;
            margin: 2vw auto; /* Center the rooms list */
            display: flex;
            align-items: center; /* Align items vertically */
        }

        .roomsList:hover{
            box-shadow: 0 0 20px rgba(255, 255, 255, 0.5);
            transform: translateX(2vw);
            transition: 1s all ease-in-out;
        }

        .roomimage{
            width: 20vw;
            height: 25vh;
            border-radius: 0.8em;
            float: left;
            border-top-right-radius: 0%;
            border-bottom-right-radius: 0%;
        }

        .roomdetail{
            text-align:left;
            margin-left: 2vw;
            flex-grow: 1; /* Allow room details to expand */
        }

        .reservebtn{
            padding: 0%;
            width: 8vw;
            height: 7vh;
            cursor: pointer;
            margin-left: auto; /* Align button to the right */
            margin-right: 2vw; /* Add space between button and room details */
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

<div style="display: flex; margin-top: 5vh; margin-bottom:5vh;">
    <button style="width: 20vw; margin-right:60vw; margin-left: 3vw;" onclick="showAvailableRooms()">Show All Available Rooms</button>
    <button style="width: 10vw;" >
        <a href="../Reservation/reservation.php" style="text-decoration: none; color: white;">Back</a>
    </button>
</div>

<div id="availableRoomsList" style="display: none;">
    <?php
    // Display available rooms data in div format
    foreach ($availableRoomsData as $room) {
        $roomType = '';
        $imageSrc = '';
        switch ($room['RoomType']) {
            case 'STD':
                $roomType = 'Standard';
                $imageSrc = '../images/standard.jpg';
                break;
            case 'FAM':
                $roomType = 'Family Suite';
                $imageSrc = '../images/family.jpg';
                break;
            case 'DLX':
                $roomType = 'Deluxe';
                $imageSrc = '../images/deluxe.jpg';
                break;
            case 'SUI':
                $roomType = 'Luxury Suite';
                $imageSrc = '../images/luxury.jpg';
                break;

        }
       
        echo "<div class='roomsList'>";
        echo "<img src='$imageSrc' class='roomimage'>";
        echo "<div class='roomdetail'>";
        echo "<p><b style='margin-right: 0.5vw;'>RoomID:</b> " . $room['RoomID'] . "</p>";
        echo "<p><b style='margin-right: 0.5vw;'>RoomType:</b> $roomType</p>";
        echo "<p><b style='margin-right: 0.5vw;'>RoomPrice:</b> THB " . $room['RoomPrice'] . "</p>";
        echo "<p><b style='margin-right: 0.5vw;'>RoomDetail:</b> " . $room['RoomDetail'] . "</p>";
        echo "</div>";
        echo "<button class='reservebtn'><a href='../Reservation/confirmbooking.php?RoomID=" . $room['RoomID'] . "&RoomType=" . $room['RoomType'] . "&RoomPrice=" . $room['RoomPrice'] . "&RoomDetail=" . $room['RoomDetail'] . "' style='text-decoration: none; color: white;'>Reserve</a></button>";
        echo "</div>";
    }
    ?>
</div>


<script>
    function showAvailableRooms() {
        document.getElementById("availableRoomsList").style.display = "block";
    }
    
</script>

</body>
</html>
