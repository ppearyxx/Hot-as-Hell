<?php
// Assuming you have already established a database connection
$servername = "localhost";
        $username = "root";
        $password = "";
        $dbname = "hotas_hell";

$conn = mysqli_connect($servername, $username, $password, $dbname);

// Check connection
if (!$conn) {
    die("Connection failed: " . mysqli_connect_error());
}

$sql = "SELECT * FROM historyreservation"; 
$result = mysqli_query($conn, $sql);

// Check if query executed successfully
if ($result) {
    // Loop through the data and populate the table rows
    echo "<table border='1'>";
    echo "<tr><th>Reference No</th><th>Guest ID</th><th>Check-in date</th><th>Check-out</th><th>Check-in time</th><th>Check-out time</th><th>Room ID</th><th>Ernest Pay</th><th>Special Request</th></tr>";
    while ($row = mysqli_fetch_assoc($result)) {
        echo "<tr>";
        echo "<td>" . $row['referenceno'] . "</td>";
        echo "<td>" . $row['guestid'] . "</td>";
        echo "<td>" . $row['cin'] . "</td>";
        echo "<td>" . $row['cout'] . "</td>";
        echo "<td>" . $row['rcin'] . "</td>";
        echo "<td>" . $row['rcout'] . "</td>";
        echo "<td>" . $row['roomid'] . "</td>";
        echo "<td>" . $row['ernestpay'] . "</td>";
        echo "<td>" . $row['specialreq'] . "</td>";
        echo "<td><a href='#'>Options</a></td>";
        echo "</tr>";
    }
} else {
    echo "Error: " . mysqli_error($conn);
}

// Close the connection
mysqli_close($conn);
?>
