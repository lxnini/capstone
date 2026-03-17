<?php
session_start();

// Redirect if not logged in
if (!isset($_SESSION['user_id'])) {
    header("Location: login.php");
    exit();
}

// Safely get the name with fallback (prevents "undefined key" errors/notices)
$displayName = $_SESSION['name'] ?? 'Member';
?>

<?php include 'config/database.php'; ?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Church Booking System</title>
    <link rel="stylesheet" href="css/style.css">
</head>

<body>

    <header>
        <h1>San Fernando Parish Booking System</h1>
        <!-- This is the line you wanted – now safe & XSS-protected -->
        <p>Welcome, <?= htmlspecialchars($displayName) ?>!</p>
    </header>

    <nav>
        <a href="bookings.php">Manage Bookings</a>
        <!-- Suggestion: add logout later -->
        <!-- <a href="logout.php">Logout</a> -->
    </nav>

    <main>

        <h2>Regular Mass Schedule</h2>

        <table border="1">
            <tr>
                <th>Day</th>
                <th>Time</th>
                <th>Priest</th>
            </tr>

            <?php
            $result = mysqli_query($conn, "SELECT * FROM mass_schedule") 
                or die(mysqli_error($conn)); // ← helps debug query problems

            while ($row = mysqli_fetch_assoc($result)) {
                echo "<tr>";
                echo "<td>" . htmlspecialchars($row['day'])    . "</td>";
                echo "<td>" . htmlspecialchars($row['time'])   . "</td>";
                echo "<td>" . htmlspecialchars($row['priest']) . "</td>";
                echo "</tr>";
            }
            ?>
        </table>

        <h2>Upcoming Events</h2>

        <ul>
            <?php
            $result = mysqli_query($conn, "SELECT * FROM bookings ORDER BY event_date ASC")
                or die(mysqli_error($conn));

            $hasEvents = false;

            while ($row = mysqli_fetch_assoc($result)) {
                $hasEvents = true;
                echo "<li>";
                echo htmlspecialchars($row['event_type']) . " – ";
                echo htmlspecialchars($row['event_date']) . " (";
                echo htmlspecialchars($row['name']) . ")";
                echo "</li>";
            }

            if (!$hasEvents) {
                echo "<li>No upcoming events found.</li>";
            }
            ?>
        </ul>

    </main>

</body>
</html>