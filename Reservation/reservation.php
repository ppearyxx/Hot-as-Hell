<?php

// Start session
session_start();

$con = mysqli_connect("localhost", "root", "", "hot_as_hell");

// Check if user is logged in
if (!isset($_SESSION["FirstName"])) {
    // Redirect to login page if user is not logged in
    header("Location: ../Login/login.html");
    exit;
}

// Retrieve username from session variable
$username = $_SESSION["FirstName"];
$guest_id = $_SESSION["GuestID"];

// Query to fetch reservation details based on guest ID
$sql = "SELECT 
r.ReservationID,
r.BookingNo,
r.RoomID,
r.CheckInDate,
r.CheckInTime,
r.CheckOutDate,
r.CheckOutTime,
bd.PaymentID,
bd.SpecialRequests
FROM 
reservation r
JOIN 
booking_details bd ON r.BookingNo = bd.BookingNo
WHERE 
bd.GuestID = '$guest_id';
";
$result = mysqli_query($con, $sql);

$reservationDetails = array();

// Fetch reservation details into an array
while ($row = mysqli_fetch_assoc($result)) {
    $reservationDetails[] = $row;
}

// Check if the form is submitted for updating the room status
if (isset($_POST["roomID"])) {
  // Get the roomID from the POST data
  $roomID = $_POST["roomID"];

  date_default_timezone_set('Asia/Bangkok');
  $currentTime = date('H:i:s'); // Format: YYYY-MM-DD HH:MM:SS
  echo $currentTime;
  // Perform the database update to change the room status
  $updateRoomStatusQuery = "UPDATE room SET RoomStatus = 'Not Available' WHERE RoomID = '$roomID'";
   
  // Perform the database update to change the checkin time
  $updateCheckInQuery = "UPDATE reservation SET CheckInTime = '$currentTime' WHERE RoomID = '$roomID'";
  mysqli_query($con, $updateRoomStatusQuery);
  mysqli_query($con, $updateCheckInQuery);

  // Redirect back to the page or send a response message
  header("Location: ".$_SERVER['PHP_SELF']); // Redirect to the same page after update
  exit();
}

// Check if the form is submitted for updating the room status
if (isset($_POST["room"])) {
  // Get the roomID from the POST data
  $roomID = $_POST["room"];

  date_default_timezone_set('Asia/Bangkok');
  $currentDate = date('Y-m-d');
  $currentTime = date('H:i:s'); // Format: YYYY-MM-DD HH:MM:SS
  echo $currentTime;
  
  // Perform the database update to change the room status
  $updateRoomStatusQuery = "UPDATE room SET RoomStatus = 'Available' WHERE RoomID = '$roomID'";
   
  // Perform the database update to change the checkout time and date
  $updateCheckOutQuery = "UPDATE reservation SET CheckOutTime = '$currentTime', CheckOutDate = '$currentDate' WHERE RoomID = '$roomID'";
  
  mysqli_query($con, $updateRoomStatusQuery);
  mysqli_query($con, $updateCheckOutQuery);

  // Redirect back to the page or send a response message
  header("Location: ".$_SERVER['PHP_SELF']); // Redirect to the same page after update
  exit();
}



// Close database connection
mysqli_close($con);
?>

<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Hot As Hell</title>

    <link rel="stylesheet" href="../Navbar.css">
    <link rel="stylesheet" href="../SignUp/signup.css">
    <link rel="stylesheet" href="reservation.css">

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

    div.gallery {
  border: 1px solid #ccc;
  position: relative;

}

div.gallery:hover {
  border: 0.3vw solid #D6961B;
}

div.gallery img {
  width: 100%;
  height: auto;
}

div.desc {
  padding: 15px;
  text-align: center;
}

* {
  box-sizing: border-box;
}

.responsive {
  padding: 0 6px;
  float: left;
  width: 24.99999%;
}

@media only screen and (max-width: 700px) {
  .responsive {
    width: 49.99999%;
    margin: 6px 0;
  }
}

@media only screen and (max-width: 500px) {
  .responsive {
    width: 100%;
  }
}

.clearfix:after {
  content: "";
  display: table;
  clear: both;
}

.overlay {
  position: absolute;
  bottom: 0;
  left: 0;
  right: 0;
  background-color: #D6961B;
  overflow: hidden;
  width: 100%;
  height: 0;
  transition: 1s ease;
}

.gallery:hover .overlay {
  height: 80%;
}

