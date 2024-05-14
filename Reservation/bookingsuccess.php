<?php
// Start session
session_start();

// Database connection
$con = mysqli_connect("localhost", "root", "", "hot_as_hell");

// Check if user is logged in
if (!isset($_SESSION["FirstName"])) {
    // Redirect to login page if user is not logged in
    header("Location: ../Login/login.html");
    exit;
}


// Check if payment method is submitted
if (isset($_POST['payment'])) {

    // Check connection
    if (mysqli_connect_errno()) {
        echo "Failed to connect to MySQL: " . mysqli_connect_error();
    }

    // Escape and sanitize payment method
    $payment = mysqli_real_escape_string($con, $_POST['payment']);

    // Perform further validation if needed

    // Store payment method in session variable for later use
    $_SESSION['payment'] = $payment;
}

// Retrieve username from session variable
$username = $_SESSION["FirstName"];
$guest_id = $_SESSION["GuestID"];

$checkInDate = $_SESSION['checkInDate'];
$checkOutDate = $_SESSION['checkOutDate'];
$checkInTime = $_SESSION['checkInTime'];
$checkOutTime = $_SESSION['checkOutTime'];

$bookingno = $_SESSION['BookingNo'];
$totalPrice = $_SESSION['TotalPrice'];


// Define room details variables
$roomID = isset($_SESSION['selectedRoom']['RoomID']) ? $_SESSION['selectedRoom']['RoomID'] : '';
$roomType = isset($_SESSION['selectedRoom']['RoomType']) ? $_SESSION['selectedRoom']['RoomType'] : '';
$roomPrice = isset($_SESSION['selectedRoom']['RoomPrice']) ? $_SESSION['selectedRoom']['RoomPrice'] : '';
$roomDetail = isset($_SESSION['selectedRoom']['RoomDetail']) ? $_SESSION['selectedRoom']['RoomDetail'] : '';

// Check connection
if (mysqli_connect_errno()) {
    echo "Failed to connect to MySQL: " . mysqli_connect_error();
}

// Insert booking details into the reservation table
$insertSql = "INSERT INTO reservation (BookingNo, RoomID, CheckInDate, CheckInTime, CheckOutDate, CheckOutTime)
              VALUES ('$bookingno', '$roomID', '$checkInDate', '$checkInTime', '$checkOutDate', '$checkOutTime')";

// Retrieve the inserted reservation details
$reservationDetailsSql = "SELECT * FROM reservation WHERE BookingNo = '$bookingno'";
$reservationDetailsResult = mysqli_query($con, $reservationDetailsSql);

// Check if reservation details are retrieved
if ($reservationDetailsResult) {
    // Fetch reservation details
    $reservationDetails = mysqli_fetch_assoc($reservationDetailsResult);

    // Check if reservation details are fetched
    if (!$reservationDetails) {
        echo "No reservation details found.";
    }
} else {
    echo "Error retrieving reservation details: " . mysqli_error($con);
}

if (mysqli_query($con, $insertSql)) {
    // Booking successful, update room status to Not Available
    $updateSql = "UPDATE room SET RoomStatus = 'Not Available' WHERE RoomID = '$roomID'";
    if (mysqli_query($con, $updateSql)) {
        // Commit transaction
        mysqli_commit($con);
    } else {
        // Rollback transaction if room status update fails
        mysqli_rollback($con);
        echo "Error updating room status: " . mysqli_error($con);
    }
} else {
    // If insertion fails, display error message
    echo "Error: " . mysqli_error($con);
}

// Retrieve guest information from the database
$sql = "SELECT GuestID, FirstName, LastName, Email FROM guest WHERE GuestID = '$guest_id'";
$result = mysqli_query($con, $sql);

// Check if the query was successful
if ($result && mysqli_num_rows($result) > 0) {
    // Fetch guest information
    $guest_info = mysqli_fetch_assoc($result);

    // Store guest information in session variables for later use
    $_SESSION['GuestInfo'] = $guest_info;
} else {
    echo "Error: Unable to retrieve guest information";
}

