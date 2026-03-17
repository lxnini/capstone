<?php
session_start();
include 'includes/auth.php';
include 'includes/db.php';
include 'includes/header.php';
?>

<h1>Welcome, <?php echo $_SESSION['staff_name']; ?></h1>

<a href="bookings.php">Manage Bookings</a>
<a href="schedule.php">View Mass Schedule</a>
<a href="logout.php">Logout</a>