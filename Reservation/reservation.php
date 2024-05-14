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
              <p>Beds: King-size</p>
              <p>Amenities: Pool, City View</p>
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
              <p>Beds: King-size</p>
              <p>Amenities: Pool, City View</p>
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

    </script>
  </body>
</html>