// Close connection
mysqli_close($con);
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

        .success{
            align-items: center;
            justify-content: center;
            text-align: center;
            margin-top: 10vh;
        }

        .heading{
            font-size: 3rem;
        }

         /* Modal box styling */
         .modal {
            display: none; /* Hidden by default */
            position: fixed; /* Stay in place */
            z-index: 1; /* Sit on top */
            left: 0;
            top: 0;
            width: 100%; /* Full width */
            height: 100%; /* Full height */
            overflow: auto; /* Enable scroll if needed */
            background-color: rgb(0,0,0); /* Fallback color */
            background-color: rgba(0,0,0,0.4); /* Black w/ opacity */
            padding-top: 60px;
        }

        /* Modal content */
        .modal-content {
            background-color: #171A33;
            border-radius: 0.8em;
            margin: 5% auto; /* 5% from the top and centered */
            padding: 20px;
            border: 1px solid #888;
            width: 80%; /* Could be more or less, depending on screen size */
        }

        /* Close button */
        .close {
            color: #aaa;
            float: right;
            font-size: 28px;
            font-weight: bold;
        }

        .close:hover,
        .close:focus {
            color: #720202;
            text-decoration: none;
            cursor: pointer;
        }

        /* Invoice styling */
        .invoice {
            font-family: Arial, sans-serif;
            text-align: left;
        }

        .invoice-logo {
            margin-bottom: 20px;
        }

        .invoice-details {
            margin-bottom: 20px;
        }

        .invoice-details p {
            margin: 5px 0;
        }

        .invoice-table {
            width: 100%;
            border-collapse: collapse;
        }

        .invoice-table th,
        .invoice-table td {
            border: 1px solid #ddd;
            padding: 8px;
            text-align: left;
        }

        .invoice-table th {
            background-color: #720202;
        }

        .invoice-total {
            margin-top: 20px;
            text-align: right;
        }

        /* Footer */
        .footer {
            margin-top: 20px;
            text-align: center;
        }

        /* Save as PDF button */
        .save-pdf {
            padding: 1vw;
            width: 30vw;
            background-color: #4CAF50;
            color: white;
            border: none;
            border-radius: 4px;
            cursor: pointer;
        }

        .save-pdf:hover {
            background-color: #45a049;
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

<br><br><br><br>
<div class="success">
    <h1 class="heading">Payment Success</h1>
    <img src="../images/check.png" style="width: 7vw;">
    <h1>Thank You</h1>
    <button style="width: 10vw;" >
        <a href="../Reservation/reservation.php" style="text-decoration: none; color: white;">Back</a>
    </button>
    <button id="myBtn" style="width: 20vw;">Payment Invoice</button>

    <!-- The Modal -->
<div id="myModal" class="modal">
    <!-- Modal content -->
    <div class="modal-content">
        <span class="close">&times;</span>
        <div class="invoice">
            <div style="display: flex;">
                <div class="invoice-logo" style="margin-right: 20vw;">
                    <!-- Company logo -->
                    <img src="../images/logo.png" class="logo">
                </div>
                <div class="invoice-details">
                    <!-- Company location details -->
                    <p>Bangkok, Thailand</p>
                    <p>hotashell@gmail.com</p>
                    <p>02-215-2334</p>
                </div>
            </div>

            <div style="display: flex;">
                <div>
                    <!-- User details -->
                    <p><b>GuestID: </b><?php echo ' ' . $guest_info['GuestID']; ?></p>
                    <p><b>GuestName: </b><?php echo ' ' . $guest_info['FirstName'] . '  ' . $guest_info['LastName']; ?></p>
                    <p><b>GuestEmail: </b><?php echo ' ' . $guest_info['Email']; ?></p>
                </div>

                <div style="margin-left: 40vw;">
                     <!-- Room details -->
                    <p><b>RoomID: </b><?php echo ' ' . $roomID; ?></p>
                    <p><b>RoomType: </b><?php echo  ' ' . $roomType?></p>
                    <p><b>RoomPrice: </b><?php echo ' ' . $roomPrice; ?></p>

                </div>
            </div>

            <!-- Reservation details table -->
            <table class="invoice-table">
                <tr>
                    <th>Reservation ID</th>
                    <th>Booking No</th>
                    <th>Check-In Date</th>
                    <th>Check-In Time</th>
                    <th>Check-Out Date</th>
                    <th>Check-Out Time</th>
                </tr>
                <!-- Display the retrieved reservation details -->
                <tr>
                    <td><?php echo $reservationDetails['ReservationID']; ?></td>
                    <td><?php echo $reservationDetails['BookingNo']; ?></td>
                    <td><?php echo $reservationDetails['CheckInDate']; ?></td>
                    <td><?php echo $reservationDetails['CheckInTime']; ?></td>
                    <td><?php echo $reservationDetails['CheckOutDate']; ?></td>
                    <td><?php echo $reservationDetails['CheckOutTime']; ?></td>
                </tr>
            </table>


            <!-- Total amount and payment method -->
            <div class="invoice-total">
                <p><b>Total Amount: </b><?php echo '  ' . $totalPrice . ' THB'; ?></p>
                <p><b>Payment Method: </b> <?php echo '  ' . $payment?></p>
            </div>
            <!-- Footer -->
            <div class="footer" style="display: flex;">
                <p style="margin-right: 15vw;">Copyright &copy; 2024</p>
                <!-- Save as PDF button -->
                <button class="save-pdf" id="acknowledged">Acknowledged</button>
            </div>
        </div>
    </div>
</div>

</div>

<script>
    // Get the modal
    var modal = document.getElementById("myModal");

    // Get the button that opens the modal
    var btn = document.getElementById("myBtn");

     // Get the button that closes the modal
     var acknowledged = document.getElementById("acknowledged");

    // Get the <span> element that closes the modal
    var span = document.getElementsByClassName("close")[0];

    // When the user clicks the button, open the modal
    btn.onclick = function() {
        modal.style.display = "block";
    }

    // When the user clicks on <span> (x), close the modal
    span.onclick = function() {
        modal.style.display = "none";
    }

    // When the user clicks on acknowledged button, close the modal
    acknowledged.onclick = function() {
        modal.style.display = "none";
    }


    // When the user clicks anywhere outside of the modal, close it
    window.onclick = function(event) {
        if (event.target == modal) {
            modal.style.display = "none";
        }
    }

</script>

</body>
</html>
