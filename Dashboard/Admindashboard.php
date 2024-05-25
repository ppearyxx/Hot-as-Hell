<?php
// Start session
session_start();

$con = mysqli_connect("localhost", "root", "", "hot_as_hell");

// Check if user is logged in
if (!isset($_SESSION["EmployeeID"])) {
    // Redirect to login page if user is not logged in
    header("Location: ../Login/EmployeeLogin.html");
    exit;
}

// Retrieve username from session variable
$employeeid = $_SESSION["EmployeeID"];

// Fetch room status data
$reservedQuery = "SELECT COUNT(*) as reservedCount FROM Room WHERE RoomStatus = 'Not Available'";
$notReservedQuery = "SELECT COUNT(*) as notReservedCount FROM Room WHERE RoomStatus = 'Available'";

$reservedResult = mysqli_query($con, $reservedQuery);
$notReservedResult = mysqli_query($con, $notReservedQuery);

$reservedCount = mysqli_fetch_assoc($reservedResult)['reservedCount'];
$notReservedCount = mysqli_fetch_assoc($notReservedResult)['notReservedCount'];

// Fetch room types and their counts for "Not Available" rooms
$roomTypeQuery = "SELECT RoomType, COUNT(*) AS TypeCount 
                  FROM Room 
                  WHERE RoomStatus = 'Not Available'
                  GROUP BY RoomType";
$roomTypeResult = mysqli_query($con, $roomTypeQuery);

$roomTypes = [];
$reservationPercentages = [];

// Extract room types and their reservation counts
while ($row = mysqli_fetch_assoc($roomTypeResult)) {
    $roomTypes[] = $row['RoomType'];
    $typeCount = $row['TypeCount'];
    $reservationPercentages[] = round(($typeCount / $reservedCount) * 100, 2); // Calculate percentage and round to two decimal places
}

// Fetch daily reservations count
$dailyReservationsQuery = "SELECT DATE(CheckInDate) as ReservationDate, COUNT(*) as ReservationCount
                           FROM Reservation
                           GROUP BY DATE(ReservationDate)
                           ORDER BY ReservationDate";
$dailyReservationsResult = mysqli_query($con, $dailyReservationsQuery);

$dates = [];
$reservationCounts = [];

while ($row = mysqli_fetch_assoc($dailyReservationsResult)) {
    $dates[] = $row['ReservationDate'];
    $reservationCounts[] = $row['ReservationCount'];
}

// Fetch unique guest names and their booking frequencies
$guestBookingsQuery = "SELECT Guest.FirstName, Guest.LastName, COUNT(*) as BookingCount
                       FROM booking_details
                       JOIN Guest ON booking_details.GuestID = Guest.GuestID
                       GROUP BY Guest.FirstName, Guest.LastName
                       ORDER BY BookingCount DESC";
$guestBookingsResult = mysqli_query($con, $guestBookingsQuery);

$guestNames = [];
$bookingCounts = [];

while ($row = mysqli_fetch_assoc($guestBookingsResult)) {
    $guestNames[] = $row['FirstName'] . ' ' . $row['LastName'];
    $bookingCounts[] = $row['BookingCount'];
}

