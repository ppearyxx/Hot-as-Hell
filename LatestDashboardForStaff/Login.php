<?php
// Start session
session_start();
// Check if form is submitted
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Check if both GuestID and Password are set
    if (isset($_POST["GuestID"]) && isset($_POST["Password"])) {
        
        $servername = "localhost";
        $username = "root";
        $password = "";
        $dbname = "hot_as_hell";

       
        $conn = new mysqli($servername, $username, $password, $dbname);

     
        if ($conn->connect_error) {
            die("Connection failed: " . $conn->connect_error);
        }

        
        $inputGuestID = $conn->real_escape_string($_POST["GuestID"]);
        $inputPassword = $conn->real_escape_string($_POST["Password"]);

        // Select all the rows from table where there is matching GuestID and Password entered by user
        $sql = "SELECT * FROM Guest WHERE GuestID = '$inputGuestID' AND Password = '$inputPassword'";
        $result = $conn->query($sql);

        // Check if there is a matching record
        if ($result->num_rows > 0) {

             // Fetch the row from the result set
             $row = $result->fetch_assoc();

             // Retrieve the first name from the fetched row
             $firstname = $row["FirstName"];
 
             // Set session variable
             $_SESSION["FirstName"] = $firstname;
             $_SESSION["GuestID"] = $inputGuestID;
             
            header("Location: ../Reservation/reservation.php");
            exit(); // Ensure that no further code is executed after redirection

        } else {
            // If credentials are incorrect, display failure message
            echo "<h1>Login Failed</h1>";
        }

        // Close connection
        $conn->close();
    } else {
        // If GuestID or Password is not set, display an error message
        echo "<h1>Error: GuestID or Password not provided</h1>";
    }
}
?>