.details {
  color: white;
  font-size: 20px;
  position: absolute;
  top: 50%;
  left: 50%;
  -webkit-transform: translate(-50%, -50%);
  -ms-transform: translate(-50%, -50%);
  transform: translate(-50%, -50%);
  text-align: center;
}

#roomType {
      width: 200px;
      padding: 10px;
      font-size: 16px;
      border: 1px solid #ccc;
      border-radius: 5px;
      background-color: lightgrey;
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
  background-color: rgba(0, 0, 0, 0.4); /* Black w/ opacity */
  padding-top: 60px;
}

/* Modal content */
.modal-content {
  background-color: #171A33; /* Background color of the modal */
  color: white; /* Text color */
  border-radius: 10px;
  box-shadow: 0 4px 8px 0 rgba(0, 0, 0, 0.2);
  width: 80%; /* Could be more or less, depending on screen size */
  margin: 5% auto; /* 5% from the top and centered */
  padding: 20px;
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

/* Add some margin to the bottom of the modal */
.modal-content {
  margin-bottom: 20px;
}

/* Table styling */
.modal-content table {
  width: 100%;
  border-collapse: collapse;
}

.modal-content th, .modal-content td {
  border: 1px solid #720202; /* Table border color */
  padding: 8px;
  text-align: left;
}

/* Header column background color */
.modal-content th {
  background-color: #720202;
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

    <!-- Add a modal for displaying reservation details -->
<div id="myModal" class="modal">
  <div class="modal-content">
    <span class="close">&times;</span>
    <div id="reservationDetails">
      <!-- Reservation details will be displayed here -->
    </div>
  </div>
</div>

    <!--Room Display Section-->
    <br><br><br><br>
    <h2>Types of rooms we offer</h2>
    <div style="margin-left:0.5vw;">
      <div class="responsive">
        <div class="gallery" >
          <a href="Rooms.html">
            <img src="../images/standard.jpg" style="max-height: 180px;" alt="Standard" width="600" height="400">
          </a>
          <div class="desc">Standard room with city view and basic amenities</div>

          <div class="overlay">
            <div class="details">
              <!-- Room details here -->
              <p>Price: THB 900</p>
              <p>Beds: Queen-size</p>
              <p>Amenities: Wifi, Television, City View</p>
            </div>
          </div>

        </div>
      </div>


      <div class="responsive">
        <div class="gallery">
          <a href="Rooms.html">
            <img src="../images/family.jpg" alt="Family Suite" width="600" height="400">
          </a>
          <div class="desc">Family suite with multiple bedrooms </div>

          <div class="overlay">
            <div class="details">
              <!-- Room details here -->
              <p>Price: THB 1500</p>
              <p>Beds: Double Beds</p>
              <p>Amenities: Television, Pool, City View</p>
            </div>
          </div>

        </div>
      </div>

      <div class="responsive">
        <div class="gallery">
          <a href="Rooms.html">
            <img src="../images/deluxe.jpg" style="height: 180px;" alt="Deluxe" width="600" height="400">
          </a>
          <div class="desc">Deluxe room with river view and balcony</div>

          <div class="overlay">
            <div class="details">
              <!-- Room details here -->
              <p>Price: THB 2800</p>
              <p>Beds: King-size</p>
              <p>Amenities: Pool, City View</p>
            </div>
          </div>

        </div>
      </div>

      <div class="responsive">
        <div class="gallery">
          <a href="Rooms.html">
            <img src="../images/luxury.jpg" style="height: 180px;" alt="Luxury" width="600" height="400">
          </a>
          <div class="desc">Luxury suite with private pool and panoramic city</div>

          <div class="overlay">
            <div class="details">
              <!-- Room details here -->
              <p>Price: THB 4800</p>
              <p>Beds: King-size</p>
              <p>Amenities: Pool, City View</p>
            </div>
          </div>
          

        </div>
      </div>

      <div class="clearfix"></div>
    </div>


    <form class="register-form" action="roomselect.php" method="post" style="margin-left:2vw;">
    <div class="form-group">

      <p id="timeError" style="color: red; display: none"></p>

      <div style="display:flex;">
        <div class="date-time-group">
            <label for="checkindate" style="margin-right: 1vw;">Check-in Date:</label>
            <input type="date" id="checkindate" name="checkindate" min="<?php echo date('Y-m-d'); ?>" required>
            <input type="time" id="checkintime" name="checkintime" onchange="validTimeJS()" required>
        </div>

        <div class="date-time-group">
            <label for="checkoutdate" style="margin-right: 1vw;">Check-out Date:</label>
            <input type="date" id="checkoutdate" name="checkoutdate" min="<?php echo date('Y-m-d', strtotime('+1 day')); ?>" required>
            <input type="time" id="checkouttime" name="checkouttime" onchange="validTimeJS()"  required>
        </div>
      </div>

    </div>

    <div style="display:flex;">

      <div class="form-group">
          <label for="adult" style="margin-right: 1vw;">Number of Adults:</label>
          <input type="number" id="adult" style="width: 5vw; margin-right: 3vw;" name="adult" min="1" required>
      </div>

      <div class="form-group">
          <label for="children" style="margin-right: 1vw;">Number of Children:</label>
          <input type="number" id="children" style="width: 5vw;" name="children" min="0" required>
      </div>

      <div class="form-group">
          <label for="specialrequests" style="margin-right: 1vw; margin-left: 1vw;">Special Requests:</label>
          <input type="text" id="specialrequests" style="width: 30vw;" name="specialrequests">
      </div>

      <button type="submit" style="margin-left: 3vw;">Continue</button>
    </div>

    
  
</form>

    <script>
        // Get the check-in and check-out date inputs
        const checkInDateInput = document.getElementById('checkindate');
        const checkOutDateInput = document.getElementById('checkoutdate');
        const checkInTimeInput = document.getElementById('checkintime');
        const checkOutTimeInput = document.getElementById('checkouttime');


        // Restrict years in date inputs
        const currentYear = new Date().getFullYear();
        const futureYears = currentYear + 10; // Allow 10 years into the future
        checkInDateInput.setAttribute('max', futureYears + '-12-31');
        checkOutDateInput.setAttribute('max', futureYears + '-12-31');


        function validTimeJS() {

          //if input not in time range
          if (checkInTimeInput.value < "13:59" || checkInTimeInput.value > "24:00") {
            document.getElementById("timeError").innerHTML = "Please select a time for check-in between 2PM - 12AM";
            document.getElementById("timeError").style.display = "";
             // Clear the input time field
              checkInTimeInput.value = "";
          }

          else if (checkOutTimeInput.value > "12:01") {
            document.getElementById("timeError").innerHTML = "Please select a time for check-out before 12PM";
            document.getElementById("timeError").style.display = "";
             // Clear the input time field
              checkOutTimeInput.value = "";
          }

          //clear the error class
          else {
            document.getElementById("timeError").style.display = "none";
          }
      }


      let checkInSuccess = localStorage.getItem('checkInSuccess') ? JSON.parse(localStorage.getItem('checkInSuccess')) : 0;

      function checkOut() {
        var selectedRow = document.querySelector(".selected");
          checkInSuccess = localStorage.getItem('checkInSuccess') ? JSON.parse(localStorage.getItem('checkInSuccess')) : 0;
          if (checkInSuccess === 1) {
              checkInSuccess = 0;
              localStorage.setItem('checkInSuccess', JSON.stringify(checkInSuccess)); // Update localStorage
              alert("Successfully checked out. Thank you for staying here!");

              // Get the check-in date from the selected row
              var checkOutDate = selectedRow.cells[3].textContent;
              var roomID = selectedRow.cells[1].textContent;
              var reservationID = selectedRow.cells[0].textContent;

               // Create a form element
              var form = document.createElement("form");
              form.method = "post";
              form.action = "reservation.php";

              // Create an input field for roomID
              var roomIDInput = document.createElement("input");
              roomIDInput.type = "hidden";
              roomIDInput.name = "room";
              roomIDInput.value = roomID;

              // Append the input field to the form
              form.appendChild(roomIDInput);

              // Append the form to the document body
              document.body.appendChild(form);

              // Submit the form
              form.submit();

              return;

          } else {
              alert("Please check-in first");
          }
      }

      function checkIn() {
  var selectedRow = document.querySelector(".selected");

  // Get the check-in date from the selected row
  var checkInDate = selectedRow.cells[2].textContent;
  var roomID = selectedRow.cells[1].textContent;
  var reservationID = selectedRow.cells[0].textContent;

  // Get the current date
  var currentDate = new Date();

  // Convert the check-in date from the table row into a Date object
  var checkInDateTime = new Date(checkInDate);

  // Check if the check-in date is today (compare year, month, and day only)
  if (
    currentDate.getFullYear() === checkInDateTime.getFullYear() &&
    currentDate.getMonth() === checkInDateTime.getMonth() &&
    currentDate.getDate() === checkInDateTime.getDate()
  ) {

    // Get the current time
    var currentHours = currentDate.getHours();

    if (currentHours > 13){
       // If the check-in date matches the current date, mark the row as checked-in
      selectedRow.style.backgroundColor = "lightgreen";
      checkInSuccess = 1;
      localStorage.setItem('checkInSuccess', JSON.stringify(checkInSuccess)); // Update localStorage
      // Display a success message
      alert("Successfully checked in. Welcome to the hotel!");
      
       // Create a form element
      var form = document.createElement("form");
      form.method = "post";
      form.action = "reservation.php";

      // Create an input field for roomID
      var roomIDInput = document.createElement("input");
      roomIDInput.type = "hidden";
      roomIDInput.name = "roomID";
      roomIDInput.value = roomID;

      // Append the input field to the form
      form.appendChild(roomIDInput);

      // Append the form to the document body
      document.body.appendChild(form);

      // Submit the form
      form.submit();

      return;
    } 
    
    else {
      alert("Please check in after 12pm!");
      return;
    }
  }

  // Check if the check-in date is in the future
  if (checkInDateTime > currentDate) {
    alert("Please wait until the check-in date to check in.");
    return;
  }

  // Check if the check-in date is in the past
  if (checkInDateTime < currentDate) {
    // Expired reservation
    selectedRow.style.textDecoration = "line-through";
    alert("Your reservation has expired.");
    return;
  }
}


function selectRow(row) {
  // Remove the active class from all rows
  var rows = document.querySelectorAll("#reservationDetails table tr");
  rows.forEach(function(row) {
    row.style.backgroundColor = ""; // Reset background color for all rows
    row.addEventListener("click", function() {
      // Remove selected class from all rows
      rows.forEach(function(row) {
        row.classList.remove("selected");
      });
      // Add selected class to the clicked row
      row.classList.add("selected");
    });
  });

  // Add background color to the clicked row
  row.style.backgroundColor = "blue";
  row.style.cursor = "pointer";

  // Enable check-in and check-out buttons
  var checkInBtn = document.getElementById("checkInBtn");
  var checkOutBtn = document.getElementById("checkOutBtn");
  checkInBtn.style.opacity = "1";
  checkOutBtn.style.opacity = "1";
  checkInBtn.disabled = false;
  checkOutBtn.disabled = false;
}

 // Function to display reservation details
 function displayReservationDetails() {
    var reservationDetails = <?php echo json_encode($reservationDetails); ?>;
    var modalContent = document.getElementById("reservationDetails");

    // Check if reservation details exist
    if (reservationDetails.length > 0) {
      // Construct HTML for displaying reservation details
      var html = "<h2>Reserved Rooms</h2>";
      html += "<table>";
      html += "<tr><th>Reservation ID</th><th>Room ID</th><th>Check-In Date</th><th>Check-Out Date</th><th>Payment ID</th><th>Special Requests</th></tr>";
      reservationDetails.forEach(function(detail) {
        html += "<tr onclick='selectRow(this)'>";
        html += "<td>" + detail.ReservationID + "</td>";
        html += "<td>" + detail.RoomID + "</td>";
        html += "<td>" + detail.CheckInDate + "</td>";
        html += "<td>" + detail.CheckOutDate + "</td>";
        html += "<td>" + detail.PaymentID + "</td>";
        html += "<td>" + detail.SpecialRequests + "</td>";
        html += "</tr>";
      });
      html += "</table>";
      html += " <div style='display: flex; justify-content: space-around;'>";
      html += " <button id='checkInBtn' onclick='checkIn()' style='width: 20vw; opacity: 0.3;' disabled>Check-in</button>";
      html += " <button id='checkOutBtn' onclick='checkOut()' style='width: 20vw; opacity: 0.3;' disabled>Check-out</button>";
      html += " </div>";
      modalContent.innerHTML = html;
    } else {
      modalContent.innerHTML = "<p>No reserved rooms found.</p>";
    }
  }

  // Get the modal
  var modal = document.getElementById("myModal");

  // Get the button that opens the modal
  var btn = document.getElementsByClassName("user-button")[0];

  // Get the <span> element that closes the modal
  var span = document.getElementsByClassName("close")[0];

  // When the user clicks the button, open the modal
  btn.onclick = function() {
    modal.style.display = "block";
    displayReservationDetails();
  }

  // When the user clicks on <span> (x), close the modal
  span.onclick = function() {
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