// Close database connection
mysqli_close($con);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Hot As Hell</title>
    <link rel="stylesheet" href="../Navbar.css">
    <link rel="stylesheet" href="../SignUp/signup.css">
    <link rel="shortcut icon" href="../images/logo.png" type="image/x-icon">
    
    <style>
      .user-button {
            display: flex;
            align-items: center;
            background-color: #171A33;
            width: 15vw;
            height: 6vh;
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

        .chart-container {
            width: 30%;
            margin: auto;
            margin-top: 4vw;
            padding: 2em;
        }
    </style>
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
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
            <?php echo $employeeid; ?>
          </button>
      </nav>
    </header>

    <div style="display:flex;">
        <div class="chart-container">
            <canvas id="roomStatusChart"></canvas>
        </div>

        <div class="chart-container">
            <canvas id="roomTypeChart"></canvas>
        </div>
    </div>

    <div style="display:flex;">
        <div class="chart-container">
            <canvas id="dailyReservationsChart"></canvas>
        </div>

        <div class="chart-container">
            <canvas id="guestBookingChart"></canvas>
        </div>
    </div>

    <script>
        // Get data from PHP variables
        const reservedCount = <?php echo $reservedCount; ?>;
        const notReservedCount = <?php echo $notReservedCount; ?>;
        const roomTypes = <?php echo json_encode($roomTypes); ?>;
        const reservationPercentages = <?php echo json_encode($reservationPercentages); ?>;
        const reservationCounts = <?php echo json_encode($reservationCounts); ?>;
        const dates = <?php echo json_encode($dates); ?>;
        const guestNames = <?php echo json_encode($guestNames); ?>;
        const bookingCounts = <?php echo json_encode($bookingCounts); ?>;

        // Chart.js script to render the pie chart for room status
        const ctx1 = document.getElementById('roomStatusChart').getContext('2d');
        const roomStatusChart = new Chart(ctx1, {
            type: 'pie',
            data: {
                labels: ['Reserved', 'Not Reserved'],
                datasets: [{
                    label: 'Room Status',
                    data: [reservedCount, notReservedCount],
                    backgroundColor: ['#FF6384', '#36A2EB'],
                    hoverOffset: 4
                }]
            },
            options: {
                responsive: true,
                plugins: {
                    legend: {
                        position: 'bottom',
                        labels: {
                            color: 'white', // Custom legend color
                            font: {
                                size: 16
                            }
                        }
                    },
                    title: {
                        display: true,
                        text: 'Room Reservation Status',
                        color: 'white', // Custom title color
                        font: {
                            size: 18
                        }
                    },
                    tooltip: {
                        callbacks: {
                            label: function(context) {
                                let label = context.label || '';
                                if (label) {
                                    label += ': ';
                                }
                                if (context.raw !== null) {
                                    label += context.raw;
                                }
                                return label;
                            }
                        }
                    }
                }
            }
        });

        // Chart.js script to render the doughnut chart for room types
        const ctx2 = document.getElementById('roomTypeChart').getContext('2d');
        const roomTypeChart = new Chart(ctx2, {
            type: 'doughnut',
            data: {
                labels: roomTypes,
                datasets: [{
                    label: 'Room Types',
                    data: reservationPercentages,
                    backgroundColor: ['#FF6384', '#36A2EB', '#FFCE56', '#4BC0C0', '#9966FF', '#FF9F40', '#4BC0C0'], // Add more colors if needed
                    hoverOffset: 4
                }]
            },
            options: {
                responsive: true,
                plugins: {
                    legend: {
                        position: 'bottom',
                        labels: {
                            color: 'white', // Custom legend color
                            font: {
                                size: 16
                            }
                        }
                    },
                    title: {
                        display: true,
                        text: 'Room Type Reservation Distribution',
                        color: 'white', // Custom title color
                        font: {
                            size: 18
                        }
                    },
                    tooltip: {
                        callbacks: {
                            label: function(context) {
                                let label = context.label || '';
                                if (label) {
                                    label += ': ';
                                }
                                if (context.raw !== null) {
                                    label += context.raw + '%';
                                }
                                return label;
                            }
                        }
                    }
                }
            }
        });

        // Chart.js script to render the bar chart for daily reservations
        const ctx3 = document.getElementById('dailyReservationsChart').getContext('2d');
        const dailyReservationsChart = new Chart(ctx3, {
            type: 'bar',
            data: {
                labels: dates,
                datasets: [{
                    label: 'Daily Reservations',
                    data: reservationCounts,
                    backgroundColor: '#FF6384',
                    hoverOffset: 4
                }]
            },
            options: {
                responsive: true,
                scales: {
                    x: {
                        title: {
                            display: true,
                            text: 'Date',
                            color: 'white',
                            font: {
                                size: 16
                            }
                        },
                        ticks: {
                            color: 'white'
                        }
                    },
                    y: {
                        title: {
                            display: true,
                            text: 'Number of Reservations',
                            color: 'white',
                            font: {
                                size: 16
                            }
                        },
                        ticks: {
                            color: 'white'
                        }
                    }
                },
                plugins: {
                    legend: {
                        display: false
                    },
                    title: {
                        display: true,
                        text: 'Daily Number of Reservations',
                        color: 'white',
                        font: {
                            size: 18
                        }
                    }
                }
            }
        });

        // Chart.js script to render the horizontal bar chart for guest bookings
        const ctx4 = document.getElementById('guestBookingChart').getContext('2d');
        const guestBookingChart = new Chart(ctx4, {
            type: 'bar',
            data: {
                labels: guestNames,
                datasets: [{
                    label: 'Number of Bookings',
                    data: bookingCounts,
                    backgroundColor: '#36A2EB',
                    hoverOffset: 4
                }]
            },
            options: {
                responsive: true,
                indexAxis: 'y',
                scales: {
                    x: {
                        title: {
                            display: true,
                            text: 'Number of Bookings',
                            color: 'white',
                            font: {
                                size: 16
                            }
                        },
                        ticks: {
                            color: 'white'
                        }
                    },
                    y: {
                        title: {
                            display: true,
                            text: 'Guest Name',
                            color: 'white',
                            font: {
                                size: 16
                            }
                        },
                        ticks: {
                            color: 'white'
                        }
                    }
                },
                plugins: {
                    legend: {
                        display: false
                    },
                    title: {
                        display: true,
                        text: 'Number of Bookings per Guest',
                        color: 'white',
                        font: {
                            size: 18
                        }
                    }
                }
            }
        });
    </script>
</body>
</html>
