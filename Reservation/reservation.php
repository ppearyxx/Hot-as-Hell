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
      .room-details-popup {
        display: none;
        position: fixed;
        z-index: 1000;
        left: 50%;
        top: 50%;
        transform: translate(-50%, -50%);
        background-color: white;
        padding: 20px;
        border: 1px solid #ccc;
        border-radius: 5px;
        box-shadow: 0 2px 4px rgba(0, 0, 0, 0.2);
        color: #43328b;
      }

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
  transition: .5s ease;
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


    <form class="register-form" action="" method="post" style="margin-left:2vw;">
    <div class="form-group">

       

        <div style="display:flex;">
          <div class="date-time-group">
              <label for="checkindate" style="margin-right: 1vw;">Check-in Date:</label>
              <input type="date" id="checkindate" name="checkindate" required>
              <input type="time" id="checkintime" name="checkintime" required>
          </div>

          <div class="date-time-group">
              <label for="checkoutdate" style="margin-right: 1vw;">Check-out Date:</label>
              <input type="date" id="checkoutdate" name="checkoutdate" required>
              <input type="time" id="checkouttime" name="checkouttime" required>
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

    </div>

    <select name="roomType" id="roomType"> <!--After selecting the type of room, it lists all the availble rooms-->
      <option value="standard">Standard</option>
      <option value="family">Family</option>
      <option value="deluxe">Deluxe</option>
      <option value="luxury">Luxury</option>
    </select>
<!--Example: if user selects standard, then here it will show all the available standard rooms-->
<!--Still working:)-->
    <select name="roomType" id="roomType">
      <option value="R1001">R1001</option>
      <option value="R1002">R1002</option>
      <option value="R1003">R1003</option>
      <option value="R1004">R1004</option>
    </select>

    <button type="submit">Reserve</button>
</form>

  </body>
</html>
